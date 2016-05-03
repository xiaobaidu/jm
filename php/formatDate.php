<?
/**
 * 格式化日期
 *
 * @param  $unix_time
 */
function format_date($unix_time) {
    $cur_time = time();
    $time = $cur_time - $unix_time;
    $y = date('Y', $cur_time);
    $m = date('m', $cur_time);
    $d = date('d', $cur_time);

    // 今天开始时间与结束时间
    $today_start_time = mktime(0, 0, 0, $m, $d, $y);
    $today_end_time = mktime(23, 59, 59, $m, $d, $y);

    if ($m == 1 && $d == 1) {
        $y_m = 12;
        $y_y = $y - 1;
        $y_d = cal_days_in_month(CAL_GREGORIAN, $y_m, $y_y);
    } elseif ($d == 1 && $m > 1) {
        $y_m = $m - 1;
        $y_y = $y;
        $y_d = cal_days_in_month(CAL_GREGORIAN, $y_m, $y_y);
    } else {
        $y_m = $m;
        $y_y = $y;
        $y_d = $d - 1;
    }
    // 昨天开始时间
    $yesterday_start_time = mktime(0, 0, 0, $y_m, $y_d, $y_y);
    if ($time < 10) {
        return ' 刚刚';
    }elseif ($time < 60) {
        return $time .' 秒前';
    } elseif ($time < 3600) {
        return ceil($time/60) .' 分钟前';
    } elseif ($unix_time < $today_end_time && $unix_time > $today_start_time) {
        return '今天 '. date('H:i', $unix_time);
    } elseif ($unix_time < $today_start_time && $unix_time > $yesterday_start_time) {
        return '昨天'. date('H:i', $unix_time);
    } else {
        return date('Y.m.d H:i', $unix_time);
    }
}
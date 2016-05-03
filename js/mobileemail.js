var hello = {};
hello.util = {
	isEmail: function(s) {
	    return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(s) ? true : false;
	},
	isMobile: function(s) {
	    return /^1[3|4|5|7|8][0-9]{9}$/.test(s) ? true : false;
	}
}
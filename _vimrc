syntax enable  
syntax on  
  
colorscheme desert  
  
set nocompatible  
set filetype=c  
  
set number  
set numberwidth=4  
  
set wrap " 自动换行  
map <C-n> :NERDTreeToggle<CR>

map <C-j> <C-W>j
map <C-k> <C-W>k
map <C-h> <C-W>h
map <C-l> <C-W>l
imap jj <Esc>

map <C-n> :NERDTreeToggle<CR>
set autoindent   
set smartindent  
set cindent  
set ai!  
  
set smarttab " 在行和段开始处使用制表符  
  
set cursorline " 高亮显示当前行  
"set expandtab   
set noexpandtab " 不要用空格来代替制表符tab  
set tabstop=8  
set shiftwidth=8  
set softtabstop=8  
set ts=4 
set mouse=a  
  
set showmatch " 高亮显示匹配的括号  
set history=1000  
set hlsearch " 高亮被搜索的句子  
set incsearch  
set nowrapscan   " 禁止搜索到文件两端时重新搜索  
  
set gdefault  
  
  
set diffexpr=MyDiff()  
  
function MyDiff()  
        let opt = '-a --binary '  
        if &diffopt =~ 'icase' | let opt = opt . '-i ' | endif  
        if &diffopt =~ 'iwhite' | let opt = opt . '-b ' | endif  
        let arg1 = v:fname_in  
        if arg1 =~ ' ' | let arg1 = '"' . arg1 . '"' | endif  
        let arg2 = v:fname_new  
        if arg2 =~ ' ' | let arg2 = '"' . arg2 . '"' | endif  
        let arg3 = v:fname_out  
        if arg3 =~ ' ' | let arg3 = '"' . arg3 . '"' | endif  
        let eq = ''  
        if $VIMRUNTIME =~ ' '  
                if &sh =~ '\<cmd'  
                        let cmd = '""' . $VIMRUNTIME . '\diff"'  
                        let eq = '"'  
endfunction  
  
" 启动最大化  
if has('gui_running') && has("win32")  
    au GUIEnter * simalt ~x  
endif  
                  
"////////////////////////////////////////////////////////////////////////////////////////  
"文件显示编码  
set fileencodings=utf-8,gbk2312,gbk,gb18030,cp936  
set encoding=utf-8  
set termencoding=utf-8  
set fileencoding=utf-8  
set imcmdline    
  
  
  
" 解决菜单乱码  
"-----------------------------------  
set langmenu=zh_CN  
let $LANG = 'zh_CN.UTF-8'  
source $VIMRUNTIME/delmenu.vim  
source $VIMRUNTIME/menu.vim  
  
source $VIMRUNTIME/vimrc_example.vim  
source $VIMRUNTIME/mswin.vim  
behave mswin  
"-----------------------------------  
  
"////////////////////////////////////////////////////////////////////////////////////////  
"vim 提示信息乱码解决方法  
"language messages zh_CN.UTF-8  
if has("win32")  
set termencoding=chinese  
language message zh_CN.UTF-8  
endif  
  
  
" 多标签  
"let Tlist_Ctags_Cmd='D:\Vim\vim73\ctags.exe'  
let Tlist_Ctags_Cmd='ctags.exe'  
set autochdir  
set tags=tags;  " ';' 不能没有  
  
let Tlist_Auto_Open=1 " Auto Open when VIM opening  
let Tlist_Show_One_File=1 " 只显示当前文件的标签  
let Tlist_Exit_OnlyWindow=1 " 当只有 Tlist 窗口时关闭  
let Tlist_Use_Right_Window=0  " 窗口在右边 = 1  
"let Tlist_Show_Menu=1 "显示taglist菜单  
"let Tlist_File_Fold_Auto_Close=1 "让当前不被编辑的文件的方法列表自动折叠起来   
  
  
" 窗口管理  
"let g:winManagerWindowLayout='FileExplorer|TagList'  
let g:winManagerWindowLayout='FileExplorer' " 各单独一个窗口, 一屏可以观察更多  
"let g:winManagerWindowLayout='TagList|FileExplorer,BufExplorer'  
"let g:winManagerWindowLayout='FileExplorer|BufExplorer'  
nmap wm :WMToggle<cr>  
  
  
" 多文件编辑  
"ctrl+Tab，切换到前一个buffer，并在当前窗口打开文件；  
"ctrl+shift+Tab，切换到后一个buffer，并在当前窗口打开文件；  
"ctrl+箭头键，可以切换到上下左右窗口中；  
"ctrl+h,j,k,l，切换到上下左右的窗口中。  
let g:miniBufExplMapCTabSwitchBufs=1  
let g:miniBufExplMapWindowsNavVim=1  
let g:miniBufExplMapWindowNavArrows=1  
  
"快速切换头文件与源文件, 按F12即可以在c/h文件中切换，也可以通过输入:A实现  
nnoremap <silent> <F12> :A<CR>  
  
"工程中快速查找, F3 快捷键, 然后支持正则表达式  
nnoremap <silent> <F3> :Grep<CR>  
  
  
" 自动补全  
filetype plugin indent on  
set completeopt=longest,menu   
  
let g:SuperTabRetainCompletionType=2   
let g:SuperTabDefaultCompletionType="<C-X><C-O>" 

/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
copyright: CMS部落——www.eworthcms.com
*/

(function(){CKEDITOR.plugins.add('codeblock',{init:function(a){var b=a.addCommand('codeblock',new CKEDITOR.dialogCommand('codeblock'));a.ui.addButton('CodeBlock',{label:'代码段',command:'codeblock',icon:this.path+'images/codeblock.gif'});CKEDITOR.dialog.add('codeblock',this.path+'dialogs/codeblock.js');}});})();

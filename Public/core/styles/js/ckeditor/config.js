/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//	filebrowserUploadUrl : '/ckeditor/ckeditor/uploader?Type=File',
//	filebrowserImageUploadUrl : '/ckeditor/ckeditor/uploader?Type=Image',  
//	filebrowserFlashUploadUrl : '/ckeditor/ckeditor/uploader?Type=Flash'
	config.filebrowserUploadUrl = '__PUBLIC__/Upload/File';
	config.filebrowserImageUploadUrl = '__PUBLIC__/Upload/Image';
    config.filebrowserFlashUploadUrl = '__PUBLIC__/Upload/Flash';
    config.filebrowserMusicUploadUrl = '__PUBLIC__/Upload/Music';
    config.allowedContent = true;
    config.toolbarStartupExpanded = false;
//  config.fullPage= true; 
	config.height = '250px';
//	config.removePlugins = 'elementspath';  //让编辑器里面的p标签隐藏
	//config.extraPlugins = 'music';
	config.enterMode = CKEDITOR.ENTER_BR;    //去掉编辑器里面的<p>标签
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	config.extraPlugins = 'music';
	config.toolbar = [
		['Source','Preview','-','Templates'],
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		'/',
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
		'/',
		['Styles','Format','Font','FontSize'],
		['TextColor','MathJax','BGColor','music']
	];
	CKEDITOR.config.contentsCss = ['__PUBLIC__/core/styles/js/ckeditor/contents.css','__PUBLIC__/core/styles/css/bootstrap.css', '__PUBLIC__/exam/styles/css/mathquill.css'];
};

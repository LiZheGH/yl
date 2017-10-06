/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.language = 'zh-cn'; //	配置语言
	config.font_names = '宋体/宋体;黑体/黑体;仿宋/仿宋_GB2312;华文中宋/华文中宋;楷体/楷体_GB2312;隶书/隶书;幼圆/幼圆;微软雅黑/微软雅黑;' + config.font_names;
	config.uiColor = '#EEEEEE'; //	界面颜色
	//config.width = 100%; //	宽度
	//config.height = 100%; //	高度
	config.toolbar = 
		[
		 ['Source','Preview','Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo','Find','Replace','RemoveFormat'],
		 ['Image','Smiley','SpecialChar','Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		 ['Format','Font','FontSize','TextColor','BGColor','Maximize','ShowBlocks']
		 ];
	config.filebrowserBrowseUrl = '/public/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/public/ckfinder/ckfinder.html?type=Images';
	config.filebrowserUploadUrl = '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserWindowWidth = '1000';
	config.filebrowserWindowHeight = '700';
	config.toolbarStartupExpanded = true; 
};

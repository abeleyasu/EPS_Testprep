/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
 CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/browser/browse.php',
    filebrowserUploadUrl: '/uploader/upload.php'
});
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.

	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'justify';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'font';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'richcombo';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor-gwf-plugin';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'colorbutton';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'html5video';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'widget';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'filebrowser';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'imageuploader';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'dialog';
	
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'popup';
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'filetools';
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.imageUploadUrl = '/uploader/upload.php?type=Images';
	
	config.font_names = 'GoogleWebFonts';

	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	//config.removeDialogTabs = 'image:advanced;link:advanced';
};

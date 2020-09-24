/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language 		= 'en';
	config.uiColor 			= '9Ab8F3';
	config.tabSpaces 		= 4;
	config.toolbarCanCollapse = true;	
	config.toolbarStartupExpanded = false;
	// CKEDITOR.editorConfig = function( config ) {
	// 	config.toolbarGroups = [
	// 		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// 		{ name: 'forms', groups: [ 'forms' ] },
	// 		'/',
	// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	// 		{ name: 'links', groups: [ 'links' ] },
	// 		{ name: 'insert', groups: [ 'insert' ] },
	// 		'/',
	// 		{ name: 'styles', groups: [ 'styles' ] },
	// 		{ name: 'colors', groups: [ 'colors' ] },
	// 		{ name: 'tools', groups: [ 'tools' ] },
	// 		{ name: 'others', groups: [ 'others' ] },
	// 		{ name: 'about', groups: [ 'about' ] }
	// 	];
	// };

	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	

};

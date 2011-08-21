/**
 *	@initialization Namespaces
**/
Executive = {};
Executive.jquery = {};
Executive.jquery.service = {};
Executive.jquery.workflow = {};
Executive.jquery.helper = {};
Executive.jquery.constant = {};
Executive.jquery.template = {};

/**
 *	@initialization Session variables
**/
Executive.session = {
	user : false,
	pass : false
};


/**
 *	@constant loadmsg
 *	@desc HTML content to show while loading content (default '<p class="loading">Loading ...</p>')
 *
**/
Executive.jquery.constant.loadmsg = '<p class="loading">Loading ...</p>';

/**
 *	@constant successmsg
 *	@desc HTML content to indicate successful execution (default '<img src="ui/img/icons/ok.gif">')
 *
**/
Executive.jquery.constant.successimg = '<img src="ui/img/icons/ok.gif">';

/**
 *	@constant errormsg
 *	@desc HTML content to indicate erroneous execution (default '<img src="ui/img/icons/error.gif">')
 *
**/
Executive.jquery.constant.errorimg = '<img src="ui/img/icons/error.gif">';

var CKEDITOR_BASEPATH = 'ui/js/ckeditor/';
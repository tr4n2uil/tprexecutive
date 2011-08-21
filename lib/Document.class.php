<?php 
/**
 *	@class Document
 *	@desc Manages basic HTML Document sections for console
 *
**/
class Document {

	/**
	 *	@method header
	 *	@desc Outputs the document header
	 *
	 *	@param title string
	 *	@param styles array optional default array()
	 *
	**/
	public static function header($title, $styles = array()){		
		echo <<<HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>$title</title>
HEADER;

		foreach($styles as $style){
			echo <<<STYLE
		<link rel="stylesheet" type="text/css" href="ui/css/$style" />
STYLE;
		}
		
		echo "</head><body>";
	}
	
	/**
	 *	@method footer
	 *	@desc Outputs the document footer
	 *	
	 *	@param footer string
	 *	@param scripts array optional default array()
	 *
	**/
	public static function footer($footer, $scripts = array()){		
		echo <<<FOOTER
		<div id="footer">
			$footer
		</div>
		<!--<div id="validation-panel">
			<ul class="horizontal menu">
				<li><a href="http://validator.w3.org/check?uri=referer" target="_blank"><img src="ui/img/validation/valid-xhtml10-blue.png" alt="Valid XHTML 1.0!" height="31" width="88" /></a></li>
				<li><a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" ><img src="ui/img/validation/valid-css-blue.png" alt="Valid CSS!" height="31" width="88" /></a></li>
			</ul>
		</div>-->
		<div class="clear"></div>
FOOTER;
		
		foreach($scripts as $key=>$value){
			echo <<<SCRIPT
		<script type="text/javascript">
			document.getElementById('load-status').innerHTML = 'Loading $key ...';
		</script>
		<script type="text/javascript" src="ui/js/$value"></script>
SCRIPT;
		}
	}
	
}
?>
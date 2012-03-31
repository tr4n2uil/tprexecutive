/**
 *	@helper readCourse
 *
 *	@param crs course character
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
Executive.core.helper.readCourse = function($crs){
	switch($crs){
		case 'btech' :
			return 'B. Tech.';
		case 'idd' :
			return 'IDD / IMD';
		case 'mtech' :
			return 'M. Tech.';
		default :
			return '';
			break;
	}
}

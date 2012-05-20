/**
 *	@helper readWstatus
 *
 *	@param ch wstatus integer
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
Executive.core.helper.readWstatus = function($ch){
	switch(Number($ch)){
		case 0 :
			return 'Eligible';
		case 1 :
			return 'Willing';
		case -1 :
			return 'Not Willing';
		default :
			return '';
			break;
	}
}

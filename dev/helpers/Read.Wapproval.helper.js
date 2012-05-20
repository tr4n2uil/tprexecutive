/**
 *	@helper readWapproval
 *
 *	@param ch wapproval integer
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
Executive.core.helper.readWapproval = function($ch){
	switch(Number($ch)){
		case 0 :
			return 'Pending';
		case 1 :
			return 'Approved';
		case -1 :
			return 'Rejected';
		default :
			return '';
			break;
	}
}

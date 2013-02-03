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
		case -1 :
			return 'Willingness Rejected';
		case -2 :
			return 'Missed Cutoff';
		case -3 :
			return 'Did not Appear';
		case 0 :
			return 'Pending';
		case 1 :
			return 'Willingness Approved';
		case 2 :
			return 'Written Test';
		case 3 :
			return 'Group Discussion';
		case 4 :
			return 'Technical Interviews';
		case 5 :
			return 'HR Interviews';
		case 6 :
			return 'Received Offer';
		default :
			return '';
			break;
	}
}

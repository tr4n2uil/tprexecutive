<?php 
require_once(SBSERVICE);

/**
 *	@class FormContactWorkflow
 *	@desc Accepts new contact online submission
 *
 *	@param name string Contact Name [memory]
 *	@param cntemail string Contact Email [memory]
 *	@param cntphone string Company Person Phone [memory]
 *	@param subject string Message Subject [memory]
 *	@param body string Message Body [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *
 *	@param mailto string Mail To [memory] optional default 'form_mailto' Snowblozm ['reponse']
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class FormResponseWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'name', 'cntemail', 'cntphone', 'subject', 'body'),
			'optional' => array('mailto' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'added';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		$memory['queid'] = FORM_ID;
		$memory['msg'] = 'Message Sent Successfully';
		
		//if(!$memory['mailto']){
		$mailto = Snowblozm::get('form_mailto');
		$memory['mailto'] = $mailto['contact'].','.$memory['cntemail'];
		//}
		
		$memory['body'] = '<h2>Contact Us Message</h2>
		<style type="text/css">
		ul { margin: 0; padding: 0; }
		table td { vertical-align: top; padding: 5px; }
		</style>
		<table class="formtable thovered"><tbody>
			<tr><td>Name</td><td>'.$memory['name'].'</td></tr>
			<tr><td>Email</td><td>'.$memory['cntemail'].'</td></tr>
			<tr><td>Phone</td><td>'.$memory['cntphone'].'</td></tr>
			
			<tr><td colspan="2" class="section">
			<h3>Message</h3>
			<td></tr>
			<tr><td></td><td>'.$memory['body'].'</td></tr>
	
			</tbody></table>
		<br />
		<br />
		--<br />
		TPO Portal Online Forms<br />
		IT BHU Training &amp; Placement Cell
		';
		
		$workflow = array(
		array(
			'service' => 'queue.mail.add.workflow',
			'input' => array('to' => 'mailto'),
			'subject' => '[Contact Online] '.$memory['subject']
		), 
		array(
			'service' => 'queue.mail.send.workflow'
		));

		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>

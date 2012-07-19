<?php 
require_once(SBSERVICE);

/**
 *	@class StudentEditWorkflow
 *	@desc Edits student using ID
 *
 *	@param stdid long int Student ID [memory]
 *	@param name string Student name [memory]
 *	@param interests string Interests [memory]
 
 *	@param title string Title [memory]
 *	@param phone string Phone [memory]
 *	@param dateofbirth string Date of birth [memory] (Format YYYY-MM-DD)
 *	@param gender string Gender [memory]  (M=Male F=Female N=None)
 *	@param address string Address [memory] 
 *	@param country string Country [memory]
 *	@param location long int Location [memory] optional default 0
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Username [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class StudentEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'stdid', 'name', 'phone', 'address', 'interests'),
			'optional' => array('location' => 0, 'title' => '', 'dateofbirth' => '', 'gender' => 'N', 'category' => 'General', 'resphone' => '', 'resaddress' => '', 'graddetails' => '', 'language' => '', 'passport' => '', 'father' => '', 'foccupation' => '', 'mother' => '', 'moccupation' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'people.person.edit.workflow',
			'input' => array('pnid' => 'stdid'),
			'country' => 'India',
		),
		array(
			'service' => 'people.person.update.workflow',
			'input' => array('pnid' => 'stdid'),
			'email' => false,
			'device' => 'sms'
		),
		array(
			'service' => 'transpera.relation.update.workflow',
			'args' => array('stdid', 'name', 'interests', 'category', 'resphone', 'resaddress', 'graddetails', 'language', 'passport', 'father', 'foccupation', 'mother', 'moccupation'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "set `name`='\${name}', `interests`='\${interests}', `category`='\${category}', `resphone`='\${resphone}', `resaddress`='\${resaddress}', `graddetails`='\${graddetails}', `language`='\${language}', `passport`='\${passport}', `father`='\${father}', `foccupation`='\${foccupation}', `mother`='\${mother}', `moccupation`='\${moccupation}' where `stdid`=\${stdid}",
			'successmsg' => 'Student edited successfully',
			'check' => false,
			'escparam' => array('name', 'interests', 'category', 'resphone', 'resaddress', 'graddetails', 'language', 'passport', 'father', 'foccupation', 'mother', 'moccupation'),
			'errormsg' => 'No Change / Invalid Student ID'
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
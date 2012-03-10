<?php 
require_once(SBSERVICE);

/**
 *	@class StudentEditWorkflow
 *	@desc Edits student using ID
 *
 *	@param stdid long int Student ID [memory]
 *	@param name string Student name [memory]
 *	@param rollno string Roll no [memory]
 *	@param dept string Department [memory]
 *	@param course string Course [memory]
 *	@param year integer Year [memory]
 *
 *	@param cgpa float CGPA [memory]
 *	@param sgpa1 float SGPA I [memory]
 *	@param sgpa2 float SGPA II [memory]
 *	@param sgpa3 float SGPA III [memory]
 *	@param sgpa4 float SGPA IV [memory]
 *	@param sgpa5 float SGPA V [memory]
 *	@param sgpa6 float SGPA VI [memory]
 *	@param sgpa7 float SGPA VII [memory]
 *	@param sgpa8 float SGPA VIII [memory]
 *	@param sgpa9 float SGPA IX [memory]
 *	@param sgpa10 float SGPA X [memory]
 *	@param ygpa1 float YGPA I [memory]
 *	@param ygpa2 float YGPA II [memory]
 *	@param ygpa3 float YGPA III [memory]
 *	@param ygpa4 float YGPA IV [memory]
 *	@param ygpa5 float YGPA V [memory]
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
			'required' => array('keyid', 'user', 'stdid', 'name', 'phone', 'address', 'rollno', 'dept', 'course', 'year', 'cgpa', 'sgpa1', 'sgpa2', 'sgpa3', 'sgpa4', 'sgpa5', 'sgpa6', 'sgpa7', 'sgpa8', 'sgpa9', 'sgpa10', 'ygpa1', 'ygpa2', 'ygpa3', 'ygpa4', 'ygpa5', 'interests'),
			'optional' => array('location' => 0, 'title' => '', 'dateofbirth' => '', 'gender' => 'N')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'transpera.reference.authorize.workflow',
			'input' => array('id' => 'stdid'),
			'init' => false
		),
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
			'args' => array('stuid', 'name', 'phone', 'rollno', 'dept', 'course', 'year', 'cgpa', 'interests', 'sgpa1', 'sgpa2', 'sgpa3', 'sgpa4', 'sgpa5', 'sgpa6', 'sgpa7', 'sgpa8', 'sgpa9', 'sgpa10', 'ygpa1', 'ygpa2', 'ygpa3', 'ygpa4', 'ygpa5'),
			'conn' => 'exconn',
			'relation' => '`students`',
			'sqlcnd' => "set `name`='\${name}', `phone`='\${phone}', `rollno`='\${rollno}', `course`='\${course}', `dept`='\${dept}', `year`=\${year}, `cgpa`=\${cgpa}, `interests`='\${interests}', `sgpa1`=\${sgpa1}, `sgpa2`=\${sgpa2}, `sgpa3`=\${sgpa3}, `sgpa4`=\${sgpa4}, `sgpa5`=\${sgpa5}, `sgpa6`=\${sgpa6}, `sgpa7`=\${sgpa7}, `sgpa8`=\${sgpa8}, `sgpa9`=\${sgpa9}, `sgpa10`=\${sgpa10}, `ygpa1`=\${ygpa1}, `ygpa2`=\${ygpa2}, `ygpa3`=\${ygpa3}, `ygpa4`=\${ygpa4}, `ygpa5`=\${ygpa5} where `stuid`=\${stuid}",
			'successmsg' => 'Student edited successfully',
			'check' => false,
			'escparam' => array('name', 'phone', 'rollno', 'dept', 'course', 'interests'),
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
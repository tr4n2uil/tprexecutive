<?php 
require_once(SBSERVICE);

/**
 *	@class WillingnessInfoWorkflow
 *	@desc Returns willingness information by ID
 *
 *	@param wlgsid/id long int Willingness ID [memory]
 *	@param keyid long int Usage Key ID [memory] optional default false
 *	@param user string Key User [memory]
 *	@param wgltid long int Willinglist ID [memory] optional default 0
 *	@param wgltname/name string Willinglist name [memory] optional default ''
 *
 *	@return willingness array Willingness information [memory]
 *	@return wgltname string Willinglist name [memory]
 *	@return wgltid long int Willinglist ID [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillingnessInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('wlgsid'),
			'optional' => array('keyid' => false, 'user' => '', 'wgltname' => false, 'name' => '', 'wgltid' => false, 'id' => 0),
			'set' => array('id', 'name')
		); 
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['wlgsid'] = $memory['wlgsid'] ? $memory['wlgsid'] : $memory['id'];
		
		$service = array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'wlgsid', 'parent' => 'wgltid', 'cname' => 'name', 'wgltname' => 'wgltname'),
			'conn' => 'exconn',
			'relation' => '`willingnesses` w, `students` s, `grades` g',
			'sqlprj' => 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`',
			'sqlcnd' => "where `wlgsid`=\${id} and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`",
			'errormsg' => 'Invalid Willingness ID',
			'type' => 'willingness',
			'successmsg' => 'Willingness information given successfully',
			'output' => array('entity' => 'willingness')
		);
		
		return Snowblozm::run($service, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willingness', 'wgltname', 'wgltid', 'admin');
	}
	
}

?>
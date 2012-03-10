<?php 
require_once(SBSERVICE);

/**
 *	@class ProfileListWorkflow
 *	@desc Returns all profiles information in portal container
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param portalid long int Portal ID [memory] optional default PORTAL_ID
 *	@param plname string Portal name [memory] optional default ''
 *	@param pgsz long int Paging Size [memory] optional default false
 *	@param pgno long int Paging Index [memory] optional default 1
 *	@param total long int Paging Total [memory] optional default false
 *
 *	@return profiles array Profiles information [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return plname string Portal name [memory]
 *	@return admin integer Is admin [memory]
 *	@return total long int Paging Total [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class ProfileListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('portalid' => PORTAL_ID, 'name' => '', 'pgsz' => 100, 'pgno' => 0, 'total' => false),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$workflow = array(
		array(
			'service' => 'transpera.relation.select.workflow',
			'input' => array('id' => 'portalid'),
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlprj' => '`plid`, `name`, `username`, `org`, `country`',
			'sqlcnd' => "where `ustatus`='A' order by `username`",
			'type' => 'profile',
			'successmsg' => 'Profiles information given successfully',
			'output' => array('result' => 'profiles'),
			'ismap' => false
		),
		/*array(
			'service' => 'transpera.relation.select.workflow',
			'conn' => 'ayconn',
			'relation' => '`profiles`',
			'sqlprj' => 'count(`plid`) as `total`',
			'sqlcnd' => "where `ustatus`='A' ",
			'type' => 'profile',
			'successmsg' => 'Registration count information given successfully',
			'ismap' => false
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0.total' => 'total')
		)*/);
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('profiles', 'portalid', 'name', 'total', 'pgsz', 'pgno');
	}
	
}

?>
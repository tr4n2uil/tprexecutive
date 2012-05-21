<?php 
require_once(SBSERVICE);

/**
 *	@class WillingnessEditWorkflow
 *	@desc Edits willingness using ID
 *
 *	@param wlgsid long int Willingness ID [memory]
 *	@param name string Name [memory]
 *	@param approval integer Approval [memory] (0=Pending 1=Positive -1=Negative)
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param wgltid long int Willinglist ID [memory] optional default 0
 *	@param wgltname string Willinglist Name [memory] optional default ''
 *
 *	@return wlgsid long int Willingness ID [memory]
 *	@return wgltid long int Willinglist ID [memory]
 *	@return wgltname string Willinglist Name [memory]
 *	@return willingness array Willingness information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillingnessEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'wlgsid', 'name', 'approval', 'wgltid', 'wgltname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.edit.workflow',
			'args' => array('name', 'approval'),
			'input' => array('id' => 'wlgsid', 'cname' => 'name', 'parent' => 'wgltid', 'wgltname' => 'wgltname'),
			'conn' => 'exconn',
			'relation' => '`willingnesses`',
			'type' => 'willingness',
			'sqlcnd' => "set `name`='\${name}', `approval`=\${approval} where `wlgsid`=\${id}",
			'escparam' => array('name'),
			'init' => false,
			'self' => false,
			'check' => false,
			'successmsg' => 'Willingness edited successfully'
		),
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'wlgsid', 'parent' => 'wgltid', 'cname' => 'name', 'wgltname' => 'wgltname'),
			'conn' => 'exconn',
			'relation' => '`willingnesses` w, `students` s, `grades` g',
			'sqlprj' => 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, w.`batch`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`',
			'sqlcnd' => "where `wlgsid`=\${id} and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`",
			'errormsg' => 'Invalid Willingness ID',
			'type' => 'willingness',
			'successmsg' => 'Willingness information given successfully',
			'output' => array('entity' => 'willingness'),
			'auth' => false,
			'track' => false,
			'sinit' => false,
			'cache' => false
		),
		array(
			'service' => 'guard.chain.info.workflow',
			'input' => array('chainid' => 'wgltid'),
			'output' => array('chain' => 'pchain')
		));
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['padmin'] = $memory['admin'];
		$memory['admin'] = 1;
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('wlgsid', 'wgltid', 'wgltname', 'willingness', 'chain', 'pchain', 'admin', 'padmin');
	}
	
}

?>
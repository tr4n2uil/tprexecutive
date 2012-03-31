<?php 
require_once(SBSERVICE);

/**
 *	@class VisitAddWorkflow
 *	@desc Adds new visit
 *
 *	@param vstname string Visit name [memory]
 *	@param type string Type [memory] optional default 'placement' ('placement', 'internship', 'ppo')
 *	@param year integer Year [memory] 
 *	@param package float Package [memory]
 *	@param visitdate string Date of visit [memory] (Format YYYY-MM-DD)
 *	@param deadline string Deadline for willingness [memory] (Format YYYY-MM-DD hh:mm:ss)
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param comid long int Company ID [memory] optional default 0
 *	@param comname string Company Name [memory] optional default ''
 *	@param level integer Web level [memory] optional default false (inherit portal admin access)
 *	@param owner long int Owner ID [memory] optional default keyid
 *
 *	@return visitid long int Visit ID [memory]
 *	@return comid long int Company ID [memory]
 *	@return comname string Company Name [memory]
 *	@return visit array Visit information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class VisitAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'vstname', 'type', 'year', 'package', 'visitdate', 'deadline'),
			'optional' => array('comid' => 0, 'comname' => '', 'level' => false, 'owner' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'added';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.add.workflow',
			'args' => array('vstname', 'type', 'year', 'package', 'visitdate', 'deadline'),
			'input' => array('parent' => 'comid', 'cname' => 'vstname', 'pname' => 'comname'),
			'conn' => 'exconn',
			'relation' => '`visites`',
			'type' => 'visit',
			'sqlcnd' => "(`visitid`, `owner`, `vstname`, `year`, `package`, `visitdate`, `deadline`) values (\${id}, \${owner}, '\${vstname}', \${year}, \${package}, '\${visitdate}', '\${deadline}')",
			'escparam' => array('vstname', 'visitdate', 'deadline'),
			'successmsg' => 'Visit added successfully',
			'construct' => array(
				array(
					'service' => 'storage.directory.add.workflow',
					'name' => 'storage/private/resumes/'.$memory['vstname'],
					'path' => 'storage/private/resumes/'.$memory['vstname'],
					'input' => array('stgid' => 'comid'),
					'output' => array('dirid' => 'resumes')
				),
				array(
					'service' => 'transpera.reference.add.workflow',
					'input' => array('parent' => 'comid', 'cname' => 'vstname', 'pname' => 'comname'),
					'type' => 'forum',
					'output' => array('id' => 'notes')
				)
			),
			'output' => array('id' => 'visitid')
		),
		array(
			'service' => 'transpera.entity.info.workflow',
			'input' => array('id' => 'visitid', 'parent' => 'comid', 'cname' => 'name', 'comname' => 'comname'),
			'conn' => 'exconn',
			'relation' => '`visites`',
			'sqlcnd' => "where `visitid`=\${id}",
			'errormsg' => 'Invalid Visit ID',
			'type' => 'visit',
			'successmsg' => 'Visit information given successfully',
			'output' => array('entity' => 'visit'),
			'auth' => false,
			'track' => false,
			'sinit' => false
		),
		array(
			'service' => 'guard.chain.info.workflow',
			'input' => array('chainid' => 'comid'),
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
		return array('visitid', 'comid', 'comname', 'visit', 'chain', 'pchain', 'admin', 'padmin');
	}
	
}

?>
<?php 
require_once(SBSERVICE);

/**
 *	@class VisitEditWorkflow
 *	@desc Edits visit using ID
 *
 *	@param visitid long int Visit ID [memory]
 *	@param vstname string Visit name [memory]
 *	@param year string Academic Session Year [memory] 
 *	@param vtype string Type [memory] ('placement', 'internship', 'ppo')
 *	@param package float Package [memory]
 *	@param visitdate string Date of visit [memory] (Format YYYY-MM-DD)
 *	@param deadline string Deadline [memory] (Format YYYY-MM-DD)
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param portalid long int Portal ID [memory] optional default COMPANY_PORTAL_ID
 *	@param plname string Portal Name [memory] optional default ''
 *
 *	@return visitid long int Visit ID [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return plname string Portal Name [memory]
 *	@return visit array Visit information [memory]
 *	@return chain array Chain information [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class VisitEditWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'visitid', 'vstname', 'year', 'vtype', 'package', 'visitdate', 'deadline', 'portalid', 'plname')
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
			'args' => array('vstname', 'year', 'vtype', 'package', 'visitdate', 'deadline'),
			'input' => array('id' => 'visitid', 'cname' => 'vstname', 'parent' => 'portalid', 'pname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`visits`',
			'type' => 'visit',
			'sqlcnd' => "set `vstname`='\${vstname}', `year`='\${year}', `vtype`='\${vtype}', `package`='\${package}', `visitdate`='\${visitdate}', `deadline`='\${deadline}' where `visitid`=\${id}",
			'escparam' => array('vstname', 'year', 'vtype', 'package', 'visitdate', 'deadline'),
			'check' => false,
			'successmsg' => 'Visit edited successfully'
		),
		array(
			'service' => 'executive.visit.info.workflow',
			'pgsz' => 5,
			'padmin' => true
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
		return array('visitid', 'visit', 'cutoffs', 'plname', 'portalid', 'ctfadmin', 'vstname', 'files', 'shortlist', 'comid', 'chain', 'pchain', 'admin', 'padmin', 'total', 'pgsz', 'pgno');
	}
	
}

?>
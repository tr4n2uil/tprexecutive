<?php 
require_once(SBSERVICE);

/**
 *	@class VisitAddWorkflow
 *	@desc Adds new visit
 *
 *	@param year string Academic Session Year [memory] 
 *	@param type string Type [memory] ('placement', 'internship', 'ppo')
 *	@param package float Package [memory]
 *	@param comuser string Company username [memory]
 *	@param visitdate string Date of visit [memory] (Format YYYY-MM-DD)
 *	@param deadline string Deadline [memory] (Format YYYY-MM-DD)
 *	@param cer string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param che string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param civ string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param cse string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param eee string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param ece string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param mec string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param met string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param min string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param phe string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param apc string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param apm string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param app string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param bce string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param bme string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *	@param mst string Requirement [memory] ('mr', 'ordinary', 'dream', 'super')
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *	@param portalid long int Portal ID [memory] optional default COMPANY_PORTAL_ID
 *	@param plname string Portal Name [memory] optional default ''
 *	@param level integer Web level [memory] optional default false (inherit portal admin access)
 *	@param owner long int Owner ID [memory] optional default keyid
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
class VisitAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'year', 'vtype', 'package', 'comuser', 'visitdate', 'deadline'),
			'optional' => array('portalid' => COMPANY_PORTAL_ID, 'plname' => '', 'level' => false, 'owner' => false, 'cer' => '', 'che' => '', 'civ' => '', 'cse' => '', 'eee' => '', 'ece' => '', 'mec' => '', 'met' => '', 'min' => '', 'phe' => '', 'apc' => '', 'apm' => '', 'app' => '', 'bce' => '', 'bme' => '', 'mst' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'added';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		
		$memory['vstname'] = $memory['comuser'].'.'.$memory['vtype'].'.'.$memory['year'];
		
		$workflow = array(
		array(
			'service' => 'transpera.relation.unique.workflow',
			'args' => array('comuser'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `username`='\${comuser}'",
			'escparam' => array('comuser'),
			'errormsg' => 'Invalid Company Username',
			'successmsg' => 'Company information given successfully'
		),
		array(
			'service' => 'cbcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'company', 'result.0.comid' => 'comid', 'result.0.owner' => 'comowner', 'company.folder' => 'folder', 'company.name' => 'comname')
		),
		array(
			'service' => 'transpera.entity.add.workflow',
			'args' => array('vstname', 'year', 'vtype', 'package', 'comid', 'comuser', 'visitdate', 'deadline', 'comowner', 'cer', 'che', 'civ', 'cse', 'eee', 'ece', 'mec', 'met', 'min', 'phe', 'apc', 'apm', 'app', 'bce', 'bme', 'mst'),
			'input' => array('parent' => 'portalid', 'cname' => 'vstname', 'pname' => 'plname'),
			'conn' => 'exconn',
			'relation' => '`visits`',
			'type' => 'visit',
			'sqlcnd' => "(`visitid`, `owner`, `comid`, `comuser`, `vstname`, `year`, `vtype`, `package`, `visitdate`, `deadline`, `files`, `shortlist`, `cer`, `che`, `civ`, `cse`, `eee`, `ece`, `mec`, `met`, `min`, `phe`, `apc`, `apm`, `app`, `bce`, `bme`, `mst`) values (\${id}, \${owner}, \${comid}, '\${comuser}', '\${vstname}', '\${year}', '\${vtype}', '\${package}', '\${visitdate}', '\${deadline}', \${files}, \${shortlist}, '\${cer}', '\${che}', '\${civ}', '\${cse}', '\${eee}', '\${ece}', '\${mec}', '\${met}', '\${min}', '\${phe}', '\${apc}', '\${apm}', '\${app}', '\${bce}', '\${bme}', '\${mst}')",
			'escparam' => array('vstname', 'year', 'vtype', 'package', 'visitdate', 'deadline', 'comuser', 'cer', 'che', 'civ', 'cse', 'eee', 'ece', 'mec', 'met', 'min', 'phe', 'apc', 'apm', 'app', 'bce', 'bme', 'mst'),
			'successmsg' => 'Visit added successfully',
			'construct' => array(
				array(
					'service' => 'storage.directory.add.workflow',
					'name' => $memory['year'].'-'.$memory['vtype'].'-'.$memory['visitdate'],
					'path' => 'storage/private/folders/'.$memory['comuser'].'/'.$memory['year'].'-'.$memory['vtype'].'-'.$memory['visitdate'].'/',
					'input' => array('stgid' => 'comid', 'owner' => 'comowner'),
					'output' => array('dirid' => 'files')
				),
				array(
					'service' => 'transpera.reference.add.workflow',
					'type' => 'shortlist',
					'input' => array('owner' => 'comowner'),
					'output' => array('id' => 'shortlist')
				)
			),
			'cparam' => array('files', 'shortlist'),
			'output' => array('id' => 'visitid')
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
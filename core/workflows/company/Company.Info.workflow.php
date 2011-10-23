<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyInfoWorkflow
 *	@desc Returns company information by ID
 *
 *	@param comid long int Company ID [memory] optional default false
 *	@param keyid long int Usage Key ID [memory]
 *	@param indid long int Industry ID [memory] optional default 0
 *	@param indname string Industry name [memory] optional default ''
 *
 *	@return company array Company information [memory]
 *	@return indid long int Industry ID [memory]
 *	@return indname string Industry name [memory]
 *	@return photo long int Company Photo [memory]
 *	@return indphoto long int Industry Photo Space [memory]
 *	@return admin integer Is admin [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyInfoWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('comid' => false, 'indid' => 0, 'indname' => '')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['msg'] = 'Company information given successfully';
		$attr = $memory['comid'] ? 'comid' : 'owner';
		$memory['comid'] = $memory['comid'] ? $memory['comid'] : $memory['keyid'];
		$memory['indphoto'] = 0;
		
		$workflow = array(
		array(
			'service' => 'ad.relation.unique.workflow',
			'args' => array('comid'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlcnd' => "where `$attr`=\${comid}",
			'errormsg' => 'Invalid Company ID'
		),
		array(
			'service' => 'adcore.data.select.service',
			'args' => array('result'),
			'params' => array('result.0' => 'company', 'result.0.photo' => 'photo',  'result.0.comid' => 'comid')
		),
		array(
			'service' => 'ad.reference.read.workflow',
			'input' => array('id' => 'comid')
		),
		array(
			'service' => 'ad.reference.authorize.workflow',
			'input' => array('id' => 'comid'),
			'admin' => true,
			'action' => 'edit'
		));
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('company', 'admin', 'photo', 'indid', 'indname', 'indphoto');
	}
	
}

?>
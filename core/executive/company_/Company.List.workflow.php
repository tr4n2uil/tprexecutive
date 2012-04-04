<?php 
require_once(SBSERVICE);

/**
 *	@class CompanyListWorkflow
 *	@desc Returns all companies information in portal container
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param portalid long int Portal ID [memory] optional default COMPANY_PORTAL_ID
 *	@param pname string Portal name [memory] optional default ''
 *	@param pgsz long int Paging Size [memory] optional default false
 *	@param pgno long int Paging Index [memory] optional default 1
 *	@param total long int Paging Total [memory] optional default false
 *
 *	@return companies array Companies information [memory]
 *	@return portalid long int Portal ID [memory]
 *	@return pname string Portal name [memory]
 *	@return admin integer Is admin [memory]
 *	@return total long int Paging Total [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class CompanyListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('portalid' => COMPANY_PORTAL_ID, 'pname' => '', 'pgsz' => 25, 'pgno' => 0, 'total' => false),
			'set' => array('portalid', 'pname')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'input' => array('id' => 'portalid', 'pname' => 'pname'),
			'conn' => 'exconn',
			'relation' => '`companies`',
			'sqlprj' => '`comid`, `username`, `name`, `resume`, `home`, `interests`',
			'sqlcnd' => "where `comid` in \${list} and `ustatus`<>'N' order by `cgpa` desc",
			'type' => 'company',
			'successmsg' => 'Companies information given successfully',
			'output' => array('entities' => 'companies'),
			'mapkey' => 'comid',
			'mapname' => 'company'
		);
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('companies', 'portalid', 'pname', 'total', 'pgsz', 'pgno');
	}
	
}

?>
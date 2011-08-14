<?php 
require_once(SBSERVICE);

/**
 *	@class BatchAddWorkflow
 *	@desc Adds new batch to department
 *
 *	@param btname string Batch name [memory]
 *	@param keyid long int Usage Key ID [memory]
 *	@param deptid long int Department ID [memory] optional default 0
 *	@param level integer Web level [memory] optional default 1 (department admin access allowed)
 *	@param owner long int Owner Key ID [memory] optional default keyid
 *
 *	@return batchid long int Batch ID [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class BatchAddWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'btname'),
			'optional' => array('deptid' => 0, 'level' => 1, 'owner' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$kernel = new WorkflowKernel();
		
		$memory['owner'] = $memory['owner'] ? $memory['owner'] : $memory['keyid'];
		$memory['msg'] = 'Batch added successfully';
		
		$workflow = array(
		array(
			'service' => 'sb.reference.add.workflow',
			'input' => array('parent' => 'deptid'),
			'authorize' => 'edit:add:remove',
			'output' => array('id' => 'batchid')
		),
		array(
			'service' => 'griddata.space.add.workflow',
			'spname' => 'storage/Batch_'.$memory['btname'].'_Resumes',
			'sppath' => 'storage/batch_'.$memory['btname'].'_resumes/',
			'input' => array('cntrid' => 'deptid'),
			'output' => array('spaceid' => 'resume')
		),
		array(
			'service' => 'griddata.space.add.workflow',
			'spname' => 'storage/Batch_'.$memory['btname'].'_Photos',
			'sppath' => 'storage/batch_'.$memory['btname'].'_photos/',
			'input' => array('cntrid' => 'deptid'),
			'output' => array('spaceid' => 'photo')
		),
		array(
			'service' => 'sb.relation.insert.workflow',
			'args' => array('batchid', 'owner', 'btname', 'resume', 'photo'),
			'conn' => 'exconn',
			'relation' => '`batches`',
			'sqlcnd' => "(`batchid`, `owner`, `btname`, `resume`, `photo`) values (\${batchid}, \${owner}, '\${btname}', \${resume}, \${photo})",
			'escparam' => array('btname')
		));
		
		return $kernel->execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('batchid');
	}
	
}

?>
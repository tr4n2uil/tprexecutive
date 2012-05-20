<?php 
require_once(SBSERVICE);

/**
 *	@class WillingnessListWorkflow
 *	@desc Returns all willingnesses information in post
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param wgltid/id long int Willinglist/Visit ID [memory] optional default 0
 *	@param wgltname/name string Willinglist name [memory] optional default ''
 *
 *	@param pgsz long int Paging Size [memory] optional default 50
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return willingnesses array Willingnesss information [memory]
 *	@return wgltid long int Willinglist/Visit ID [memory]
 *	@return wgltname string Willinglist Name [memory]
 *	@return admin integer Is admin [memory]
 *	@return padmin integer Is parent admin [memory]
 *	@return pchain array Parent chain information [memory]
 *	@return pgsz long int Paging Size [memory]
 *	@return pgno long int Paging Index [memory]
 *	@return total long int Paging Total [memory]
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class WillingnessListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'wgltid' => false, 'id' => 0, 'wgltname' => false, 'name' => '', 'pgsz' => 15, 'pgno' => 0, 'total' => false, 'padmin' => true),
			'set' => array('id', 'name')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['wgltid'] = $memory['wgltid'] ? $memory['wgltid'] : $memory['id'];
		$memory['wgltname'] = $memory['wgltname'] ? $memory['wgltname'] : $memory['name'];
		
		if($memory['wgltname'] == '')
			$qry = "w.`visitid`=\${wgltid}";
		else
			$qry = "w.`wlgsid` in \${list}";
		
		$service = array(
			'service' => 'transpera.entity.list.workflow',
			'args' => array('wgltid'),
			'input' => array('id' => 'wgltid', 'wgltname' => 'wgltname'),
			'conn' => 'exconn',
			'relation' => '`willingnesses` w, `students` s, `grades` g',
			'type' => 'willingness',
			'sqlprj' => 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`',
			'sqlcnd' => "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`",
			'successmsg' => 'Willingnesses information given successfully',
			'lsttrack' => true,
			'output' => array('entities' => 'willingnesses'),
			'mapkey' => 'wlgsid',
			'mapname' => 'willingness',
			'saction' => 'add'
		);
		
		$memory = Snowblozm::run($service, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['uiadmin'] = ($memory['admin'] || $memory['padmin']) && ($memory['wgltname'] != '');
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willingnesses', 'wgltid', 'wgltname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'uiadmin');
	}
	
}

?>
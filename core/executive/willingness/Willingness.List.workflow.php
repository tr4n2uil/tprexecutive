<?php 
require_once(SBSERVICE);

/**
 *	@class WillingnessListWorkflow
 *	@desc Returns all willingnesses information in post
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param wgltid/id long int Willinglist/Visit ID [memory] optional default 0
 *	@param wgltname/name string Willinglist name [memory] optional default ''
 *	@param export boolean Is Export [memory] optional default false
 *	@param archive boolean Is Archive [memory] optional default false
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
			'optional' => array('user' => '', 'wgltid' => false, 'id' => 0, 'wgltname' => false, 'name' => '', 'pgsz' => 15, 'pgno' => 0, 'total' => false, 'padmin' => true, 'export' => false, 'archive' => false, 'me' => false),
			'set' => array('id', 'name', 'me')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['wgltid'] = $memory['wgltid'] ? $memory['wgltid'] : $memory['id'];
		$memory['wgltname'] = $memory['wgltname'] ? $memory['wgltname'] : $memory['name'];
		$memory['resumelist'] = '';
		
		if($memory['wgltname'] == '')
			$qry = "w.`visitid`=\${wgltid}";
		else
			$qry = "w.`wlgsid` in \${list}";
		
		if($memory['me']){
			$qry = "s.`stdid`=\${wgltid}";
			$rel = '`willingnesses` w, `students` s, `visits` v';
			$prj = 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name`, w.`batch`, s.`stdid`, s.`username`, v.`comuser`, v.`comid`, v.`vtype`, v.`year`, v.`visitdate`, v.`package`';
			$cnd = "where $qry and w.`owner`=s.`owner` and v.`visitid`=w.`visitid` order by w.`wlgsid` desc";
			$authcustom = false;
		}
		elseif($memory['export']){
			$rel = '`willingnesses` w, `students` s, `grades` g, `persons` p, `batches` b';
			$prj = "s.`name`, s.`rollno`, 
			(case b.`course` when 'btech' then 'B Tech' when 'idd' then 'IDD / IMD' when 'mtech' then 'M Tech' else '' end) as `course`, 
			(case b.`dept` when 'cer' then 'Ceramic Engineering' when 'che' then 'Chemical Engineering' when 'civ' then 'Civil Engineering' when 'cse' then 'Computer Engineering' when 'eee' then 'Electrical Engineering' when 'ece' then 'Electronics Engineering' when 'mec' then 'Mechanical Engineering' when 'met' then 'Metallurgical Engineering' when 'min' then 'Mining Engineering' when 'phe' then 'Pharmaceutical Engineering' when 'apc' then 'Applied Chemistry' when 'apm' then 'Applied Mathematics' when 'app' then 'Applied Physics' when 'bce' then 'Bio-Chemical Engineering' when 'bme' then 'Bio-Medical Engineering' when 'mst' then 'Material Science & Technology' else '' end) as `dept`, b.`year`, s.`email`, p.`phone`, p.`dateofbirth`, p.`gender`, g.`cgpa`, g.`sscx`, g.`hscxii`, g.`sgpa1`, g.`sgpa2`, g.`sgpa3`, g.`sgpa4`, g.`sgpa5`, g.`sgpa6`, g.`sgpa7`, g.`sgpa8`, g.`sgpa9`, g.`sgpa10`, g.`ygpa1`, g.`ygpa2`, g.`ygpa3`, g.`ygpa4`, g.`ygpa5`";
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid` and p.`pnid`=s.`stdid` and b.`batchid`=w.`batchid`";
			$authcustom = false;
		}
		elseif($memory['archive']){
			$rel = '`willingnesses` w, `students` s, `directories` d, `files` f';
			$prj = "concat(s.`name`, '[', s.`rollno`, '].pdf') as `asname`, d.`path` as `filepath`, f.`filename`, (case w.`resume` when 0 then s.`resume` else w.`resume` end) as `fresume`";
			$cnd = "where $qry and w.`owner`=s.`owner` and f.`fileid`=(case w.`resume` when 0 then s.`resume` else w.`resume` end) and d.`dirid`=w.`resdir`";
			$authcustom = false;
		}
		else {
			$rel = '`willingnesses` w, `students` s, `grades` g';
			$prj = 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, w.`batch`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`';
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`";
			$authcustom = array(
				array(
					'service' => 'transpera.relation.unique.workflow',
					'args' => array('keyid'),
					'conn' => 'exconn',
					'relation' => '`students`',
					'sqlprj' => '`stdid`',
					'sqlcnd' => "where `owner`=\${keyid}",
					'errormsg' => 'Unable to Authorize',
					'successmsg' => 'Student information given successfully'
				),
				array(
					'service' => 'cbcore.data.select.service',
					'args' => array('result'),
					'params' => array('result.0.stdid' => 'stdid')
				),
				array(
					'service' => 'transpera.relation.unique.workflow',
					'args' => array('stdid'),
					'conn' => 'cbconn',
					'relation' => '`chains`',
					'sqlprj' => '`parent`',
					'sqlcnd' => "where `type`='person' and `chainid`=\${stdid}",
					'errormsg' => 'Unable to Authorize',
					'successmsg' => 'Parent information given successfully'
				),
				array(
					'service' => 'cbcore.data.select.service',
					'args' => array('result'),
					'params' => array('result.0.parent' => 'parent')
				),
				array(
					'service' => 'transpera.relation.unique.workflow',
					'args' => array('chainid', 'parent'),
					'conn' => 'exconn',
					'relation' => '`batches`',
					'sqlcnd' => "where `batchid`=(select `batchid` from `willinglists` where `wgltid`=\${chainid}) and `dept`=(select `dept` from `batches` where `batchid`=\${parent})",
					'errormsg' => 'Unable to Authorize',
					'successmsg' => 'Batch information given successfully'
				),
			);
		}
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.list.workflow',
			'args' => array('wgltid'),
			'input' => array('id' => 'wgltid', 'wgltname' => 'wgltname'),
			'conn' => 'exconn',
			'relation' => $rel,
			'type' => 'willingness',
			'sqlprj' => $prj,
			'sqlcnd' => $cnd,
			'successmsg' => 'Willingnesses information given successfully',
			//'lsttrack' => true,
			'output' => array('entities' => 'willingnesses'),
			'action' => 'add',
			'ismap' => !$memory['export'] && !$memory['archive'],
			'mapkey' => 'wlgsid',
			'mapname' => 'willingness',
			'saction' => 'add',
			'authcustom' => $authcustom
		));
		
		if($memory['export']){
			array_push($workflow, array(
				'service' => 'cbcore.data.export.service',
				'input' => array('data' => 'willingnesses'),
				'type' => 'csv',
				'default' => "Student Name,Roll No,Course,Department,Year,Email,Phone,Date of Birth,Gender,CGPA,X %,XII %,SGPA I,SGPA II,SGPA III,SGPA IV,SGPA V,SGPA VI,SGPA VII,SGPA VIII,SGPA IX,SGPA X,YGPA I,YGPA II,YGPA III,YGPA IV,YGPA V\r\n",
				'filename' => 'Willingness.'.$memory['wgltname'].'.'.$memory['user'].'.csv',
				'output' => array('result' => 'csv')
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['wgltname'].'.'.$memory['user'].'.csv',
				'mime' => 'application/vnd.ms-excel'
			));
		}
		
		if($memory['archive']){
			array_push($workflow, array(
				'service' => 'storage.file.archive.service',
				'input' => array('filelist' => 'willingnesses'),
				'directory' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['wgltname'].'.'.$memory['user'].'.zip',
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['wgltname'].'.'.$memory['user'].'.zip',
				'mime' => 'application/zip'
			));
		}
		
		if($memory['me']){
			array_push($workflow, array(
				'service' => 'executive.batch.find.workflow',
				'input' => array('btname' => 'wgltname')
			),
			array(
				'service' => 'storage.file.list.workflow',
				'input' => array('dirid' => 'resumes', 'filter' => 'keyid'),
				'output' => array('files' => 'resumelist', 'admin' => 'fadmin', 'padmin' => 'fpadmin', 'pchain' => 'fpchain')
			));
		}
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['uiadmin'] = ($memory['admin'] || $memory['padmin']) && ($memory['wgltname'] != '');
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willingnesses', 'wgltid', 'wgltname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'uiadmin', 'resumelist');
	}
	
}

?>
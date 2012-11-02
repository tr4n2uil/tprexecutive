<?php 
require_once(SBSERVICE);

/**
 *	@class WillingnessListWorkflow
 *	@desc Returns all willingnesses information in post
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param visitid/id long int Visit ID [memory] optional default 0
 *	@param btname/name string Batch name [memory] optional default ''
 *	@param export boolean Is Export [memory] optional default false
 *	@param archive boolean Is Archive [memory] optional default false
 *	@param me boolean Is Opportunity [memory] optional default false
 *
 *	@param pgsz long int Paging Size [memory] optional default 50
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return willingnesses array Willingnesss information [memory]
 *	@return visitid long int Visit ID [memory]
 *	@return vstname string Visit Name [memory]
 *	@return batchid long int Batch ID [memory]
 *	@return btname string Batch Name [memory]
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
			'optional' => array('user' => '', 'visitid' => false, 'id' => 0, 'btname' => false, 'name' => '', 'pgsz' => false, 'pgno' => 0, 'total' => false, 'padmin' => true, 'export' => false, 'archive' => false, 'me' => false),
			'set' => array('id', 'name', 'me')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['visitid'] = $memory['visitid'] ? $memory['visitid'] : $memory['id'];
		$memory['btname'] = $memory['btname'] ? $memory['btname'] : $memory['name'];
		$memory['resumelist'] = '';
		$name = $memory['btname'] != '' ? 'Willingness.'.$memory['btname'].'.'.$memory['user'] : 'Willing Candidates.'.$memory['user'];
		$memory['batchid'] = $memory['visitid'];
		
		if($memory['btname'] == ''){
			$qry = "w.`visitid`=\${visitid} and (w.`status`=1 and w.`approval`>-1)";
		}
		elseif($memory['export'] || $memory['archive'])
			$qry = "w.`visitid`=\${visitid} and w.`batch`='\${btname}' and (w.`status`=1 and w.`approval`>-1)";
		else
			$qry = "w.`visitid`=\${visitid} and w.`batch`='\${btname}'";
			
		$batchauth = array(
			array(
				'service' => 'transpera.relation.unique.workflow',
				'args' => array('keyid'),
				'conn' => 'exconn',
				'relation' => '`students`',
				'sqlprj' => '`stdid`',
				'sqlcnd' => "where `owner`=\${keyid} and `ustatus`<>'0'",
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
				'sqlcnd' => "where `batchid`=\${chainid} and `dept`=(select `dept` from `batches` where `batchid`=\${parent})",
				'errormsg' => 'Unable to Authorize',
				'successmsg' => 'Batch information given successfully'
			),
		);
		
		if($memory['me']){
			$rel = '`willingnesses` w, `students` s, `visits` v';
			$prj = "w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, w.`batch`, s.`stdid`, s.`username`, v.`comuser`, v.`comid`, v.`vtype`, v.`year`, v.`visitdate`, (case (select `course` from `batches` where `btname`=w.`batch`) when 'btech' then v.`bpackage` when 'idd' then v.`ipackage` when 'mtech' then v.`mpackage` else '' end) as `package`, v.`vstatus`";
			$cnd = "where s.`stdid`=\${visitid} and w.`owner`=s.`owner` and v.`visitid`=w.`visitid` order by w.`wlgsid` desc";
			$authcustom = $batchauth;
		}
		elseif($memory['export']){
			$rel = '`willingnesses` w, `students` s, `grades` g, `persons` p, `batches` b';
			$prj = "(case w.`status` when 0 then 'Eligible' when 1 then 'Willing' when -1 then 'Not Willing' else '' end) as `wstatus`, s.`name`, s.`rollno`, 
			(case b.`course` when 'btech' then 'B Tech' when 'idd' then (case b.`dept` when 'apc' then 'IMD' when 'apm' then 'IMD' when 'app' then 'IMD' else 'IDD' end) when 'mtech' then 'M Tech' else '' end) as `course`, s.`specialization`,
			(case b.`dept` when 'cer' then 'Ceramic Engineering' when 'che' then 'Chemical Engineering' when 'civ' then 'Civil Engineering' when 'cse' then 'Computer Engineering' when 'eee' then 'Electrical Engineering' when 'ece' then 'Electronics Engineering' when 'mec' then 'Mechanical Engineering' when 'met' then 'Metallurgical Engineering' when 'min' then 'Mining Engineering' when 'phe' then 'Pharmaceutical Engineering' when 'apc' then 'Industrial Chemistry' when 'apm' then 'Mathematics and Computing' when 'app' then 'Engineering Physics' when 'bce' then 'Bio-Chemical Engineering' when 'bme' then 'Bio-Medical Engineering' when 'mst' then 'Material Science & Technology' else '' end) as `dept`, b.`year`, s.`email`, p.`phone`, p.`address`, s.`resphone`, s.`resaddress`, s.`city`, p.`dateofbirth`, p.`gender`, s.`category`, s.`language`, s.`father`, s.`foccupation`, s.`mother`, s.`moccupation`, g.`cgpa`, g.`sscx`, g.`sscyear`, g.`hscxii`, g.`hscyear`, g.`gradcent`, g.`gradyear`, g.`jee`, g.`gate`, g.`sgpa1`, g.`sgpa2`, g.`sgpa3`, g.`sgpa4`, g.`sgpa5`, g.`sgpa6`, g.`sgpa7`, g.`sgpa8`, g.`sgpa9`, g.`sgpa10`, g.`ygpa1`, g.`ygpa2`, g.`ygpa3`, g.`ygpa4`, g.`ygpa5`";
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid` and p.`pnid`=s.`stdid` and b.`batchid`=w.`batchid`";
			$authcustom = false;
		}
		elseif($memory['archive']){
			$rel = '`willingnesses` w, `students` s, `directories` d, `files` f';
			$prj = "concat(s.`rollno`, '_', s.`name`, '_Resume.pdf') as `asname`, d.`path` as `filepath`, f.`filename`, (case w.`resume` when 0 then s.`resume` else (select `fileid` from `files` where `fileid`=w.`resume`) end) as `fresume`";
			$cnd = "where $qry and w.`owner`=s.`owner` and f.`fileid`=(case w.`resume` when 0 then (select max(`fileid`) from `files` where `owner`=s.`owner`) else if((select `fileid` from `files` where `fileid`=w.`resume`), w.`resume`, (select max(`fileid`) from `files` where `owner`=s.`owner`)) end) and d.`dirid`=w.`resdir`";
			$authcustom = false;
		}
		else {
			$rel = '`willingnesses` w, `students` s, `grades` g';
			$prj = 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, w.`batch`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`';
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`";
			$authcustom = $batchauth;
		}
		
		$workflow = array(
		array(
			'service' => 'transpera.entity.list.workflow',
			'args' => array('batchid', 'btname', 'visitid'),
			'input' => array('id' => 'batchid', 'pname' => 'btname'),
			'conn' => 'exconn',
			'relation' => $rel,
			'type' => 'willingness',
			'sqlprj' => $prj,
			'sqlcnd' => $cnd,
			'successmsg' => 'Willingnesses information given successfully',
			'escparam' => array('btname'),
			//'lsttrack' => true,
			'output' => array('entities' => 'willingnesses'),
			'action' => 'add',
			'ismap' => !$memory['export'] && !$memory['archive'],
			'mapkey' => 'wlgsid',
			'mapname' => 'willingness',
			'saction' => 'add',
			'authcustom' => $authcustom
		));
		
		if($memory['btname'] != ''){
			array_unshift($workflow, array(
				'service' => 'executive.batch.find.workflow',
				'export' => false,
				'archive' => false
			));
		}
		
		if($memory['export']){
			array_push($workflow, array(
				'service' => 'cbcore.data.export.service',
				'input' => array('data' => 'willingnesses'),
				'type' => 'csv',
				'default' => '"Status","Student Name","Roll No","Course","Specialization","Department","Year of Passing","Email","Phone","Address (Current)","Phone (Residential)","Address (Permanent)","City","Date of Birth","Gender","Category","Mother Tongue","Father\'s Name","Father\'s Occupation","Mother\'s Name","Mother\'s Occupation","CGPA","X %","X Year of Passing","XII %","XII Year of Passing","Graduation %","Graduation Year of Passing","JEE AIR","GATE AIR","SGPA I","SGPA II","SGPA III","SGPA IV","SGPA V","SGPA VI","SGPA VII","SGPA VIII","SGPA IX","SGPA X","YGPA I","YGPA II","YGPA III","YGPA IV","YGPA V"'."\r\n",
				'filename' => $name.'.csv',
				'output' => array('result' => 'csv')
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => $name.'.csv',
				'mime' => 'application/vnd.ms-excel'
			));
		}
		
		if($memory['archive']){
			array_push($workflow, array(
				'service' => 'storage.file.archive.service',
				'input' => array('filelist' => 'willingnesses'),
				'directory' => 'storage/private/exports/',
				'filename' => $name.'.zip',
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => $name.'.zip',
				'mime' => 'application/zip'
			));
		}
		
		if($memory['me']){
			array_push($workflow, array(
				'service' => 'storage.file.list.workflow',
				'input' => array('dirid' => 'resumes', 'filter' => 'keyid'),
				'output' => array('files' => 'resumelist', 'admin' => 'fadmin', 'padmin' => 'fpadmin', 'pchain' => 'fpchain')
			));
		}
		
		$memory = Snowblozm::execute($workflow, $memory);
		if(!$memory['valid'])
			return $memory;
			
		$memory['uiadmin'] = ($memory['admin'] || $memory['padmin']) && ($memory['btname'] != '');
		$memory['vstname'] = isset($memory['willingnesses'][0]) ? $memory['willingnesses'][0]['willingness']['wname'] : '';
		
		return $memory;
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('willingnesses', 'visitid', 'vstname', 'batchid', 'btname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'uiadmin', 'resumelist');
	}
	
}

?>
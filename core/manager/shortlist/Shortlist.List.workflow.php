<?php 
require_once(SBSERVICE);

/**
 *	@class ShortlistListWorkflow
 *	@desc Returns all shortlist information
 *
 *	@param keyid long int Usage Key ID [memory]
 *	@param shlstid/id long int Shortlist ID [memory]
 *	@param shlstname/name string Shortlist name [memory] optional default ''
 *	@param export boolean Is Export [memory] optional default false
 *	@param archive boolean Is Archive [memory] optional default false
 *	@param me boolean Is Selection [memory] optional default false
 *
 *	@param pgsz long int Paging Size [memory] optional default 50
 *	@param pgno long int Paging Index [memory] optional default 0
 *	@param total long int Paging Total [memory] optional default false
 *	@param padmin boolean Is parent information needed [memory] optional default true
 *
 *	@return selections array Selections information [memory]
 *	@return stages array Stages information [memory]
 *	@return shlstid long int Shortlist ID [memory]
 *	@return shlstname string Shortlist Name [memory]
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
class ShortlistListWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid'),
			'optional' => array('user' => '', 'shlstid' => false, 'id' => 0, 'shlstname' => false, 'name' => '', 'pgsz' => 15, 'pgno' => 0, 'total' => false, 'padmin' => true, 'export' => false, 'archive' => false, 'me' => false),
			'set' => array('id', 'name', 'me')
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['shlstid'] = $memory['shlstid'] ? $memory['shlstid'] : $memory['id'];
		$memory['shlstname'] = $memory['shlstname'] ? $memory['shlstname'] : $memory['name'];
		
		$qry = "l.`selid` in \${list}";
		
		if($memory['me']){
			$rel = '`selections` l, `stages` t, `students` s, `visits` v';
			$prj = 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name`, w.`batch`, s.`stdid`, s.`username`, v.`comuser`, v.`comid`, v.`vtype`, v.`year`, v.`visitdate`, v.`package`';
			$cnd = "where s.`stdid`=\${shlstid} and w.`owner`=s.`owner` and v.`visitid`=w.`visitid` order by w.`wlgsid` desc";
		}
		elseif($memory['export']){
			$rel = '`willingnesses` w, `students` s, `grades` g, `persons` p, `batches` b';
			$prj = "s.`name`, s.`rollno`, 
			(case b.`course` when 'btech' then 'B Tech' when 'idd' then 'IDD / IMD' when 'mtech' then 'M Tech' else '' end) as `course`, 
			(case b.`dept` when 'cer' then 'Ceramic Engineering' when 'che' then 'Chemical Engineering' when 'civ' then 'Civil Engineering' when 'cse' then 'Computer Engineering' when 'eee' then 'Electrical Engineering' when 'ece' then 'Electronics Engineering' when 'mec' then 'Mechanical Engineering' when 'met' then 'Metallurgical Engineering' when 'min' then 'Mining Engineering' when 'phe' then 'Pharmaceutical Engineering' when 'apc' then 'Applied Chemistry' when 'apm' then 'Applied Mathematics' when 'app' then 'Applied Physics' when 'bce' then 'Bio-Chemical Engineering' when 'bme' then 'Bio-Medical Engineering' when 'mst' then 'Material Science & Technology' else '' end) as `dept`, b.`year`, s.`email`, p.`phone`, p.`dateofbirth`, p.`gender`, g.`cgpa`, g.`sscx`, g.`hscxii`, g.`sgpa1`, g.`sgpa2`, g.`sgpa3`, g.`sgpa4`, g.`sgpa5`, g.`sgpa6`, g.`sgpa7`, g.`sgpa8`, g.`sgpa9`, g.`sgpa10`, g.`ygpa1`, g.`ygpa2`, g.`ygpa3`, g.`ygpa4`, g.`ygpa5`";
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid` and p.`pnid`=s.`stdid` and b.`batchid`=w.`batchid`";
		}
		elseif($memory['archive']){
			$rel = '`willingnesses` w, `students` s, `directories` d, `files` f';
			$prj = "concat(s.`name`, '[', s.`rollno`, '].pdf') as `asname`, d.`path` as `filepath`, f.`filename`, (case w.`resume` when 0 then s.`resume` else w.`resume` end) as `fresume`";
			$cnd = "where $qry and w.`owner`=s.`owner` and f.`fileid`=(case w.`resume` when 0 then s.`resume` else w.`resume` end) and d.`dirid`=w.`resdir`";
		}
		else {
			$rel = '`willingnesses` w, `students` s, `grades` g';
			$prj = 'w.`wlgsid`, w.`visitid`, w.`resume`, w.`status`, w.`approval`, w.`name` as `wname`, w.`batch`, s.`stdid`, s.`username`, s.`name`, s.`email`, s.`rollno`, g.`cgpa`, g.`sscx`, g.`hscxii`';
			$cnd = "where $qry and w.`owner`=s.`owner` and s.`grade`=g.`gradeid`";
		}
		
		$workflow = array(
		array(
			'service' => 'shortlist.stage.list.workflow',
		),
		array(
			'service' => 'transpera.entity.list.workflow',
			'args' => array('shlstid'),
			'input' => array('id' => 'shlstid', 'shlstname' => 'shlstname'),
			'conn' => 'exconn',
			'relation' => $rel,
			'type' => 'selection',
			'sqlprj' => $prj,
			'sqlcnd' => $cnd,
			'successmsg' => 'Selections information given successfully',
			'output' => array(
				'entities' => 'selections',
				'admin' => 'sladmin', 
				'padmin' => 'slpadmin', 
				'pchain' => 'slpchain', 
				'total' => 'sltotal', 
				'pgno' => 'slpgno', 
				'pgsz' => 'slpgsz'
			)
			'action' => 'add',
			'ismap' => !$memory['export'] && !$memory['archive'],
			'mapkey' => 'selid',
			'mapname' => 'selection',
			'saction' => 'add'
		));
		
		if($memory['export']){
			array_push($workflow, array(
				'service' => 'cbcore.data.export.service',
				'input' => array('data' => 'willingnesses'),
				'type' => 'csv',
				'default' => "Student Name,Roll No,Course,Department,Year,Email,Phone,Date of Birth,Gender,CGPA,X %,XII %,SGPA I,SGPA II,SGPA III,SGPA IV,SGPA V,SGPA VI,SGPA VII,SGPA VIII,SGPA IX,SGPA X,YGPA I,YGPA II,YGPA III,YGPA IV,YGPA V\r\n",
				'filename' => 'Willingness.'.$memory['shlstname'].'.'.$memory['user'].'.csv',
				'output' => array('result' => 'csv')
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['shlstname'].'.'.$memory['user'].'.csv',
				'mime' => 'application/vnd.ms-excel'
			));
		}
		
		if($memory['archive']){
			array_push($workflow, array(
				'service' => 'storage.file.archive.service',
				'input' => array('filelist' => 'willingnesses'),
				'directory' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['shlstname'].'.'.$memory['user'].'.zip',
			),
			array(
				'service' => 'storage.file.download.service',
				'filepath' => 'storage/private/exports/',
				'filename' => 'Willingness.'.$memory['shlstname'].'.'.$memory['user'].'.zip',
				'mime' => 'application/zip'
			));
		}
		
		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array('selections', 'stages', 'shlstid', 'shlstname', 'admin', 'padmin', 'pchain', 'total', 'pgno', 'pgsz', 'sladmin', 'slpadmin', 'slpchain', 'sltotal', 'slpgno', 'slpgsz');
	}
	
}

?>
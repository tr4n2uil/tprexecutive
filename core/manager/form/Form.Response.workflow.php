<?php 
require_once(SBSERVICE);

/**
 *	@class FormResponseWorkflow
 *	@desc Accepts new response sheet submission
 *
 *	@param name string Company Name [memory]
 *	@param regtype string Registration Type [memory]
 *	@param regtype string Registration Type [memory] optional default ''
 *	@param indsector array Industry Sector [memory] optional default array()
 *	@param funreq array Functional Requirements [memory] optional default array()
 *	@param motto string Motto [memory] optional default ''
 *	@param compsnname string Company Person Name [memory]
 *	@param compsnpost string Company Person Post [memory]
 *	@param compsnemail string Company Person Email [memory]
 *	@param compsnphone string Company Person Phone [memory]
 *	@param sccgpa string CGPA Limit [memory] optional default ''
 *	@param scagelimit string Age Limit [memory] optional default ''
 *	@param seltest array Tests [memory] optional default array()
 *	@param selgd string GD [memory] optional default ''
 *	@param selinterview array Interviews [memory] optional default array()
 *	@param selagrmnt string Service Agreement [memory] optional default ''
 *	@param seltrprd string Training Period [memory] optional default ''
 *	@param reqmnt array Requirements [memory] optional default array()
 *	@param tectc string CTC [memory]
 *	@param teinhand string Inhand [memory] optional default ''
 *	@param keyid long int Usage Key ID [memory]
 *	@param user string Key User [memory]
 *
 *	@param mailto string Mail To [memory] optional default 'form_mailto' Snowblozm ['reponse']
 *
 *	@author Vibhaj Rajan <vibhaj8@gmail.com>
 *
**/
class FormResponseWorkflow implements Service {
	
	/**
	 *	@interface Service
	**/
	public function input(){
		return array(
			'required' => array('keyid', 'user', 'name', 'compsnname', 'compsnpost', 'compsnemail', 'compsnphone', 'tectc'),
			'optional' => array('regtype' => '', 'indsector' => array(), 'funreq' => array(), 'motto' => '', 'sccgpa' => '', 'scagelimit' => '', 'seltest' => array(), 'selgd' => '', 'selinterview' => array(), 'selagrmnt' => '', 'seltrprd' => '', 'reqmnt' => array(), 'teinhand' => '', 'mailto' => false)
		);
	}
	
	/**
	 *	@interface Service
	**/
	public function run($memory){
		$memory['verb'] = 'added';
		$memory['join'] = 'on';
		$memory['public'] = 1;
		$memory['queid'] = FORM_ID;
		$memory['msg'] = 'Response Submitted Successfully';
		
		//if(!$memory['mailto']){
		$mailto = Snowblozm::get('form_mailto');
		$memory['mailto'] = $mailto['response'].','.$memory['compsnemail'];
		//}
		
		$memory['body'] = '<h2>Company Response Sheet Submission</h2>
		<style type="text/css">
		ul { margin: 0; padding: 0; }
		table td { vertical-align: top; padding: 5px; }
		</style>
		<table class="formtable thovered"><tbody>
			<tr><td colspan="2" class="section">
			<h3>Basic Information</h3>
			<td></tr>
			<tr><td>Name of the Company</td><td>'.$memory['name'].'</td></tr>
			<tr><td>Type</td><td>'.$memory['regtype'].'</td></tr>
			<tr><td>Industry Sector(s)</td><td><ul>';
		
		foreach($memory['indsector'] as $data)	$memory['body'] .= "<li>$data</li>";
			
		$memory['body'] .= '
			</ul></td></tr>
			<tr><td>Requirement(s) in terms of Functional Areas</td><td><ol>';
		
		foreach($memory['funreq'] as $data)	$memory['body'] .= "<li>$data</li>";
		
		$memory['body'] .= '
			</ol></td></tr>
			<tr><td>Vision &amp; Interests</td><td>'.$memory['motto'].'</td></tr>
			
			<tr><td colspan="2" class="section">
			<h3>Contact Person from Organization</h3>
			<td></tr>
			<tr><td>Name</td><td>'.$memory['compsnname'].'</td></tr>
			<tr><td>Designation</td><td>'.$memory['compsnpost'].'</td></tr>
			<tr><td>Email</td><td>'.$memory['compsnemail'].'</td></tr>
			<tr><td>Phone</td><td>'.$memory['compsnphone'].'</td></tr>
			
			<tr><td colspan="2" class="section">
			<h3>Shortlisting Cliteria</h3>
			<td></tr>
			<tr><td>CGPA (on 10 point scale)</td><td>'.$memory['sccgpa'].'</td></tr>
			<tr><td>Age Limits (if any)</td><td>'.$memory['scagelimit'].'</td></tr>			
			
			<tr><td colspan="2" class="section">
			<h3>Selection Process</h3>
			<td></tr>
			<tr><td>Test(s)</td><td><ul>';
			
		foreach($memory['seltest'] as $data)	$memory['body'] .= "<li>$data</li>";
		
		$memory['body'] .= '
			</ul></td></tr>
			<tr><td>Group Discussion</td><td>'.$memory['selgd'].'</td></tr>
			<tr><td>Personal Interview(s)</td><td><ul>';
			
		foreach($memory['selinterview'] as $data)	$memory['body'] .= "<li>$data</li>";
		
		$memory['body'] .= '
			</ul></td></tr>
			<tr><td>Service Agreement (if any)</td><td>'.$memory['selagrmnt'].'</td></tr>
			<tr><td>Training Period (if any)</td><td>'.$memory['seltrprd'].'</td></tr>
			
			<tr><td colspan="2" class="section">
			<h3>Students\' Profile and Your Tentative Requirement</h3><p class="desc">(expected, not necessarily committed)</p>
			<td></tr>
			<tr><td>Selections</td><td><ul>';
			
		foreach($memory['reqmnt'] as $data)	$memory['body'] .= "<li>$data</li>";
			
		$memory['body'] .= '
			</ul></td></tr>
			
			<tr><td colspan="2" class="section">
			<h3>Total Emoluments</h3>
			<td></tr>
			<tr><td>CTC</td><td>'.$memory['tectc'].'</td></tr>
			<tr><td>In Hand</td><td>'.$memory['teinhand'].'</td></tr>
			
			</tbody></table>
		<br />
		<br />
		--<br />
		TPO Portal Online Forms<br />
		IT BHU Training &amp; Placement Cell
		';
		
		$workflow = array(
		array(
			'service' => 'queue.mail.add.workflow',
			'input' => array('to' => 'mailto'),
			'subject' => '[Response Sheet] '.$memory['name']
		), 
		array(
			'service' => 'queue.mail.send.workflow'
		));

		return Snowblozm::execute($workflow, $memory);
	}
	
	/**
	 *	@interface Service
	**/
	public function output(){
		return array();
	}
	
}

?>

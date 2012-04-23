<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<base href="<?php echo ROOTPATH ?>/"  />
		<link rel='shortcut icon' href="ui/img/executive/itbhu.png"/>
		<!--<link rel="stylesheet" type="text/css" href="ui/css/jquery.jtweetsanywhere-1.3.1.css" />-->
		<title>Training &amp; Placement Cell, IT BHU</title>
		<link rel="stylesheet" type="text/css" href="ui/css/datatable/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="ui/css/executive-ui.css" />
		<script charset="utf-8" type="text/javascript" src="ui/js/executive-ui.js"></script>
		<script type="text/javascript" src="ui/js/jquery.dataTables.js"></script>
		<script type="text/javascript">
			Executive.root = '<?php echo ROOTPATH; ?>';
			Executive.year = '?/<?php echo $YEAR; ?>/';
		</script>
	</head>

	<body>
		<div class="body">
		<span id="load-status"><?php echo $STATUS; ?></span>
		<div>
			<div class="itbhu-logo fleft"></div>
			<div class="header">
				<p class="head1">Training &amp; Placement Cell</p>
				<p class="head2">Institute of Technology, Banaras Hindu University</p>
				<p>Varanasi, India - 221 005</p>
				<p class="head4">
					<a href="mailto:tpo@itbhu.ac.in">tpo@itbhu.ac.in</a> |
					<a href="mailto:tpo@itbhu.ac.in">ittpo@sify.com</a> |
					<a href="tel:+915422307007">+91-542-2307007</a> |
					<a href="tel:+915422368160">+91-542-2368160</a> 
				</p>
			</div>
			<div class="clearfloat"></div>
		</div>
		
		<div class="postheader">
			<div class="menubar">
				<div class="mainmenu">
					<ul class="hover-menu vertical">
						<li>
							<a href="">Home</a>
						</li>
						<li>
							<a href="info/why-at-itbhu/" class="ui">Why @ IT BHU ?</a>
							<ul class="menu-item">
								<li><a href="info/why-at-itbhu/#!/view/#adv-itbhu/" class="ui">IT BHU Advantage</a></li>
								<li><a href="info/why-at-itbhu/#!/view/#adv-alumni/" class="ui">Alumni</a></li>
								<li><a href="info/why-at-itbhu/#!/view/#adv-facilities/" class="ui">Facilities</a></li>
							</ul>
						</li>
						<li>
							<a href="info/academics/" class="ui">Academics</a>
							<ul class="menu-item">
								<li><a href="info/academics/#!/view/#acd-overview/" class="ui">Overview</a></li>
								<li><a href="info/academics/#!/view/#acd-disciplines/" class="ui">Disciplines</a></li>
								<li><a href="info/academics/#!/view/#acd-beyond/" class="ui">Beyond Academics</a></li>
							</ul>
						</li>
						<li>
							<a href="info/companies/" class="ui">Companies</a>
							<ul class="menu-item">
								<li><a href="info/companies/#!/view/#com-procedure/" class="ui">Procedure</a></li>
								<li><a href="info/companies/#!/view/#com-facilities/" class="ui">Facilities</a></li>
								<li><a href="info/companies/#!/view/#com-recruiters/" class="ui">Past Recruiters</a></li>
								<li><a href="info/companies/#!/view/#com-policy/" class="ui">Training &amp; Placement Policy</a></li>
								<li><a href="info/forms/#!/view/#response-sheet/" class="ui">Company Response Sheet</a></li>
								<li><a href="storage/public/downloads/IT-BHU_Placement_Brochure_2010-11.pdf" class="" target="_blank">IT BHU Placement Brochure</a></li>
							</ul>
						</li>
						<li>
							<a href="info/contact-us/" class="ui">Contact Us</a>
							<ul class="menu-item">
								<li><a href="info/contact-us/#!/view/#cnt-office/" class="ui">Office</a></li>
								<li><a href="info/forms/#!/view/#contact/" class="ui">Contact Online</a></li>
								<!--<li><a href="info/contact-us/#!/view/#cnt-coordinators/" class="ui">Student Coordinators</a></li>-->
								<li><a href="info/contact-us/#!/view/#cnt-varanasi/" class="ui">Varanasi</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="statemenu">
					<?php echo $STATEMENU; ?>
				</div>
			</div>
			<div class="clearfloat"></div>
		</div>
		
<?php

$opt = (isset($_GET['opt']) && $_GET['opt'] != '') ? $_GET['opt'] : '';

switch ($opt) {

		case 'home' :
		$content 	= 'index2.html';
        $pageTitle 	= 'Welcome to KEBS website';
		$tag='home';
		break;
		
		case 'aboutkebs' :
		$content 	= 'about/default.php';
		$pageTitle 	= 'About KEBS';
		$tag='aboutkebs';
		break;
		
		case 'mpesa' :
		$content 	= 'sqmt/mpesa/mpesa_details.php';
		$pageTitle 	= 'MPESA PAY BILL DETAILS';
		$tag='mpesa';
		break;

		case 'smscode' :
		$content 	= 'sqmt/shortcode/smscode_details.php';
		$pageTitle 	= 'Verifying validity of KEB services through SMS short code';
		$tag='smscode';
		break;
		
		case 'standards' :
		$content 	= 'sqmt/standards/standards.php';
		$pageTitle 	= 'Standards';
		$tag='standards';
		break;
		
		case 'metrology' :
		$content 	= 'sqmt/metrology/index.php';
		$pageTitle 	= 'Metrology Departments';
		$tag='metrology';
		break;
		
		case 'qai' :
		$content 	= 'sqmt/qai/index.php';
		$pageTitle 	= 'Quality Assuarence and Inspection';
		$tag='qad';
		break;
		
		case 'testing' :
		$content 	= 'sqmt/testing/index.php';
		$pageTitle 	= 'Product Testing';
		$tag='testing';
		break;
			
		case 'nqi' :
		$content 	= 'sqmt/nqi/index.php';
		$pageTitle 	= 'NQI';
		$tag='nqi';
		break;
		
		case 'certification' :
		$content 	= 'sqmt/certification/index.php';
		$pageTitle 	= 'certification page';
		$tag='cert';
		break;
		
		case 'news' :
		$content 	= 'about/newspage.php';
		$pageTitle = 'News Page';
		break;
            
              /* case 'downloads' :
		$content 	= 'downloads/downloads_page.php';
		$pageTitle 	= 'Downloads';
		$tag='downloads';
		break;
				
		
		case 'qms_steps' :
		$content 	= 'certification/kebs_certification-steps.php';
		$pageTitle 	= 'Steps to KEBS QMS Certification';
		break;
		
		case 'qms_firms' :
		$content 	= 'certified_firms.php';
		$pageTitle 	= 'Certified firms ';
		break;*/
		
		case 'search' :
		$content 	= 'search/search.php';
		$pageTitle 	= 'Web Search ';
		break;
		
		case 'biosafety' :
		$content 	= 'biosafety/biosafety.php';
		$pageTitle 	= 'Biosafety  ';
		break;
		
		case 'wtonep' :
		$content 	= 'wto/index.php';
                     $leftcontent = 'sqmt/standards/empty.php';
		$pageTitle 	= 'WTO/TBT National enquiry point';
		break;
		
		case 'sitemap' :
		$content 	= 'home/sitemap.php';
		$pageTitle 	= 'KEBS Sitemap ';
		break;
		
		case 'nqiconf' :
		$content 	= 'second_nqi_conf.php';
		$pageTitle 	= 'Past Events ';
		break;
		
		case 'mrtrainingfeedback' :
		$content 	= 'training_feedback.php';
		$pageTitle 	= 'Management Representative Forum';
		break;
//-----------------------------------------------------------------------------------		
//Default Page		
		default :
		$content 	= 'second_nqi_conf.php';
		$pageTitle 	= 'Welcome to KEBS website';
		$tag='home';
		
}


?>
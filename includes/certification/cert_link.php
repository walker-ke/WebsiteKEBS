<?php

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {

    case 'aboutcb' :
        $content = 'sqmt/certification/kebs_CB.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/rightcb.php';
        $pageTitle = 'About KEBS Certification body';
        break;

    case 'schemes' :
        $content = 'sqmt/certification/certifications.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'KEBS Certification Schemes';
        break;

    case 'cert_process' :
        $content = 'sqmt/certification/certification_process.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Certification Process';
        break;

    case 'certified_firms' :
        $content = 'sqmt/certification/certified_firms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        
        break;
        
    case 'suspended_firms' :
        $content = 'sqmt/certification/certified_firms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        
        break;
        
   case 'isms_firms' :
        $content = 'sqmt/certification/certified_firms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        
        break;

    case 'application' :
        $content = 'kebs_certification_application.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Quality Management System ';
        $img = '';
        break;

    case 'statement' :
        $content = 'sqmt/certification/impartiality_statement.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Statement of Impartiality';
        break;

    case 'feedback' :
        $content = 'sqmt/certification/kebs_certification_feedback.php';
       $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Feedback, Enquiries, Complaints And Appeals';
        break;
    
   
    
    case 'contacts' :
        $content = 'kebs_certification_contacts.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Feedback';
        break;

    case 'confidentiality' :
        $content = 'auditery_confidentiality_form.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Auditor confidentiality Form';
        break;

    case 'faqs' :
        $content = 'faqs.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Frequently Asked Questions on Certification';
        break;

    //Quality Management System
    

    case 'aboutqms' :
        $content = 'accreditation.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'About Quality management System';
        break;

    case 'steps' :
        $content = 'kebs_certification-steps.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Steps to KEBS QMS Certification';
        break;

//    case 'qms_firms' :
//        $content = 'certified_firms.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Certified firms ';
//        break;

//    case 'certification/qms_firms' :
//        $content = 'certified_firms.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Certified firms ';
//        break;

////    //ISO 14001 Environmental Management systems
//    case 'fssc_certfirms' :
//        $content = 'kebs_certification_environmental_management.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Environmental management System ';
//        break;

    case 'emsteps' :
        $content = 'kebs_certification-steps.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Steps to certification';
        break;

    case 'app_process' :
        $content = 'kebs_certification_application.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'EMS Application process';
        break;



    //HACCP and ISO 22000
    case 'fsm' :
        $content = 'kebs_certification_food_safety_management.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Food Safety and Management System';
        break;

    case 'fsmteps' :
        $content = 'kebs_certification-steps.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Steps to certification';
        break;

    case 'fsm_app_process' :
        $content = 'kebs_certification_environmental_management.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'FSM Application process';
        break;


    case 'qms_firms':
    case 'ems_certfirms' :
    case 'knwa_certfirms' :
    case 'fsm_feedback' :
    case 'ohsms_certfirms' :
    case 'fsm_certfirms' :
    case 'haccp_certfirms' :
    case 'fssc_certfirms';
                 
        $content = 'sqmt/certification/certified_firms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        
        $firms="EMS";
       
        break;

//    case 'fsm_certfirms' :
//        $content = 'sqmt/certification/certified_firms.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Certified Firms';
//        break;
//
//    case 'haccp_certfirms' :
//        $content = 'sqmt/certification/certified_firms.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Certified Firms';
//        break;

    //    case 'ohsms_certfirms' :
//        $content = 'certified_firms.php';
//        break;
//
//    case 'knwa_certfirms' :
//         case 'fsm_feedback' :
//             case 'ohsms' :
//             
//        $content = 'sqmt/certification/certified_firms.php';
//        $leftcontent = 'sqmt/certification/leftcb.php';
//        $rightcontent = 'sqmt/certification/empty.php';
//        $pageTitle = 'Certified Firms';
//        break;
    
    case 'fsm_feedback' :
        $content = 'kebs_certification_feedback.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Feedback';
        break;

    //OHSM
    case 'ohsms' :
        $content = 'kebs_certification_occupational_health_safety_management.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Occupational Health & Safety Management';
        break;

    case 'ohsm_cert_steps' :
        $content = 'kebs_certification-steps.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'OHSMS steps to certification';
        break;

    case 'ohsms_app_process' :
        $content = 'ism/searchpfood.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'Occupational Health & Safety Management';
        break;



        case 'qms' :
        $content = 'sqmt/certification/qms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 9001:2008 - Standards on Quality Management Systems (QMS)';
        break;
    
        case 'ems' :
        $content = 'sqmt/certification/ems.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 14001: Environment Management System (EMS)';
        break;
    
        case 'isms' :
        $content = 'sqmt/certification/isms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 27001: Information Security Management  Systems (ISMS)';
        break;
    
        case 'fsms' :
        $content = 'sqmt/certification/fsms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = ' HACCP and ISO 22000:Food safety Management systems (FSM)';
        break;
    
    
    
        case 'ohsas' :
        $content = 'sqmt/certification/ohsas.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 18001 : Occupational Health  and Safety Management System (OHSMS)';
        break;
    
      case 'energy' :
        $content = 'sqmt/certification/energy_management.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 50001: Energy Management System';
        break;
    
    case 'haccp' :
        $content = 'sqmt/certification/haccp.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 22001 HACCP ';
        break;
    
          case 'knwha' :
        $content = 'sqmt/certification/itms.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $pageTitle = 'ISO 20000 Registered Firm: Information Technology Service  Management - Requirements';
        break;

    case 'ohsms_feedback' :
        $content = 'ism/searchpelect.php';
        break;

    case 'search' :
        $content = 'serch_results.php';
        break;

    case 'dd' :
        $content = 'files/';
        break;


//-----------------------------------------------------------------------------------		
//Default Page		
    default :
        $content = 'kebs_certification.php';
        $leftcontent = 'sqmt/certification/leftcb.php';
        $rightcontent = 'sqmt/certification/empty.php';
        $title = 'KEBS Certification body';
    //$main = 'main';
}
?>
<?php

/**
 * @author          Tassos.gr
 * @link            http://www.tassos.gr
 * @copyright       Copyright © 2021 Tassos Marinos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

// Registers framework's namespace
JLoader::registerNamespace('NRFramework', __DIR__ . '/NRFramework/', false, false, 'psr4');

// Assignment related class aliases
JLoader::registerAlias('NRFrameworkFunctions',               '\\NRFramework\\Functions');
JLoader::registerAlias('NRAssignment',                       '\\NRFramework\\Assignment');
JLoader::registerAlias('nrFrameworkAssignmentsHelper',       '\\NRFramework\\Assignments');
JLoader::registerAlias('nrFrameworkAssignmentsAcyMailing',   '\\NRFramework\\Assignments\\AcyMailing');
JLoader::registerAlias('nrFrameworkAssignmentsAkeebaSubs',   '\\NRFramework\\Assignments\\AkeebaSubs');
JLoader::registerAlias('nrFrameworkAssignmentsContent',      '\\NRFramework\\Assignments\\Content');
JLoader::registerAlias('nrFrameworkAssignmentsConvertForms', '\\NRFramework\\Assignments\\ConvertForms');
JLoader::registerAlias('nrFrameworkAssignmentsDateTime',     '\\NRFramework\\Assignments\\DateTime');
JLoader::registerAlias('nrFrameworkAssignmentsDevices',      '\\NRFramework\\Assignments\\Devices');
JLoader::registerAlias('nrFrameworkAssignmentsGeoIP',        '\\NRFramework\\Assignments\\GeoIP');
JLoader::registerAlias('nrFrameworkAssignmentsLanguages',    '\\NRFramework\\Assignments\\Languages');
JLoader::registerAlias('nrFrameworkAssignmentsMenu',         '\\NRFramework\\Assignments\\Menu');
JLoader::registerAlias('nrFrameworkAssignmentsPHP',          '\\NRFramework\\Assignments\\PHP');
JLoader::registerAlias('nrFrameworkAssignmentsURLs',         '\\NRFramework\\Assignments\\URLs');
JLoader::registerAlias('nrFrameworkAssignmentsUsers',        '\\NRFramework\\Assignments\\Users');
JLoader::registerAlias('nrFrameworkAssignmentsOS',           '\\NRFramework\\Assignments\\OS');
JLoader::registerAlias('nrFrameworkAssignmentsBrowsers',     '\\NRFramework\\Assignments\\Browsers');
JLoader::registerAlias('NRCache', 							 '\\NRFramework\\Cache');
JLoader::registerAlias('NRHTML', 							 '\\NRFramework\\HTML');
JLoader::registerAlias('NRUpdateSites', 					 '\\NRFramework\\Updatesites');
JLoader::registerAlias('NRSmartTags', 					     '\\NRFramework\\SmartTags\\SmartTags');
JLoader::registerAlias('NRFramework\\SmartTags',			 '\\NRFramework\\SmartTags\\SmartTags');
JLoader::registerAlias('NREmail', 					         '\\NRFramework\\Email');
JLoader::registerAlias('NRVisitor', 					     '\\NRFramework\\VisitorToken');
JLoader::registerAlias('NRFonts', 					         '\\NRFramework\\Fonts');
JLoader::registerAlias('NR_activecampaign', 				 '\\NRFramework\\Integrations\\ActiveCampaign');
JLoader::registerAlias('NR_campaignmonitor', 				 '\\NRFramework\\Integrations\\CampaignMonitor');
JLoader::registerAlias('NR_convertkit', 				 	 '\\NRFramework\\Integrations\\ConvertKit');
JLoader::registerAlias('NR_drip', 				 			 '\\NRFramework\\Integrations\\Drip');
JLoader::registerAlias('NR_elasticemail', 					 '\\NRFramework\\Integrations\\ElasticEmail');
JLoader::registerAlias('NR_getresponse', 					 '\\NRFramework\\Integrations\\GetResponse');
JLoader::registerAlias('NR_hubspot', 						 '\\NRFramework\\Integrations\\HubSpot');
JLoader::registerAlias('NR_icontact', 						 '\\NRFramework\\Integrations\\IContact');
JLoader::registerAlias('NR_mailchimp', 						 '\\NRFramework\\Integrations\\MailChimp');
JLoader::registerAlias('NR_recaptcha', 						 '\\NRFramework\\Integrations\\ReCaptcha');
JLoader::registerAlias('NR_salesforce', 					 '\\NRFramework\\Integrations\\Salesforce');
JLoader::registerAlias('NR_sendinblue', 					 '\\NRFramework\\Integrations\\SendInBlue');
JLoader::registerAlias('NR_zoho', 							 '\\NRFramework\\Integrations\\Zoho');
JLoader::registerAlias('NR_zohocrm', 						 '\\NRFramework\\Integrations\\ZohoCRM');

// Define a helper constant to indicate whether we are on a Joomla 4 installation
if (version_compare(JVERSION, '4.0', 'ge') && !defined('nrJ4'))
{
	define('nrJ4', true);
}
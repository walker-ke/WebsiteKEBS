<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Use of Google Font
if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}

function getcurrentMenu(){
    $doc=JFactory::getDocument();
    $getTitle=$doc->getTitle();
    return strtolower($getTitle);
}


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css" type="text/css" />
 <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
 <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->

  
   <script>
	window.site_url='//code.outputdesk.com';
	(function(o,d,e,s,k){
	o[s]=o[s]||function(){(o[s].prop=o[s].prop||[]).push(arguments)};
	o[s]('key','KEBSCHAT');o[s]('url',o['site_url']);
	var a=d.createElement(e),m=d.getElementsByTagName(e)[0];a.async=1;a.src=o['site_url']+k;m.parentNode.insertBefore(a,m);
	})(window,document,'script','ODL','/js/fe/odl.min.js');
</script> 
<!--
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2403965438241234"
     crossorigin="anonymous"></script>
-->
</head>
  </head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->
<section class="up">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<jdoc:include type="modules" name="contact" style="none" />
				</div>
				<div class="col-md-3">
					<jdoc:include type="modules" name="mpesa" style="none" />
				</div>
				<div class="col-md-4">
					<jdoc:include type="modules" name="staffmail" style="none" />
				</div>
				<div class="col-md-2">
					<jdoc:include type="modules" name="social1" style="none" />
				</div>
			</div>
		</div>
		
	</section>
<header class="top2">
	<div class="container">
		<div class="row top">
			<div class="col-md-6 logo">
				<jdoc:include type="modules" name="logo" style="none" />
			</div>
			<div class="navigation1">
			<div class="col-md-2 language">
              <div class="pull-right">
				<jdoc:include type="modules" name="language" style="none" />
              </div>
			</div>
			<div class="col-md-4 topmenu">
               <div class="pull-right">
				
                 <jdoc:include type="modules" name="search1" style="none" />
			</div>
              </div>
		</div>
		</div>
	</div>
</header>
<section class="mainmenu1">
	<div class="container">
				<div class="row mainmenu">
			<div class="col-md-12 mainmenu1">
              <jdoc:include type="modules" name="mainmenu" style="none" />
			</div>
		</div>
	</div>
</section> 
  <section>
	<jdoc:include type="modules" name="social" style="none" />
</section>
<!--<section class="buykenya">
  	  <div class="container">
    <div class="row">
<div class="col-md-12">
	<jdoc:include type="modules" name="starndards" style="none" />
</div>     
  </div>
  </div>
</section>-->
<section class="innercontent">
	<div class="container innercontent1">
		<div class="row">
          <div class="col-md-3 side">
             <jdoc:include type="modules" name="archive" style="xhtml"/>
          </div>
			<div class="col-md-9 innerwrap <?php echo getcurrentMenu();?>">
				<jdoc:include type="component" />
              <div class="row">
                <div class="col-md-12">
                  <div id="nairobi">
                   <jdoc:include type="modules" name="motor" style="xhtml"/>
                     </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <jdoc:include type="modules" name="form" style="xhtml"/>
                </div>
              </div>      
              <div class="row">
                <div class="col-md-4">
                  <jdoc:include type="modules" name="review" style="xhtml"/>
                </div>
               <div class="col-md-4">
                  <jdoc:include type="modules" name="adoption" style="xhtml"/>
                </div>
                <div class="col-md-4">
                   <jdoc:include type="modules" name="systematic" style="xhtml"/>
                </div>
              </div> 
			</div>
		</div>
	</div>
</section>
<section class="footer2">
	<div class="container footer1">
		<div class="row">
          <div class="col-md-3">
            	<jdoc:include type="modules" name="SERVICES" style="xhtml"/>
          </div>
          <div class="col-md-3">
            <jdoc:include type="modules" name="SECTORS" style="xhtml"/>
          </div>
		<div class="col-md-3">
             <jdoc:include type="modules" name="KEBS" style="xhtml"/>
          </div>
          <div class="col-md-3">
            <jdoc:include type="modules" name="web" style="xhtml"/>
          </div>
		</div>
	</div>
</section>
	<!-- Footer -->
		<footer class="footer" role="contentinfo">
		<div class="container bottom <?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
          <div class="row">
       <div class="col-md-4">
         <jdoc:include type="modules" name="visitor" style="none" />
            </div>
            <div class="col-md-6">
			<jdoc:include type="modules" name="footer" style="none" />
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
             </div> 
            <div class="col-md-2">
              <jdoc:include type="modules" name="chat" style="none" />
            </div>
            </div>
		</div>
        
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

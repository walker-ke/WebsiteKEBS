<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// no direct access
defined('_JEXEC') or die;  

$ArteticsView = new ArteticsView();     
$html = $ArteticsView->render('visualization',array()); //render visualization sublayout

echo $html;
?>

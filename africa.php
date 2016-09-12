<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('Africa');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

// Document style sheets and js
$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::base().'components/com_africa/assets/css/layout.css', $type = 'text/css');
$doc->addScript(JUri::base().'components/com_africa/assets/js/paths.js');
$doc->addScript(JUri::base().'components/com_africa/assets/js/fabric.min.js');
<?php
/**
 * @package    Tabs and Sliders [for articles]
 * @contact    www.joomlashack.com, hello@joomlashack.com
 * @author     JoomlaWorks - http://www.joomlaworks.net
 * @author     Alledia - http://www.joomlashack.com
 * @copyright  Copyright (c) 2006 - 2015 JoomlaWorks Ltd. All rights reserved.
 * @copyright  Copyright (c) 2016 Open Source Training, LLC. All rights reserved
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JWElement extends JFormField
{
    public function getInput()
    {
        return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
    }

    public function getLabel()
    {
        if (method_exists($this, 'fetchTooltip')) {
            return $this->fetchTooltip($this->element['label'], $this->description, $this->element, $this->options['control'], $this->element['name'] = '');
        } else {
            return parent::getLabel();
        }
    }

    public function render($layoutId, $data = array())
    {
        return $this->getInput();
    }
}

<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

// no direct access
defined('_JEXEC') or die; ?>

<form class="uk-form" method="post" name="art-idcomlogapi-settings-form" id="art-idcomlogapi-settings-form" action="index.php?option=com_artidcomlogapi&amp;task=Transmissions.saveSettings">
    <div class="uk-form-row">
        <label class="uk-form-label" for="">
            <?php echo JText::_( 'API Client ID' ); ?>
        </label>
        <div class="uk-form-controls">
			<input name="art-idcomlogapi-settings-api-client-id" id="art-idcomlogapi-settings-api-client-id" value="" type="text" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Enter your IDComLog API Client ID' ); ?>">
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">
            <?php echo JText::_( 'API User ID' ); ?>
        </label>
        <div class="uk-form-controls">
            <input name="art-idcomlogapi-settings-api-user-id" id="art-idcomlogapi-settings-api-user-id" value="" type="text" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Enter your IDComLog API User ID' ); ?>">
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label" for="">
            <?php echo JText::_( 'API Endpoint' ); ?>
        </label>
        <div class="uk-form-controls">
            <select name="art-idcomlogapi-settings-api-endpoint" id="art-idcomlogapi-settings-api-endpoint" class="uk-form-large uk-width-1-1" data-uk-tooltip title="<?php echo JText::_( 'Select the API Endpoint. Liberal use of the testing environment is encouraged prior to using production.' ); ?>">
                <option <?php echo ($this->settings->api_endpoint == 'https://api‐test.idcomlog.com/v2/') ? 'selected="selected"' : '' ; ?> value="https://api‐test.idcomlog.com/v2/">https://api‐test.idcomlog.com/v2/ - <b>testing</b></option>
                <option <?php echo ($this->settings->api_endpoint == 'https://api.idcomlog.com/v2/') ? 'selected="selected"' : '' ; ?> value="https://api.idcomlog.com/v2/">https://api.idcomlog.com/v2/ - <b>production</b></option>
            </select>
        </div>
    </div>
</form>
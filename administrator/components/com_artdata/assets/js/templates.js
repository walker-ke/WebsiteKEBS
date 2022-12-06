/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

/******************************************************************************************
* Misc template functionality
*
*/

function launchCreateNewModal() {
	UIkit.modal( "#art-data-new-template-choice-modal" ).show();
}

function toggleTableTab() {
	//change active tabs
	jQuery( "#art-data-templates-chart-tab" ).removeAttr('class');
	jQuery( "#art-data-templates-table-tab" ).removeAttr('class');
	jQuery( "#art-data-templates-table-tab" ).attr('class','uk-active');
	
	//change active content
	jQuery( '#art-data-templates-chart-content' ).hide();
	jQuery( '#art-data-templates-table-content' ).show();
}

function toggleChartTab() {
	//change active tabs
	jQuery( "#art-data-templates-table-tab" ).removeAttr('class');
	jQuery( "#art-data-templates-chart-tab" ).removeAttr('class');
	jQuery( "#art-data-templates-chart-tab" ).attr('class','uk-active');

	//change active content
	jQuery( '#art-data-templates-table-content' ).hide();
	jQuery( '#art-data-templates-chart-content' ).show();
}

function removeTemplate(templateId) {

	UIkit.modal.confirm("Are you sure?", function(){
		jQuery( "#art-data-item-id" ).val(templateId);
		document.forms['art-data-removal-form'].submit();
	});

}

function makeDuplicate(templateId) {

	UIkit.modal.confirm("Are you sure?", function(){
		jQuery( "#art-data-duplicate-item-id" ).val(templateId);

		//console.log( jQuery( "#art-data-duplicate-item-id" ).val() )

		document.forms['art-data-duplicate-form'].submit();
	});

}



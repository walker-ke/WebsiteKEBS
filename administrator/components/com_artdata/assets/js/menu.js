/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

jQuery( document ).ready(function($) {

	//load the admin menu bar and replace default joomla one
	jQuery( ".subhead-collapse" ).html(artDataAdminMenuBar);

	$( ".header" ).hide();

	var joomlaVersion = $( "div.btn-toolbar > div.btn-group.pull-right > p" ).html(); //.btn-group
	$( "div.btn-toolbar > div.btn-group.pull-right > p" ).html('Art Data by Artetics.com — '+joomlaVersion);

});




var searchBarActive = 0;

function toggleArtDataAdminSearchBar() {
	if (searchBarActive == 0) { //open
		jQuery( "#art-data-search-toggle-button" ).removeAttr('class');
		jQuery( "#art-data-search-toggle-button" ).attr('class','uk-button uk-button-success'); 

		jQuery( "#art-data-search" ).show();
		searchBarActive = 1;
	} else { //close
		jQuery( "#art-data-search-toggle-button" ).removeAttr('class');
		jQuery( "#art-data-search-toggle-button" ).attr('class','uk-button'); 	
		
		jQuery( "#art-data-search" ).hide();	
		searchBarActive = 0;		
	}
}


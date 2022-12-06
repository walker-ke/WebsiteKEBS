/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

/*** CREATE NEW ***/

var ArtAccordionOpen = [];


//instantiate the accordion only after the dom has loaded
jQuery( document ).ready(function($) {

	var AccordionInstance = $( "#art-data-new-accordion" ).attr('data-art-data-accordion');
	if (AccordionInstance) {
		ArtAccordionOpen = JSON.parse(AccordionInstance);
	}
	
});


function toggleAccordionNode(node) {
	if (isNodeActive(node)) { //close this node
		jQuery( "#art-data-accordion-content-"+node ).hide('blind');
		ArtAccordionOpen = [];
	} else { //open this node
		closeOtherNodes()
		jQuery( "#art-data-accordion-content-"+node ).show('blind');
		ArtAccordionOpen.push(node); //add to array
	}
}

function isNodeActive(node) {
	if (ArtAccordionOpen.length > 0) { //there is at least one node active
		for (var i=0;i<ArtAccordionOpen.length;i++) {
			if (ArtAccordionOpen[i] == node) {
				return true;
			}
		}
	} else { //no nodes are active
		return false;
	}
}

function closeOtherNodes() {
	if (ArtAccordionOpen.length > 0) { //there is at least one node active
		for (var i=0;i<ArtAccordionOpen.length;i++) {
			jQuery( "#art-data-accordion-content-"+ArtAccordionOpen[i] ).hide('blind');
		}
		ArtAccordionOpen = [];
	}
}

/**** EDIT ****/

var EditArtAccordionOpen = ['basics'];

function toggleEditAccordionNode(node) {
	if (isEditNodeActive(node)) { //close this node
		jQuery( "#art-data-edit-accordion-content-"+node ).hide('blind');
		EditArtAccordionOpen = [];
	} else { //open this node
		closeEditOtherNodes()
		jQuery( "#art-data-edit-accordion-content-"+node ).show('blind');
		EditArtAccordionOpen.push(node); //add to array
	}
}

function isEditNodeActive(node) {
	if (EditArtAccordionOpen.length > 0) { //there is at least one node active
		for (var i=0;i<EditArtAccordionOpen.length;i++) {
			if (EditArtAccordionOpen[i] == node) {
				return true;
			}
		}
	} else { //no nodes are active
		return false;
	}
}

function closeEditOtherNodes() {
	if (EditArtAccordionOpen.length > 0) { //there is at least one node active
		for (var i=0;i<EditArtAccordionOpen.length;i++) {
			jQuery( "#art-data-edit-accordion-content-"+EditArtAccordionOpen[i] ).hide('blind');
		}
		EditArtAccordionOpen = [];
	}
}
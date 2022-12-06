/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms

/***** CREATE NEW ****/

function launchCreateNewModal() {
	document.location = 'index.php?option=com_artdata&view=data&layout=default_new';
}

function highlightValidatedFields(selector) {
	var fieldClass = "uk-width-1-1 uk-form-large";
	jQuery(selector).removeAttr('class');
	jQuery(selector).attr('class',fieldClass+" uk-form-danger");
}

function removeHighlightValidatedFields(selector) {
	var fieldClass = "uk-width-1-1 uk-form-large";
	jQuery(selector).removeAttr('class');
	jQuery(selector).attr('class',fieldClass);	
}


/******* EDIT ******/




function removeVisualization(visualizationId) {

	UIkit.modal.confirm("Are you sure?", function(){
		jQuery( "#art-data-item-id" ).val(visualizationId);
		document.forms['art-data-removal-form'].submit();
	});

}

function togglePublishing(state,visualizationId) {

	UIkit.modal.confirm("Are you sure?", function(){
		jQuery( "#art-data-publishing-item-id" ).val(visualizationId);
		jQuery( "#art-data-publishing-state" ).val(state);
		document.forms['art-data-publishing-form'].submit();
	});

}

function makeDuplicate(visualizationId) {

	UIkit.modal.confirm("Are you sure?", function(){
		jQuery( "#art-data-duplicate-item-id" ).val(visualizationId);

		//console.log( jQuery( "#art-data-duplicate-item-id" ).val() )

		document.forms['art-data-duplicate-form'].submit();
	});

}

function toggleNewIcon(state,field,id) {

	if (state == 0) {	
		var styles = 'cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);';
		var classAttr = 'uk-icon-toggle-off';
		var newState = 1;
	} else {
		var styles = 'cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);';
		var classAttr = 'uk-icon-toggle-on';
		var newState = 0;
	}

	//change the UI
	jQuery( "#"+id ).removeAttr('onclick');
	jQuery( "#"+id ).attr('onclick','toggleNewIcon('+newState+',\''+field+'\',\''+id+'\')');

	jQuery( "#"+id ).removeAttr('class');
	jQuery( "#"+id ).attr('class',classAttr);

	jQuery( "#"+id ).removeAttr('style');
	jQuery( "#"+id ).attr('style',styles);

	//set the needed vars
	switch(field) {
		case 'published':
					published = state;			
			break;	
		case 'showTitle':
					showTitle = state;			
			break;	
		case 'downloadable':
					downloadable = state;
			break;				
	}

	
}

function toggleEditIcon(state,field,id) {

	if (state == 0) {	
		var styles = 'cursor:pointer;font-size:30px;color:rgba(216, 80, 48, 1);';
		var classAttr = 'uk-icon-toggle-off';
		var newState = 1;
	} else {
		var styles = 'cursor:pointer;font-size:30px;color:rgba(101, 159, 19, 1);';
		var classAttr = 'uk-icon-toggle-on';
		var newState = 0;
	}

	//change the UI
	jQuery( "#"+id ).removeAttr('onclick');
	jQuery( "#"+id ).attr('onclick','toggleEditIcon('+newState+',\''+field+'\',\''+id+'\')');

	jQuery( "#"+id ).removeAttr('class');
	jQuery( "#"+id ).attr('class',classAttr);

	jQuery( "#"+id ).removeAttr('style');
	jQuery( "#"+id ).attr('style',styles);

	//set the needed vars
	switch(field) {
		case 'published':
					editPublished = state;			
			break;	
		case 'showTitle':
					editShowTitle = state;			
			break;	
		case 'downloadable':
					editDownloadable = state;
			break;
	}

	
}

//on keyup, start the countdown
function triggerSearch() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
}

//user is "finished typing," do something
function doneTyping () {
	var data = jQuery( "#artDataSearchForm" ).serializeArray();
	AjaxInit(data,'Search','#art-data-loading');  	
}

function AjaxInit(dataObj,task,loadingId) {
	jQuery(function($){
        $.ajax({
            url: "index.php?option=com_artdata&view=data&task="+task+"&format=raw", 
            type: "POST",
            data: dataObj,
            dataType: "json",
            beforeSend: function() {
            	$( loadingId ).show();
                $( loadingId ).empty();
                $( loadingId ).html("<i class=\'uk-icon-refresh uk-icon-spin\'></i>");
                //alert('ajax beforesend');
            }
        }).done(function(result) {
        	$( loadingId ).empty();

        	if (result.status == true) {
        		$( loadingId ).hide();

        		window.VisualizationItems = result.items; //set the global var

        		//change UI
        		if (task == 'Search') {
        			var html = renderDatasetTable(result.items);
        			jQuery( "#art-data-tbody" ).empty().html(html);       			
        		}

        	}

        }).fail(function() {
        	//alert('ajax failure');
        	$( loadingId ).empty();
            $( loadingId ).hide();
            //return false;

        });  
    });    
}

function renderDatasetTable(items) {

	var html = '';
	for (var i=0;i<items.length;i++) {

		html += '<tr>';
			html += '<td>';
				html += '<a href="index.php?option=com_artdata&amp;view=data&amp;layout=default_new&amp;id='+items[i].id+'">';
					html += items[i].name;
				html += '</a>';
			html += '</td>';	
			html += '<td>';
				html += uppercaseWords(items[i].type);
			html += '</td>';
			html += '<td>';
				html += uppercaseWords(items[i].series);
			html += '</td>';														
			html += '<td class="uk-text-center" style="width:1%;">';
				html += '<a href="javascript:void(0);" onclick="makeDuplicate('+items[i].id+')" data-uk-tooltip title="Make a copy"><i class="uk-icon-clone"></i></a>';
			html += '</td>';								
			html += '<td class="uk-text-center" style="width:1%;">';
				html += '<a href="javascript:void(0);" onclick="removeVisualization('+items[i].id+')" data-uk-tooltip title="Remove"><i class="uk-icon-close"></i></a>';
			html += '</td>	';																																									
		html += '</tr>';

	}

	return html;
}

function uppercaseWords(str) {
  return (str + '')
    .replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
      return $1.toUpperCase();
    });
}

function getVisualizationTypeIcon(type) {
    	switch (type) {
    		case 'StaticTable':
    				var icon = '<i class="uk-icon-table"></i>';
    			break;
    		case 'DynamicTable':
    				var icon = '<i class="uk-icon-table"></i>';
    			break;    
       		case 'Bar':
       				var icon = '<i class="uk-icon-bar-chart"></i>';
    			break;
    		case 'Line':
    				var icon = '<i class="uk-icon-line-chart"></i>';
    			break;  
    		case 'Area':
    				var icon = '<i class="uk-icon-area-chart"></i>';
    			break;
    		case 'StackedBar':
    				var icon = '<i class="uk-icon-bar-chart"></i>';
    			break;  
       		case 'StackedArea':
       				var icon = '<i class="uk-icon-area-chart"></i>';
    			break;
    		case 'Pie':
    				var icon = '<i class="uk-icon-pie-chart"></i>';
    			break;  
    		case 'PercentBar':	
    				var icon = '<i class="uk-icon-bar-chart"></i>';
    			break;
    		case 'PercentArea':
    				var icon = '<i class="uk-icon-area-chart"></i>';
    			break; 
    		case 'Donut':
    				var icon = '<i class="uk-icon-pie-chart"></i>';
    			break; 
    		case 'StepUpBar':
    				var icon = '<i class="uk-icon-bar-chart"></i>';
    			break; 
    		case 'Waterfall':
    				var icon = '<i class="uk-icon-bar-chart"></i>';
    			break; 
    		default:

    			break;
    	}

    	return icon;
}







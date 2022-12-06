/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

var condensed = 0;
var middle = 0;
var striped = 0;
var hover = 0;
var buttonLarge = 0;
var buttonSmall = 0;
var inputLarge = 0;
var inputSmall = 0;

var tableClass = ['art-data-table'];
var searchBarClass = ['art-data-input'];
var searchButtonClass = ['art-data-button'];


var thBorderBottom = ['1px','solid','#dddddd'];
var tdBorderBottom = ['1px','solid','#dddddd'];
var searchBarBorderBottom = ['1px','solid','#dddddd'];
var searchButtonBorder = ['1px','solid','#dddddd'];


//console.log(document.styleSheets)

jQuery( document ).ready(function($) {
	//modify the layout for template creation/editing

	//hide last remnants of template
	$( ".navbar" ).hide();
	$( "#status" ).hide();
	$( ".subhead-collapse.collapse" ).css('top','0px');

	//this must happen prior to loading screen timeout
	if (window.ArtDataLayout == 'default_edit_table') {

		//populate the preview controls
		populateEditPreviewControls(window.TemplateItem);

		//loop the content of the item we're editing and update the preview stylesheet
		for (var i=0;i<window.ArtDataTemplateContent.length;i++) {
			var selector = window.ArtDataTemplateContent[i].selector;
			for (var c=0;c<window.ArtDataTemplateContent[i].rules.length;c++) {
				var property = window.ArtDataTemplateContent[i].rules[c].property;
				var value = window.ArtDataTemplateContent[i].rules[c].value;
				updateCssRulesTableStructure(selector,property,value);
			}
		}

		//add the item's modifier classes to the table
		var classes = 'art-data-table';
		var modifiers = JSON.parse(window.TemplateItem.modifier_classes);
		if (modifiers.condensed == 1) {
			classes += ' art-data-table-condensed';
		}
		if (modifiers.striped == 1) {
			classes += ' art-data-table-striped';
		}
		if (modifiers.hover == 1) {
			classes += ' art-data-table-hover';
		}			
		
		jQuery( "#art-data-preview-table" ).removeAttr('class');
		jQuery( "#art-data-preview-table" ).attr('class',classes);

	}

	//remove loading screen
	setTimeout(function () {
		$( "#art-data-loading-content" ).hide();
		$( "#art-data-preview-table-container" ).show();
		if (window.ArtDataLayout == 'default_edit_table') {
			$( "#art-data-loading-controls" ).hide();
			$( "#art-data-controls-container" ).show();				
		}
	}, 2000);

	//remove joomla admin default isis template css because it distorts our table preview css
	//table preview must accurately portray the way table will look on front-end
	var styleSheets = document.styleSheets;
	for (var i=0;i<styleSheets.length;i++) {
		if (styleSheets[i].hasOwnProperty(href)) {
			var href = styleSheets[i].href;
			if (href.indexOf('administrator/templates/isis/css/template.css') !== -1) { //this is the stylesheet
				styleSheets[i].disabled = true; //disable stylesheet
			}		
		}
	} 	

});

/******************************************************************************************
* Functions for changing preview UI based on state change in config fields
*
*/

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
		case 'condensed':
				condensed = state;
				if (state == 0) {
					var classIndex = tableClass.indexOf('art-data-table-'+field);
					if (classIndex !== -1) { tableClass.splice(classIndex,1); }
				} else {
					tableClass.push('art-data-table-'+field);					
				}
				toggleTableStylePreview();
			break;		
		case 'middle':
				middle = state;
			break;	
		case 'striped':
				striped = state;
				if (state == 0) {
					var classIndex = tableClass.indexOf('art-data-table-'+field);
					if (classIndex !== -1) { tableClass.splice(classIndex,1); }
				} else {
					tableClass.push('art-data-table-'+field);					
				}			
				toggleTableStylePreview();	
			break;	
		case 'hover':
				hover = state;
				if (state == 0) {
					var classIndex = tableClass.indexOf('art-data-table-'+field);
					if (classIndex !== -1) { tableClass.splice(classIndex,1); }
				} else {
					tableClass.push('art-data-table-'+field);					
				}				
				toggleTableStylePreview();
			break;		
		case 'button-large':
				buttonLarge = state;
				if (state == 0) {
					var classIndex = searchButtonClass.indexOf('art-data-button-large');
					if (classIndex !== -1) { searchButtonClass.splice(classIndex,1); }
				} else {
					searchButtonClass.push('art-data-button-large');					
				}			
				toggleSearchButtonStylePreview();
			break;	
		case 'button-small':
				buttonSmall = state;
				if (state == 0) {
					var classIndex = searchButtonClass.indexOf('art-data-button-small');
					if (classIndex !== -1) { searchButtonClass.splice(classIndex,1); }
				} else {
					searchButtonClass.push('art-data-button-small');					
				}			
				toggleSearchButtonStylePreview();
			break;	
		case 'input-large':
				inputLarge = state;
				if (state == 0) {
					var classIndex = searchBarClass.indexOf('art-data-input-large');
					if (classIndex !== -1) { searchBarClass.splice(classIndex,1); }
				} else {
					searchBarClass.push('art-data-input-large');					
				}			
				toggleSearchBarStylePreview();
			break;	
		case 'input-small':
				inputSmall = state;
				if (state == 0) {
					var classIndex = searchBarClass.indexOf('art-data-input-small');
					if (classIndex !== -1) { searchBarClass.splice(classIndex,1); }
				} else {
					searchBarClass.push('art-data-input-small');					
				}			
				toggleSearchBarStylePreview();
			break;						
	}

	
}	

/* table modifier styles */
function toggleTableStylePreview() {
	var classes = tableClass.join(' ');

	jQuery( "#art-data-preview-table" ).removeAttr('class');
	jQuery( "#art-data-preview-table" ).attr('class',classes);
}

/* table width */
function toggleTableWidthStylePreview(value) {
	updateCssRulesTableStructure(".art-data-table","width",value);	
}

/* th text align */
function toggleThTextAlignStylePreview(value) {
	updateCssRulesTableStructure(".art-data-table th","text-align",value);
}

/* th padding */
function toggleThPaddingStylePreview(value) {
	//console.log('firing')
	updateCssRulesTableStructure(".art-data-table th","padding",value);
	//console.log(document.styleSheets)
}

/* th font size */
function toggleThFontSizeStylePreview(value) {
	updateCssRulesTableStructure(".art-data-table th","font-size",value);
}

/* th font weight */
function toggleThFontWeightStylePreview(value) {
	updateCssRulesTableStructure(".art-data-table th","font-weight",value);
}

/* th color picker */
var thColorColorpickerConfig = {hideButton:true,color:'#fafafa'};
jQuery(function($){
	$( "#art-data-new-table-th-color" ).colorpicker(thColorColorpickerConfig);
	$("#art-data-new-table-th-color").on("change.color", function(event, color){
		$('#art-data-new-table-th-color-preview').css('background-color', color);
		
		updateCssRulesTableStructure(".art-data-table th","color",color);
	
		//console.log(document.styleSheets)
	});
}); 

/* th border bottom size */
function toggleThBorderBottomSizeStylePreview(value) {
	thBorderBottom[0] = value;
	var borderDeclaration = thBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-table th","border-bottom",borderDeclaration);
}

/* th border bottom type */
function toggleThBorderBottomTypeStylePreview(value) {
	thBorderBottom[1] = value;
	var borderDeclaration = thBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-table th","border-bottom",borderDeclaration);
}

/* th border bottom color picker */
var thBorderBottomColorpickerConfig = {hideButton:true,color:'#dddddd'};
jQuery(function($){
	$( "#art-data-new-table-th-border-bottom-color" ).colorpicker(thBorderBottomColorpickerConfig);
	$("#art-data-new-table-th-border-bottom-color").on("change.color", function(event, color){
		$('#art-data-new-table-th-border-bottom-color-preview').css('background-color', color);
		
		thBorderBottom[2] = color;
		var borderDeclaration = thBorderBottom.join(' ');
		//console.log(borderDeclaration);
		updateCssRulesTableStructure(".art-data-table th","border-bottom",borderDeclaration);
	});
}); 

/* td text align */
function toggleTdTextAlignStylePreview(value) {
	updateCssRulesTableStructure(".art-data-table td","text-align",value);
	//console.log(document.styleSheets)
}

/* td padding */
function toggleTdPaddingStylePreview(value) {
	//console.log('firing')
	updateCssRulesTableStructure(".art-data-table td","padding",value);
	//console.log(document.styleSheets)
}

/* td border bottom size */
function toggleTdBorderBottomSizeStylePreview(value) {
	tdBorderBottom[0] = value;
	var borderDeclaration = tdBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-table td","border-bottom",borderDeclaration);
}

/* td border bottom type */
function toggleTdBorderBottomTypeStylePreview(value) {
	tdBorderBottom[1] = value;
	var borderDeclaration = tdBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-table td","border-bottom",borderDeclaration);
}

/* td border bottom color picker */
var tdBorderBottomColorpickerConfig = {hideButton:true,color:'#dddddd'};
jQuery(function($){
	$( "#art-data-new-table-td-border-bottom-color" ).colorpicker(tdBorderBottomColorpickerConfig);
	$("#art-data-new-table-td-border-bottom-color").on("change.color", function(event, color){
		$('#art-data-new-table-td-border-bottom-color-preview').css('background-color', color);
		
		tdBorderBottom[2] = color;
		var borderDeclaration = tdBorderBottom.join(' ');
		//console.log(borderDeclaration);
		updateCssRulesTableStructure(".art-data-table td","border-bottom",borderDeclaration);
	});
}); 

/* td background color picker */
var tdBackgroundColorpickerConfig = {hideButton:true,color:'#fafafa'};
jQuery(function($){
	$( "#art-data-new-table-td-striped-background-color" ).colorpicker(tdBackgroundColorpickerConfig);
	$("#art-data-new-table-td-striped-background-color").on("change.color", function(event, color){
		$('#art-data-new-table-td-striped-background-color-preview').css('background-color', color);
		
		updateCssRulesTableStructure(".art-data-table-striped tbody tr:nth-of-type(2n+1)","background",color);
	
		//console.log(document.styleSheets)
	});
}); 

/* search bar height */
function toggleSearchBarHeightStylePreview(value) {
	updateCssRulesTableStructure(".art-data-input","height",value);
	//console.log(document.styleSheets)
}

function toggleSearchBarWidthStylePreview(value) {
	updateCssRulesTableStructure(".art-data-input","width",value);
	//console.log(document.styleSheets)	
}

/* search bar padding */
function toggleSearchBarPaddingStylePreview(value) {
	updateCssRulesTableStructure(".art-data-input","padding",value);
	//console.log(document.styleSheets)
}

/* search bar border size */
function toggleSearchBarBorderBottomSizeStylePreview(value) {
	searchBarBorderBottom[0] = value;
	var borderDeclaration = searchBarBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-input","border",borderDeclaration);
}

/* search bar border type */
function toggleSearchBarBorderBottomTypeStylePreview(value) {
	searchBarBorderBottom[1] = value;
	var borderDeclaration = searchBarBorderBottom.join(' ');
	updateCssRulesTableStructure(".art-data-input","border",borderDeclaration);
}

/* search bar border color  */
var searchBarBorderColorpickerConfig = {hideButton:true,color:'#dddddd'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-border-color" ).colorpicker(searchBarBorderColorpickerConfig);
	$("#art-data-new-table-search-bar-border-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-border-color-preview').css('background-color', color);
		
		searchBarBorderBottom[2] = color;
		var borderDeclaration = searchBarBorderBottom.join(' ');

		updateCssRulesTableStructure(".art-data-input","border",borderDeclaration);
	
		//console.log(document.styleSheets)
	});
}); 

/* search bar background color  */
var searchBarBackgroundColorpickerConfig = {hideButton:true,color:'#ffffff'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-background-color" ).colorpicker(searchBarBackgroundColorpickerConfig);
	$("#art-data-new-table-search-bar-background-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-background-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-input","background",color);
	
		//console.log(document.styleSheets)
	});
});

/* search bar text color  */
var searchBarTextColorpickerConfig = {hideButton:true,color:'#444444'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-color" ).colorpicker(searchBarTextColorpickerConfig);
	$("#art-data-new-table-search-bar-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-input","color",color);
	
		//console.log(document.styleSheets)
	});
});

/* search bar background color focus */
var searchBarBackgroundFocusColorpickerConfig = {hideButton:true,color:'#f5fbfe'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-background-color-focus" ).colorpicker(searchBarBackgroundFocusColorpickerConfig);
	$("#art-data-new-table-search-bar-background-color-focus").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-background-color-focus-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-input:focus","background",color);
	
		//console.log(document.styleSheets)
	});
});

/* search bar text color focus */
var searchBarTextFocusColorpickerConfig = {hideButton:true,color:'#444444'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-color-focus" ).colorpicker(searchBarTextFocusColorpickerConfig);
	$("#art-data-new-table-search-bar-color-focus").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-color-focus-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-input:focus","color",color);
	
		//console.log(document.styleSheets)
	});
});

/* search bar border color focus  */
var searchBarBorderFocusColorpickerConfig = {hideButton:true,color:'#99baca'};
jQuery(function($){
	$( "#art-data-new-table-search-bar-border-color-focus" ).colorpicker(searchBarBorderFocusColorpickerConfig);
	$("#art-data-new-table-search-bar-border-color-focus").on("change.color", function(event, color){
		$('#art-data-new-table-search-bar-border-color-focus-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-input:focus","border-color",color);
	
		//console.log(document.styleSheets)
	});
}); 

/* search bar modifier styles */
function toggleSearchBarStylePreview() {
	var classes = searchBarClass.join(' ');

	//console.log(searchBarClass)

	jQuery( "#art-data-table-preview-search-bar" ).removeAttr('class');
	jQuery( "#art-data-table-preview-search-bar" ).attr('class',classes);
}

/* search button modifier styles */
function toggleSearchButtonStylePreview() {
	var classes = searchButtonClass.join(' ');

	//console.log(searchButtonClass)

	jQuery( "#art-data-button-preview" ).removeAttr('class');
	jQuery( "#art-data-button-preview" ).attr('class',classes);
}

/* search button padding */
function toggleSearchButtonPaddingStylePreview(value) {
	updateCssRulesTableStructure(".art-data-button","padding",value);
	//console.log(document.styleSheets)
}

/* search button background color */
var searchButtonBackgroundColorpickerConfig = {hideButton:true,color:'#f5f5f5'};
jQuery(function($){
	$( "#art-data-new-table-search-button-background-color" ).colorpicker(searchButtonBackgroundColorpickerConfig);
	$("#art-data-new-table-search-button-background-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-button-background-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-button","background",color);
	
		//console.log(document.styleSheets)
	});
});

/* search button color */
var searchButtonTextColorpickerConfig = {hideButton:true,color:'#444444'};
jQuery(function($){
	$( "#art-data-new-table-search-button-color" ).colorpicker(searchButtonTextColorpickerConfig);
	$("#art-data-new-table-search-button-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-button-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-button","color",color);
	
		//console.log(document.styleSheets)
	});
});

/* search button border size */
function toggleSearchButtonBorderSizeStylePreview(value) {
	searchButtonBorder[0] = value;
	var borderDeclaration = searchButtonBorder.join(' ');
	updateCssRulesTableStructure(".art-data-button","border",borderDeclaration);
}

/* search button border type */
function toggleSearchButtonBorderTypeStylePreview(value) {
	searchButtonBorder[1] = value;
	var borderDeclaration = searchButtonBorder.join(' ');
	updateCssRulesTableStructure(".art-data-button","border",borderDeclaration);
}

/* search button border color  */
var searchButtonBorderColorpickerConfig = {hideButton:true,color:'#dddddd'};
jQuery(function($){
	$( "#art-data-new-table-search-button-border-color" ).colorpicker(searchButtonBorderColorpickerConfig);
	$("#art-data-new-table-search-button-border-color").on("change.color", function(event, color){
		$('#art-data-new-table-search-button-border-color-preview').css('background-color', color);
		
		searchButtonBorder[2] = color;
		var borderDeclaration = searchButtonBorder.join(' ');

		updateCssRulesTableStructure(".art-data-button","border",borderDeclaration);
	
		//console.log(document.styleSheets)
	});
}); 

/* pagination active background color */
var paginationActiveBackgroundColorConfig = {hideButton:true,color:'#00a8e6'};
jQuery(function($){
	$( "#art-data-new-table-pagination-active-background" ).colorpicker(paginationActiveBackgroundColorConfig);
	$("#art-data-new-table-pagination-active-background").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-active-background-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > .art-data-active > a","background",color);
	
		//console.log(document.styleSheets)
	});
});

/* pagination active text color */
var paginationActiveTextColorConfig = {hideButton:true,color:'#ffffff'};
jQuery(function($){
	$( "#art-data-new-table-pagination-active-color" ).colorpicker(paginationActiveTextColorConfig);
	$("#art-data-new-table-pagination-active-color").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-active-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > .art-data-active > a","color",color);
	
		//console.log(document.styleSheets)
	});
});

/* pagination non-active background color */
var paginationNonActiveBackgroundColorConfig = {hideButton:true,color:'#f5f5f5'};
jQuery(function($){
	$( "#art-data-new-table-pagination-background" ).colorpicker(paginationNonActiveBackgroundColorConfig);
	$("#art-data-new-table-pagination-background").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-background-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > li > a","background",color);
	
		//console.log(document.styleSheets)
	});
});

/* pagination non-active text color */
var paginationNonActiveTextColorConfig = {hideButton:true,color:'#444444'};
jQuery(function($){
	$( "#art-data-new-table-pagination-color" ).colorpicker(paginationNonActiveTextColorConfig);
	$("#art-data-new-table-pagination-color").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > li > a","color",color);
	
		//console.log(document.styleSheets)
	});
});

/* pagination focus & hover background color */
/*var paginationFocusBackgroundColorConfig = {hideButton:true,color:'#fafafa'};
jQuery(function($){
	$( "#art-data-new-table-pagination-focus-hover-background" ).colorpicker(paginationFocusBackgroundColorConfig);
	$("#art-data-new-table-pagination-focus-hover-background").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-focus-hover-background-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus","background-color",color);
	
		console.log(document.styleSheets)
	});
});*/ //this focus and hover css causes problems for active items so removing it

/* pagination focus & hover text color */
/*var paginationFocusTextColorConfig = {hideButton:true,color:'#444444'};
jQuery(function($){
	$( "#art-data-new-table-pagination-focus-hover-color" ).colorpicker(paginationFocusTextColorConfig);
	$("#art-data-new-table-pagination-focus-hover-color").on("change.color", function(event, color){
		$('#art-data-new-table-pagination-focus-hover-color-preview').css('background-color', color);

		updateCssRulesTableStructure(".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus","color",color);
	
		console.log(document.styleSheets)
	});
});*/

/******************************************************************************************
* Functions for saving new table templates
*
*/

function closeTemplateBasicsModal() {
	UIkit.modal( "#art-data-new-template-basics-modal" ).hide();
}

function initSave() {
	jQuery( "#art-data-close" ).val(0);
	UIkit.modal( "#art-data-new-template-basics-modal" ).show();
}

function initSaveClose() {
	jQuery( "#art-data-close" ).val(1);
	UIkit.modal( "#art-data-new-template-basics-modal" ).show();
}

function finalizeSave() {
	jQuery( "#art-data-new-template-content" ).val( JSON.stringify( artDataTableCss ) );
	jQuery( "#art-data-new-template-name-value" ).val( jQuery( "#art-data-new-template-name" ).val() );

	jQuery( "#art-data-new-template-condensed-value" ).val(condensed);
	jQuery( "#art-data-new-template-hover-value" ).val(hover);
	jQuery( "#art-data-new-template-striped-value" ).val(striped);

	document.forms['TemplateForm'].submit();
}

/******************************************************************************************
* Edit template functionality
*
*/

//populate the edit table template preview controls
function populateEditPreviewControls(template) {

	//set the modifiers
	var modifiers = JSON.parse( template.modifier_classes );
	toggleNewIcon(modifiers.condensed,'condensed','art-data-new-table-condensed');
	toggleNewIcon(modifiers.striped,'striped','art-data-new-table-striped');
	toggleNewIcon(modifiers.hover,'hover','art-data-new-table-hover');
	
	//loop the content updating the controls
	//var content = JSON.parse( template.content );
	var content = window.ArtDataTemplateContent;
	for (var i=0;i<content.length;i++) {
		for (var c=0;c<content[i].rules.length;c++) {
			mapRuleToControl(content[i].selector,content[i].rules[c].property,content[i].rules[c].value);
		}		
	}

	return true;
}

function mapRuleToControl(selector,property,value) {

	if ( (selector == '.art-data-table') && (property == 'width') ) {

		jQuery( "#art-data-new-table-width" ).val(value);

	} else if ( (selector == '.art-data-table th') && (property == 'text-align') ) {

		jQuery( "#art-data-new-table-th-text-align" ).val(value);

	} else if ( (selector == '.art-data-table th') && (property == 'padding') ) {

		jQuery( "#art-data-new-table-th-padding" ).val(value);

	} else if ( (selector == '.art-data-table th') && (property == 'font-size') ) {

		jQuery( "#art-data-new-table-th-font-size" ).val(value);

	} else if ( (selector == '.art-data-table th') && (property == 'font-weight') ) {

		jQuery( "#art-data-new-table-th-font-weight" ).val(value);

	} else if ( (selector == '.art-data-table th') && (property == 'color') ) {

		thColorColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-th-color" ).val(value);
		jQuery( "#art-data-new-table-th-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-table th') && (property == 'border-bottom') ) {

		var borderParts = value.split(' ');
		jQuery( "#art-data-new-table-th-border-bottom-size" ).val(borderParts[0]);
		jQuery( "#art-data-new-table-th-border-bottom-type" ).val(borderParts[1]);

		thBorderBottomColorpickerConfig.color = borderParts[2];
		jQuery( "#art-data-new-table-th-border-bottom-color" ).val(borderParts[2]);
		jQuery( "#art-data-new-table-th-border-bottom-color-preview" ).css('background-color',borderParts[2]);

	} else if ( (selector == '.art-data-table td') && (property == 'text-align') ) {

		jQuery( "#art-data-new-table-td-text-align" ).val(value);

	} else if ( (selector == '.art-data-table td') && (property == 'padding') ) {

		jQuery( "#art-data-new-table-td-padding" ).val(value);

	} else if ( (selector == '.art-data-table td') && (property == 'border-bottom') ) {

		var borderParts = value.split(' ');
		jQuery( "#art-data-new-table-td-border-bottom-size" ).val(borderParts[0]);
		jQuery( "#art-data-new-table-td-border-bottom-type" ).val(borderParts[1]);

		tdBorderBottomColorpickerConfig.color = borderParts[2];
		jQuery( "#art-data-new-table-td-border-bottom-color" ).val(borderParts[2]);
		jQuery( "#art-data-new-table-td-border-bottom-color-preview" ).css('background-color',borderParts[2]);

	} else if ( (selector == '.art-data-table-striped tbody tr:nth-of-type(2n+1)') && (property == 'background') ) {
		
		tdBackgroundColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-td-striped-background-color" ).val(value);
		jQuery( "#art-data-new-table-td-striped-background-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-input') && (property == 'height') ) {

		jQuery( "#art-data-new-table-search-bar-height" ).val(value);

	} else if ( (selector == '.art-data-input') && (property == 'width') ) {

		jQuery( "#art-data-new-table-search-bar-width" ).val(value);

	} else if ( (selector == '.art-data-input') && (property == 'padding') ) {

		jQuery( "#art-data-new-table-search-bar-padding" ).val(value);

	} else if ( (selector == '.art-data-input') && (property == 'border') ) {

		var borderParts = value.split(' ');
		jQuery( "#art-data-new-table-search-bar-border-size" ).val(borderParts[0]);
		jQuery( "#art-data-new-table-search-bar-border-type" ).val(borderParts[1]);

		searchBarBorderColorpickerConfig.color = borderParts[2];
		jQuery( "#art-data-new-table-search-bar-border-color" ).val(borderParts[2]);
		jQuery( "#art-data-new-table-search-bar-border-color-preview" ).css('background-color',borderParts[2]);

	} else if ( (selector == '.art-data-input') && (property == 'background') ) {

		searchBarBackgroundColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-bar-background-color" ).val(value);
		jQuery( "#art-data-new-table-search-bar-background-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-input') && (property == 'color') ) {

		searchBarTextColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-bar-color" ).val(value);
		jQuery( "#art-data-new-table-search-bar-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-input:focus') && (property == 'background') ) {

		searchBarBackgroundFocusColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-bar-background-color-focus" ).val(value);
		jQuery( "#art-data-new-table-search-bar-background-color-focus-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-input:focus') && (property == 'color') ) {

		searchBarTextFocusColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-bar-color-focus" ).val(value);
		jQuery( "#art-data-new-table-search-bar-color-focus-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-input:focus') && (property == 'border-color') ) {

		searchBarBorderFocusColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-bar-border-color-focus" ).val(value);
		jQuery( "#art-data-new-table-search-bar-border-color-focus-preview" ).css('background-color',value);

	//v2.2.9 remove button styling (frontend has no button)
	/*} else if ( (selector == '.art-data-button') && (property == 'padding') ) {

		jQuery( "#art-data-new-table-search-button-padding" ).val(value);

	} else if ( (selector == '.art-data-button') && (property == 'background') ) {

		searchButtonBackgroundColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-button-background-color" ).val(value);
		jQuery( "#art-data-new-table-search-button-background-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-button') && (property == 'color') ) {

		searchButtonTextColorpickerConfig.color = value;
		jQuery( "#art-data-new-table-search-button-color" ).val(value);
		jQuery( "#art-data-new-table-search-button-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-button') && (property == 'border') ) {

		var borderParts = value.split(' ');
		jQuery( "#art-data-new-table-search-button-border-size" ).val(borderParts[0]);
		jQuery( "#art-data-new-table-search-button-border-type" ).val(borderParts[1]);

		searchButtonBorderColorpickerConfig.color = borderParts[2];
		jQuery( "#art-data-new-table-search-button-border-color" ).val(borderParts[2]);
		jQuery( "#art-data-new-table-search-button-border-color-preview" ).css('background-color',borderParts[2]); */

	} else if ( (selector == '.art-data-pagination > .art-data-active > a') && (property == 'background') ) {

		paginationActiveBackgroundColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-active-background" ).val(value);
		jQuery( "#art-data-new-table-pagination-active-background-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-pagination > .art-data-active > a') && (property == 'color') ) {

		paginationActiveTextColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-active-color" ).val(value);
		jQuery( "#art-data-new-table-pagination-active-color-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-pagination > li > a') && (property == 'background') ) {

		paginationNonActiveBackgroundColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-background" ).val(value);
		jQuery( "#art-data-new-table-pagination-background-preview" ).css('background-color',value);

	} else if ( (selector == '.art-data-pagination > li > a') && (property == 'color') ) {

		paginationNonActiveTextColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-color" ).val(value);
		jQuery( "#art-data-new-table-pagination-color-preview" ).css('background-color',value);

	} /*else if ( (selector == '.art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus') && (property == 'background-color') ) {
		
		paginationFocusBackgroundColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-focus-hover-background" ).val(value);
		jQuery( "#art-data-new-table-pagination-focus-hover-background-preview" ).css('background-color',value);
	
	} else if ( (selector == '.art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus') && (property == 'color') ) {
		
		paginationFocusTextColorConfig.color = value;
		jQuery( "#art-data-new-table-pagination-focus-hover-color" ).val(value);
		jQuery( "#art-data-new-table-pagination-focus-hover-color-preview" ).css('background-color',value);
	
	} */

}
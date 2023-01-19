/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

/******************************************************************************************
* Functions for rendering a CSS stylesheet from artDataTableCss JSON
*
*/

function updateCssRulesTableStructure(selector,property,value) {
	for (var i=0;i<artDataTableCss.length;i++) {
		if (artDataTableCss[i].selector == selector) {

			//console.log(artDataTableCss[i])
			var rules = artDataTableCss[i].rules;

			for (var c=0;c<rules.length;c++) {
				if (rules[c].property == property) {
					rules[c].value = value; //+' !important'
				}
			} 
		}
	}

	renderCssRuleChanges();
}

function renderCssRuleChanges() {

	var artDataTableStyleSheet = getArtDataTableStyleSheet();

	if (artDataTableStyleSheet) {

		//var styleDeclarations = '';
		for (var i=0;i<artDataTableCss.length;i++) {

			var selector = artDataTableCss[i].selector;

			for (var c=0;c<artDataTableCss[i].rules.length;c++) {

				var propertyName = artDataTableCss[i].rules[c].property;
				var camelizedPropertyName = (propertyName.indexOf('-') !== -1) ? camelizeCssPropertyName(propertyName) : propertyName ;

				alterCssRule(artDataTableStyleSheet,selector,camelizedPropertyName,artDataTableCss[i].rules[c].value);

			}
		}	

	} else {

	}

}

function alterCssRule(stylesheet,selector,propertyName,value) {

	for (var i=0;i<stylesheet.cssRules.length;i++) {
		if (stylesheet.cssRules[i].selectorText == selector) {
			if (propertyName == 'borderBottom') {
				stylesheet.cssRules[i].style[propertyName] = value; //change the css property value
			} else {
				stylesheet.cssRules[i].style.setProperty(propertyName,value,"important"); //set it to important
			}
		}
	}

}

function camelizeCssPropertyName(propertyName) {
	propertyName = propertyName.split("-");
	return propertyName[0] + propertyName[1].charAt(0).toUpperCase() + propertyName[1].slice(1);
}

function getArtDataTableStyleSheet() {
	var styleSheets = document.styleSheets;
	for (var i=0;i<styleSheets.length;i++) {
		if (styleSheets[i].title == 'art-data-table') { //this is the stylesheet
			return styleSheets[i];
		}
	}

	return false;
}
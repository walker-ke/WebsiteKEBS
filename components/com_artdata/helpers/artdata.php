<?php
/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

defined('_JEXEC') or die;

class ArtDataHelper
{

	public static function isValueNumeric($value) {
	    if ($value == (string) (float) $value) {
	        return (bool) is_numeric($value);
	    }
	    if ($value >= 0 && is_string($value) && !is_float($value)) {
	        return (bool) ctype_digit($value);
	    }
	    return (bool) is_numeric($value);
	}

	public static function camelize($str, $noStrip = array()) {
        // non-alpha and non-numeric characters become spaces
        $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
        $str = trim($str);
        // uppercase the first character of each word
        $str = ucwords($str);
        $str = str_replace(" ", "", $str);
        $str = lcfirst($str);

        return $str;
	}

	public static function createTableCssContent($json) {
		//$artDataTableCSSJson = '[{selector:".art-data-table",rules:[{property:"border-collapse",value:"collapse"},{property:"border-spacing",value:"0"},{property:"margin-bottom",value:"15px"},{property:"width",value:"100%"}]},{selector:"* + .art-data-table",rules:[{property:"margin-top",value:"15px"}]},{selector:".art-data-table th",rules:[{property:"padding",value:"8px 8px"},{property:"text-align",value:"left"},{property:"border-bottom",value:"1px solid #dddddd"},{property:"font-size",value:"14px"},{property:"font-weight",value:"bold"},{property:"color",value:"#444444"}]},{selector:".art-data-table td",rules:[{property:"padding",value:"8px 8px"},{property:"vertical-align",value:"top"},{property:"text-align",value:"left"},{property:"border-bottom",value:"1px solid #dddddd"}]},{selector:".art-data-table thead th",rules:[{property:"vertical-align",value:"bottom"}]},{selector:".art-data-table-middle, .art-data-table-middle td",rules:[{property:"vertical-align",value:"middle"}]},{selector:".art-data-table-striped tbody tr:nth-of-type(2n+1)",rules:[{property:"background",value:"#fafafa"}]},{selector:".art-data-table-condensed td",rules:[{property:"padding",value:"4px 8px"}]},{selector:".art-data-button",rules:[{property:"margin",value:"0"},{property:"border",value:"none"},{property:"overflow",value:"visible"},{property:"color",value:"#444444"},{property:"text-transform",value:"none"},{property:"display",value:"inline-block"},{property:"box-sizing",value:"border-box"},{property:"padding",value:"0 12px"},{property:"background",value:"#f5f5f5"},{property:"vertical-align",value:"middle"},{property:"line-height",value:"28px"},{property:"min-height",value:"30px"},{property:"font-size",value:"1rem"},{property:"text-decoration",value:"none"},{property:"text-align",value:"center"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"},{property:"border-radius",value:"4px"}]},{selector:".art-data-button:not(:disabled)",rules:[{property:"cursor",value:"pointer"}]},{selector:".art-data-button:hover, .art-data-button:focus",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#444444"},{property:"outline",value:"none"},{property:"text-decoration",value:"none"},{property:"border-color",value:"rgba(0, 0, 0, 0.16)"}]},{selector:".art-data-button:active, .art-data-button.art-data-active",rules:[{property:"background-color",value:"#eeeeee"},{property:"color",value:"#444444"}]},{selector:".art-data-button:disabled",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#999999"},{property:"border-color",value:"rgba(0, 0, 0, 0.06)"},{property:"box-shadow",value:"none"}]},{selector:".art-data-button-small",rules:[{property:"min-height",value:"25px"},{property:"padding",value:"0 10px"},{property:"line-height",value:"23px"},{property:"font-size",value:"12px"}]},{selector:".art-data-button-large",rules:[{property:"min-height",value:"40px"},{property:"padding",value:"0 15px"},{property:"line-height",value:"38px"},{property:"font-size",value:"0.001px"}]},{selector:".art-data-clearfix",rules:[{property:"clear",value:"both"}]},{selector:".art-data-width-1-1",rules:[{property:"width",value:"100%"}]},{selector:".art-data-form",rules:[{property:"margin",value:"0"}]},{selector:".art-data-input",rules:[{property:"vertical-align",value:"middle"},{property:"box-sizing",value:"border-box"},{property:"height",value:"30px"},{property:"width",value:"206px"},{property:"max-width",value:"100%"},{property:"padding",value:"4px 6px"},{property:"margin-bottom",value:"0"},{property:"border",value:"1px solid #dddddd"},{property:"background",value:"#ffffff"},{property:"color",value:"#444444"},{property:"transition",value:"all linear 0.2s"},{property:"border-radius",value:"4px"}]},{selector:".art-data-input:focus",rules:[{property:"border-color",value:"99baca"},{property:"outline",value:"0"},{property:"background",value:"#f5fbfe"},{property:"color",value:"#444444"}]},{selector:".art-data-input.art-data-input-large",rules:[{property:"height",value:"16px"},{property:"padding",value:"8px 6px"},{property:"font-size",value:"16px"}]},{selector:".art-data-input.art-data-input-small",rules:[{property:"height",value:"25px"},{property:"padding",value:"3px 3px"},{property:"font-size",value:"12px"}]},{selector:".art-data-input.art-data-input-display-field",rules:[{property:"width",value:"50px"}]},{selector:".art-data-pagination",rules:[{property:"padding",value:"0"},{property:"list-style",value:"none"},{property:"text-align",value:"center"},{property:"font-size",value:"16px"},{property:"border-radius",value:"5px"}]},{selector:".art-data-pagination:before, .art-data-pagination:after",rules:[{property:"content",value:"''"},{property:"display",value:"table"}]},{selector:".art-data-pagination:after",rules:[{property:"clear",value:"both"}]},{selector:".art-data-pagination > li",rules:[{property:"display",value:"inline-block"},{property:"font-size",value:"1rem"},{property:"vertical-align",value:"top"}]},{selector:".art-data-pagination > li:nth-child(n+2)",rules:[{property:"margin-left",value:"5px"}]},{selector:".art-data-pagination > li > a, .art-data-pagination > li > span",rules:[{property:"display",value:"inline-block"},{property:"min-width",value:"16px"},{property:"padding",value:"3px 5px"},{property:"line-height",value:"20px"},{property:"text-decoration",value:"none"},{property:"box-sizing",value:"content-box"},{property:"text-align",value:"center"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"},{property:"border-radius",value:"4px"}]},{selector:".art-data-pagination > li > a",rules:[{property:"background",value:"#f5f5f5"},{property:"color",value:"#444444"}]},{selector:".art-data-pagination > li > a:hover, .art-data-pagination > li > a:focus",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#444444"},{property:"outline",value:"none"},{property:"border-color",value:"rgba(0, 0, 0, 0.16)"}]},{selector:".art-data-pagination > li > a:active",rules:[{property:"background-color",value:"#eeeeee"},{property:"color",value:"#444444"}]},{selector:".art-data-pagination > .art-data-active > span",rules:[{property:"background",value:"#00a8e6"},{property:"color",value:"#ffffff"},{property:"border-color",value:"transparent"},{property:"box-shadow",value:"inset 0 0 5px rgba(0, 0, 0, 0.05)"}]},{selector:".art-data-pagination > .art-data-disabled > span",rules:[{property:"background-color",value:"#fafafa"},{property:"color",value:"#999999"},{property:"border",value:"1px solid rgba(0, 0, 0, 0.06)"}]},{selector:".art-data-pagination-previous",rules:[{property:"float",value:"left"}]},{selector:".art-data-pagination-next",rules:[{property:"float",value:"right"}]},{selector:".art-data-pagination-left",rules:[{property:"text-align",value:"left"}]},{selector:".art-data-pagination-right",rules:[{property:"text-align",value:"right"}]}]';
		$CssDeclarations = json_decode($json);

		$CSS = "";

		foreach ($CssDeclarations as $declaration) {
			$CSS .= $declaration->selector."{\n";
			foreach ($declaration->rules as $rule) {
				$CSS .= $rule->property.":".$rule->value." !important;\n";
			}
			$CSS .= "}\n";
		}

		return $CSS;
	}

}


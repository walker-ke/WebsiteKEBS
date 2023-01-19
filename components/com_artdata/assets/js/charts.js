/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

var showTicks = true;

//modify the layout for template creation/editing
jQuery( document ).ready(function($) {



    //loop over instances of ArtData Charts and bootstrap ArtDataChart js to each one
    var ArtDataChartApps = document.getElementsByClassName("art-data-chart-app");
    //console.log(ArtDataChartApps)
    for (var i=0;i<ArtDataChartApps.length;i++) {

    	//get visualization data
    	var visualizationId = jQuery(ArtDataChartApps[i]).data('artdataid');
    	var visualizationItem = window['ArtDataItem'+visualizationId];

		//set the config
		ArtDataChart.config = window['ArtDataTemplateContent'+visualizationId];

		ArtDataChart.config.meta.caption = (visualizationItem.config_meta_caption !=="") ? visualizationItem.config_meta_caption : '' ;
		ArtDataChart.config.meta.subcaption = (visualizationItem.config_meta_subcaption !=="") ? visualizationItem.config_meta_subcaption : '' ;
		ArtDataChart.config.meta.hlabel = (visualizationItem.config_meta_hlabel !=="") ? visualizationItem.config_meta_hlabel : '' ;
		ArtDataChart.config.meta.hsublabel = (visualizationItem.config_meta_hsublabel !=="") ? visualizationItem.config_meta_hsublabel : '' ;
		ArtDataChart.config.meta.vlabel = (visualizationItem.config_meta_vlabel !=="") ? visualizationItem.config_meta_vlabel : '' ;
		ArtDataChart.config.meta.vsublabel = (visualizationItem.config_meta_vsublabel !=="") ? visualizationItem.config_meta_vsublabel : '' ;
		ArtDataChart.config.meta.isDownloadable = (visualizationItem.config_meta_isDownloadable) ? true : false ;
		ArtDataChart.config.meta.downloadLabel = (visualizationItem.config_meta_downloadLabel !=="") ? visualizationItem.config_meta_downloadLabel : '' ;

		ArtDataChart.config.dimension.width = parseInt(ArtDataChart.config.dimension.width);
		ArtDataChart.config.dimension.height = parseInt(ArtDataChart.config.dimension.height);

		ArtDataChart.config.graph.orientation = (visualizationItem.config_graph_orientation !="") ? visualizationItem.config_graph_orientation : 'Horizontal';

		/*TODO offer the ability to turn legend off and on to templates*/
		//hide the legend for single series charts
		if (window['ArtDataChartDefinition'+visualizationId].categories.length == 1) {

			var legend = {
				    position: 'bottom',
				    fontfamily: 'Arial',
				    fontsize: '11',
				    fontweight: 'normal',
				    color: "#000000",
				    strokewidth: 0.15,
				    textmargin: 15,
				    symbolsize: 10,
				    inactivecolor: '#DDD',
				    legendstart: 0,
				    legendtype: 'categories',
				    showlegends: false
			};

			ArtDataChart.config.legend = legend;
		}

		//sanitize integers
		window['ArtDataChartDefinition'+visualizationId].dataset = ArtDataChart.sanitize(window['ArtDataChartDefinition'+visualizationId].dataset);
		
		//console.log(window['ArtDataChartDefinition'+visualizationId])

		//draw charts
		ArtDataChart.drawChart(window['ArtDataChartDefinition'+visualizationId],'#art-data-chart-app-'+visualizationId,visualizationItem.type);

    }

});

/******************************************************************************************
* define chart library wrapper object
*
*/

var ArtDataChart = {
	
	drawn : [],

	config : {
			    meta : {
			    	position: '',
			        caption : '',
			        subcaption : '',
			        hlabel : '',
			        hsublabel : '',
			        vlabel : '',
			        vsublabel : '',
			        isDownloadable : false,
			        downloadLabel : 'Download'
			    },
			    graph : {
			    	custompalette : ["#7E6DA1","#C2CF30","#FF8900","#FE2600","#E3003F","#8E1E5F","#FE2AC2","#CCF030","#9900EC","#3A1AA8","#3932FE","#3276FF","#35B9F6","#42BC6A","#91E0CB"],
			    	bgcolor : "#ffffff",
			    	opacity : 1,
			    	orientation : 'Horizontal'
			    },
			    dimension : {
			    	width : 400,
			    	height : 400
			    },
			    axis : {
			    	strokecolor : '#000000',
			    	ticks : 8,
			    	padding : 5
			    },
			    legend: {
				    position: 'bottom',
				    fontfamily: 'Arial',
				    fontsize: '11',
				    fontweight: 'normal',
				    color: "#000000",
				    strokewidth: 0.15,
				    textmargin: 15,
				    symbolsize: 10,
				    inactivecolor: '#DDD',
				    legendstart: 0,
				    legendtype: 'categories',
				    showlegends: true
				}
			 },

	drawChart : function (dataSource,htmlId,type) {

		if (this.drawn.indexOf(htmlId) == -1) { //we haven't drawn this chart yet
			this.drawn.push(htmlId);
		} else { //this chart has already been drawn
			return false;
		}

		this.config.meta.position = htmlId;
		var BarChart = uv.chart (type, dataSource, this.config);
	},

	sanitize : function(dataset) {

		//make sure integers are represented as integers (not strings)
		for (var key in dataset) {
			for (var i=0;i<dataset[key].length;i++) {
				var columnValue = dataset[key][i].value;
				//let's test to see if this number is an integer
				var falsePositives = ['',' ',true,null]; //isNaN function thinks these are integers
				//test to see if this is a number
				if ( (falsePositives.indexOf(columnValue) == -1) && (!isNaN(columnValue)) ) { 
					//this is an integer
					dataset[key][i].value = Number(columnValue); //make sure this is an int
				}
			}
		}

		return dataset;
	}

};

var alreadyRan = true;
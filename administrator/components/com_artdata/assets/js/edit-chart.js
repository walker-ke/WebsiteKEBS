/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */

var graphDef = {
    categories : ['Group1', 'Group2', 'Group3', 'Group4'],
    dataset : {
        'Group1' : [
            { name : '2013', value : 60 },
            { name : '2014', value : 97 },
            { name : '2015', value : 560 },
            { name : '2016', value : 999 }
        ],

        'Group2' : [
            { name : '2013', value : 75 },
            { name : '2014', value : 90 },
            { name : '2015', value : 740 },
            { name : '2016', value : 890 }      
        ],

        'Group3' : [
            { name : '2013', value : 88 },
            { name : '2014', value : 100 },
            { name : '2015', value : 420 },
            { name : '2016', value : 769 }  
        ],

        'Group4' : [
            { name : '2013', value : 120 },
            { name : '2014', value : 157 },
            { name : '2015', value : 450 },
            { name : '2016', value : 1024 } 
        ]

        
    }
};

var showTicks = true;

//modify the layout for template creation/editing
jQuery( document ).ready(function($) {
	
	//hide last remnants of isis template
	$( ".navbar" ).hide();
	$( "#status" ).hide();
	$( ".subhead-collapse.collapse" ).css('top','0px');

	//remove loading screen
	/*setTimeout(function () {
		$( "#art-data-loading-content" ).hide();
		$( "#art-data-preview-table-container" ).show();
		if (window.ArtDataLayout == 'default_edit_table') {
			$( "#art-data-loading-controls" ).hide();
			$( "#art-data-controls-container" ).show();				
		}
	}, 2000);*/

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


	//create the charts
	ArtDataChart.createBarChart(graphDef,'#uv-div-bar');
	ArtDataChart.createStackedBarChart(graphDef,'#uv-div-stackedbar');
	ArtDataChart.createPercentBarChart(graphDef,'#uv-div-percentbar');
	ArtDataChart.createStepUpBarChart(graphDef,'#uv-div-stepupbar');
	ArtDataChart.createWaterfallChart(graphDef,'#uv-div-waterfall');
	ArtDataChart.createLineChart(graphDef,'#uv-div-line');
	ArtDataChart.createAreaChart(graphDef,'#uv-div-area');
	ArtDataChart.createStackedAreaChart(graphDef,'#uv-div-stackedarea');
	ArtDataChart.createPercentAreaChart(graphDef,'#uv-div-percentarea');
	ArtDataChart.createPieChart(graphDef,'#uv-div-pie');
	ArtDataChart.createDonutChart(graphDef,'#uv-div-donut');

});

/******************************************************************************************
* initiate creation of charts, define chart object
*
*/

var ArtDataChart = {
	
	config : {
			    meta : {
			    	position: '',
			        caption : 'Some Graphical Data',
			        subcaption : 'Displayed for Chart Template Preview',
			        hlabel : 'Data',
			        vlabel : 'Years'
			    },
			    graph : {
			    	custompalette : ["#7E6DA1","#C2CF30","#FF8900","#FE2600","#E3003F","#8E1E5F","#FE2AC2","#CCF030","#9900EC","#3A1AA8","#3932FE","#3276FF","#35B9F6","#42BC6A","#91E0CB"],
			    	bgcolor : "#ffffff",
			    	opacity : 1
			    },
			    dimension : {
			    	width : 400,
			    	height : 400
			    },
			    axis : {
			    	strokecolor : '#000000',
			    	ticks : 8,
			    	padding : 5
			    }
			 },

	createBarChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var BarChart = uv.chart ('Bar', dataSource, this.config);
	},
	createStackedBarChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var StackedBarChart = uv.chart ('StackedBar', graphDef, this.config);
	},
	createPercentBarChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var PercentBarChart = uv.chart ('PercentBar', graphDef, this.config);
	},
	createStepUpBarChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var StepUpBarChart = uv.chart ('StepUpBar', graphDef, this.config);
	},
	createWaterfallChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var WaterfallChart = uv.chart ('Waterfall', graphDef, this.config);
	},
	createLineChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var LineChart = uv.chart ('Line', graphDef,this.config);
	},
	createAreaChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var AreaChart = uv.chart ('Area', graphDef, this.config);
	},
	createStackedAreaChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var StackedAreaChart = uv.chart ('StackedArea', graphDef, this.config);
	},
	createPercentAreaChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var PercentAreaChart = uv.chart ('PercentArea', graphDef, this.config);
	},
	createPieChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var PieChart = uv.chart ('Pie', graphDef, this.config); 
	},
	createDonutChart : function (dataSource,htmlId) {
		this.config.meta.position = htmlId;
		var DonutChart = uv.chart ('Donut', graphDef, this.config);
	},
	redrawAllCharts : function () {

		//erase all charts prior to redraw
		this.eraseAllCharts();

		//create the charts
		this.createBarChart(graphDef,'#uv-div-bar');
		this.createStackedBarChart(graphDef,'#uv-div-stackedbar');
		this.createPercentBarChart(graphDef,'#uv-div-percentbar');
		this.createStepUpBarChart(graphDef,'#uv-div-stepupbar');
		this.createWaterfallChart(graphDef,'#uv-div-waterfall');
		this.createLineChart(graphDef,'#uv-div-line');
		this.createAreaChart(graphDef,'#uv-div-area');
		this.createStackedAreaChart(graphDef,'#uv-div-stackedarea');
		this.createPercentAreaChart(graphDef,'#uv-div-percentarea');
		this.createPieChart(graphDef,'#uv-div-pie');
		this.createDonutChart(graphDef,'#uv-div-donut');		
	},
	eraseAllCharts : function () {
		//erase all charts
		jQuery( "#uv-div-bar" ).empty();
		jQuery( "#uv-div-stackedbar" ).empty();
		jQuery( "#uv-div-percentbar" ).empty();
		jQuery( "#uv-div-stepupbar" ).empty();
		jQuery( "#uv-div-waterfall" ).empty();
		jQuery( "#uv-div-line" ).empty();
		jQuery( "#uv-div-area" ).empty();
		jQuery( "#uv-div-stackedarea" ).empty();
		jQuery( "#uv-div-percentarea" ).empty();
		jQuery( "#uv-div-pie" ).empty();
		jQuery( "#uv-div-donut" ).empty();		
	}

};


/******************************************************************************************
* Misc edit layout functions
*
*/

function toggleBarChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).show();

	jQuery( "#uv-div-bar" ).empty();
	//create the charts
	ArtDataChart.createBarChart(graphDef,'#uv-div-bar');	
}

function toggleStackedBarChartPreviewTab() {
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-stackedbar" ).show();

	jQuery( "#uv-div-stackedbar" ).empty();
	//create the charts
	ArtDataChart.createStackedBarChart(graphDef,'#uv-div-stackedbar');	
}

function togglePercentBarChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).show();

	jQuery( "#uv-div-percentbar" ).empty();
	//create the charts
	ArtDataChart.createPercentBarChart(graphDef,'#uv-div-percentbar');	
}

function toggleStepUpBarChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).show();

	jQuery( "#uv-div-stepupbar" ).empty();
	//create the charts
	ArtDataChart.createStepUpBarChart(graphDef,'#uv-div-stepupbar');
}

function toggleWaterfallChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).show();

	jQuery( "#uv-div-waterfall" ).empty();
	//create the charts
	ArtDataChart.createWaterfallChart(graphDef,'#uv-div-waterfall');
}

function toggleLineChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-line" ).show();

	jQuery( "#uv-div-line" ).empty();
	//create the charts
	ArtDataChart.createLineChart(graphDef,'#uv-div-line');	
}

function toggleAreaChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-area" ).show();	

	jQuery( "#uv-div-area" ).empty();
	//create the charts
	ArtDataChart.createAreaChart(graphDef,'#uv-div-area');
}

function toggleStackedAreaChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).show();

	jQuery( "#uv-div-stackedarea" ).empty();
	//create the charts
	ArtDataChart.createStackedAreaChart(graphDef,'#uv-div-stackedarea');	
}

function togglePercentAreaChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).show();

	jQuery( "#uv-div-percentarea" ).empty();
	//create the charts
	ArtDataChart.createPercentAreaChart(graphDef,'#uv-div-percentarea');
}

function togglePieChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).show();	

	jQuery( "#uv-div-pie" ).empty();
	//create the charts
	ArtDataChart.createPieChart(graphDef,'#uv-div-pie');	
}

function toggleDonutChartPreviewTab() {
	jQuery( "#art-data-chart-preview-stackedbar" ).hide();
	jQuery( "#art-data-chart-preview-percentbar" ).hide();
	jQuery( "#art-data-chart-preview-stepupbar" ).hide();
	jQuery( "#art-data-chart-preview-waterfall" ).hide();
	jQuery( "#art-data-chart-preview-line" ).hide();
	jQuery( "#art-data-chart-preview-area" ).hide();
	jQuery( "#art-data-chart-preview-stackedarea" ).hide();
	jQuery( "#art-data-chart-preview-percentarea" ).hide();
	jQuery( "#art-data-chart-preview-pie" ).hide();
	jQuery( "#art-data-chart-preview-bar" ).hide();
	jQuery( "#art-data-chart-preview-donut" ).show();

	jQuery( "#uv-div-donut" ).empty();
	//create the charts
	ArtDataChart.createDonutChart(graphDef,'#uv-div-donut');	
}

/******************************************************************************************
* preview / modify the chart palette & config 
*
*/

function modifyChartPalette(index,color) {

	//console.log('index = '+index+' color = '+color)

	ArtDataChart.config.graph.custompalette[index] = color;

	ArtDataChart.redrawAllCharts();
}

function modifyChartConfig(field,value) {

	if (field == 'background') {
		ArtDataChart.config.graph.bgcolor = value;
	} else if (field == 'opacity') {
		ArtDataChart.config.graph.opacity = value;
	} else if (field == 'width') {
		ArtDataChart.config.dimension.width = value;
	} else if (field == 'height') {	
		ArtDataChart.config.dimension.height = value;
	} else if (field == 'axislines') {
		ArtDataChart.config.axis.strokecolor = value;
	} else if (field == 'ticks') {
		ArtDataChart.config.axis.ticks = value;
	} else if (field == 'axispadding') {
		ArtDataChart.config.axis.padding = value;
	}

	//re-render all charts with changes
	ArtDataChart.redrawAllCharts();
}

/* change the background color of the chart */
jQuery(function($){
	$( "#art-data-chart-background" ).colorpicker({hideButton:true,color:'#ffffff'});
	$("#art-data-chart-background").on("change.color", function(event, color){
	    $('#art-data-chart-background-preview').css('background-color', color);
	    modifyChartConfig('background',color);
	});
}); 

/* change the color of the axis lines */
jQuery(function($){
	$( "#art-data-chart-axis-color" ).colorpicker({hideButton:true,color:'#000000'});
	$("#art-data-chart-axis-color").on("change.color", function(event, color){
	    $('#art-data-chart-axis-color-preview').css('background-color', color);
	    modifyChartConfig('axislines',color);
	});
}); 

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
		case 'showTicks':
				if (state == 1) {
					ArtDataChart.config.axis.showticks = true;
				} else {
					ArtDataChart.config.axis.showticks = false;
				}

				//re-render all charts with changes
				ArtDataChart.redrawAllCharts();				
			break;		
	}

	
}

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
	jQuery( "#art-data-new-template-content" ).val( JSON.stringify( ArtDataChart.config ) );
	jQuery( "#art-data-new-template-name-value" ).val( jQuery( "#art-data-new-template-name" ).val() );

	document.forms['TemplateForm'].submit();
}




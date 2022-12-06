var SpreadSheet;
var VisualizationType = '';
var Series = '';

var ArtDataSpreadsheetData = {};

//ArtDataSpreadsheetData.multiple_series 
//ArtDataSpreadsheetData.single_series 

ArtDataSpreadsheetData.multiple_series = [
  ["", "Ford", "Volvo", "Toyota", "Honda"],
  ["2016", 10, 11, 12, 13],
  ["2017", 20, 11, 14, 13],
  ["2018", 30, 15, 12, 13]
];

ArtDataSpreadsheetData.single_series = [
  ["Ford", "Volvo", "Toyota", "Honda"],
  [10, 11, 12, 13]
];

//ensure that on edit, the original data doesn't get reset with this sample data
if (!window.ArtDataDataset) {
	ArtDataSpreadsheetData.single_series_table = [
	  ["Ford", "Volvo", "Toyota", "Honda"],
	  [10, 11, 12, 13],
	  [20, 11, 14, 13],
	  [30, 15, 12, 13]
	];
} else {
	if (window.ArtDataDataset.content !=='') {
		ArtDataSpreadsheetData.single_series_table = JSON.parse( window.ArtDataDataset.content );
	}
}


//	cell: [{row: 0, col: 0, readOnly: true}],
var SpreadSheetConfig = {
  	data: [],
  	stretchH: 'all',
	fixedRowsTop: 1,
	fixedColumnsTop: 1,
	fixedColumnsLeft: 1,
	rowHeaders: true,
	colHeaders: true,
	manualColumnMove: true,
	manualRowMove: true,
	minSpareRows: 0,
	minSpareCols: 0,
	contextMenu: true,
	autoWrapCol: true,
	autoWrapRow: true,
	afterChange: function (change, source) {},
	afterColumnMove: function (startColumn, endColumn) {},
	afterRowMove: function (startColumn, endColumn) {}
};

jQuery( document ).ready(function() {

	//hide last remnants of isis template
	jQuery( ".navbar" ).hide();
	jQuery( "#status" ).hide();
	jQuery( ".subhead-collapse.collapse" ).css('top','0px');

});

function addSpreadSheetColumn() {
	SpreadSheet.alter('insert_col', null);
}

function removeSpreadSheetColumn() {
	SpreadSheet.alter('remove_col', null);	
}

function addSpreadSheetRow() {
	SpreadSheet.alter('insert_row', null);	
}

function removeSpreadSheetRow() {
	SpreadSheet.alter('remove_row', null);	
}

var graphDef = {
    categories : ['Ford', 'Volvo', 'Toyota', 'Honda'],
    dataset : {

        'Ford' : [
            { name : '2016', value : 10 },
            { name : '2017', value : 20 },
            { name : '2018', value : 30 }
        ],

        'Volvo' : [
            { name : '2016', value : 11 },
            { name : '2017', value : 11 },
            { name : '2018', value : 15 }  
        ],

        'Toyota' : [
            { name : '2016', value : 12 },
            { name : '2017', value : 14 },
            { name : '2018', value : 12 }
        ],

        'Honda' : [
            { name : '2016', value : 13 },
            { name : '2017', value : 13 },
            { name : '2018', value : 13 } 
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

	//if we're editing then let's do some stuff
	if (window.ArtDataDataset) {

		setTimeout(function(){ 
			//hide loading screen show basic form
			$( "#art-data-dataset-loading-container" ).hide();
			$( "#art-data-dataset-basic-form-item-container" ).show();

			//now let's populate the form

			$( "#art-data-dataset-name" ).val(window.ArtDataDataset.name);

			$( "#art-data-dataset-item-id" ).val(window.ArtDataDataset.id);

			if (window.ArtDataDataset.type == 'table') {
				var data = JSON.parse(window.ArtDataDataset.content);
				visualizationTypeSelectionActivate(window.ArtDataDataset.type,data);
				$( "#art-data-dataset-visualization-type" ).val(window.ArtDataDataset.type);
				//seriesSelectionActivate(window.ArtDataDataset.series);
			} else {
				var data = translateChartDataToSpreadsheetData();
					
				$( "#art-data-dataset-visualization-type" ).val(window.ArtDataDataset.type);
				$( "#art-data-dataset-series" ).val(window.ArtDataDataset.series);

				visualizationTypeSelectionActivate(window.ArtDataDataset.type);
				graphDef = JSON.stringify(window.ArtDataDataset.content);
				seriesSelectionActivate(window.ArtDataDataset.series,data);	

			}



		}, 2000);




		

	}


});

function visualizationTypeSelectionActivate(value,data) {
	VisualizationType = value;
	if (value == 'table') {

		Series = 'single';
		jQuery( "#art-data-dataset-series" ).val(Series);

		jQuery( '#art-data-dataset-series-row' ).hide();

		jQuery( "#art-data-spreadsheet" ).empty();
		jQuery( "#art-data-spreadsheet-container" ).show();

		var ssdata = ( (data) && (data.length > 0) ) ? data : ArtDataSpreadsheetData.single_series_table ;
		SpreadSheetConfig.data = ssdata;
		SpreadSheet = new Handsontable(document.getElementById('art-data-spreadsheet'),SpreadSheetConfig);

		toggleTablePreview(); //show the table preview

	} else if (value == 'chart') {
		jQuery( "#art-data-table-preview" ).empty();
		jQuery( "#art-data-table-preview-container" ).hide();
		jQuery( '#art-data-dataset-series-row' ).show();
		jQuery( "#art-data-dataset-preview" ).show();

		if (Series.length > 0) {
			seriesSelectionActivate(Series);
		} 

	} else {
		jQuery( '#art-data-dataset-series-row' ).hide();
		jQuery( "#art-data-spreadsheet-container" ).hide();
		jQuery( "#art-data-dataset-preview" ).hide();
	}
}

function seriesSelectionActivate(value,data) {
	Series = value;
	if (value == 'single') {

		jQuery( "#art-data-spreadsheet" ).empty();
		jQuery( "#art-data-spreadsheet-container" ).show();

		var ssdata = (data) ? data : ArtDataSpreadsheetData.single_series ;
		SpreadSheetConfig.data = ssdata;
		SpreadSheet = new Handsontable(document.getElementById('art-data-spreadsheet'),SpreadSheetConfig);
		
		jQuery( "#art-data-dataset-preview" ).show();
		toggleBarChartPreviewTab();

	} else if (value == 'multiple') {

		jQuery( "#art-data-spreadsheet" ).empty();
		jQuery( "#art-data-spreadsheet-container" ).show();
		var ssdata = (!data) ? ArtDataSpreadsheetData.multiple_series : data ;
		SpreadSheetConfig.data = ssdata;
		SpreadSheet = new Handsontable(document.getElementById('art-data-spreadsheet'),SpreadSheetConfig);
		
		jQuery( "#art-data-dataset-preview" ).show();
		toggleBarChartPreviewTab();

	} else {
		jQuery( "#art-data-spreadsheet-container" ).hide();
		jQuery( "#art-data-dataset-preview" ).hide();
		jQuery( '#art-data-dataset-series-row' ).hide();
	}
}

function toggleTablePreview() {
	ArtDataChart.eraseAllCharts();	
	jQuery( "#art-data-dataset-preview" ).show();
	var html = renderTablePreview();
	jQuery( "#art-data-table-preview-container" ).show();
	jQuery( "#art-data-table-preview" ).html(html);
}

/**
* go from spreadsheet format to chart format
*
*/
function translateSpreadSheetDataToChartData() {
	var dataset = {};
	var categories = [];
	
	//console.log(ArtDataSpreadsheetData)
	if (Series == 'multiple') {

		//console.log(SpreadSheetConfig.data)

		//set the categories array, set dataset properties based upon categories
		for (var i=0;i<SpreadSheetConfig.data[0].length;i++) {
			if (SpreadSheetConfig.data[0][i].length > 0) {

				//console.log(ArtDataSpreadsheetData[0][i])

				categories.push(SpreadSheetConfig.data[0][i]);
				dataset[SpreadSheetConfig.data[0][i]] = [];
			}
		}

		//populate dataset name and value properties for each category property
		for (var i=0;i<SpreadSheetConfig.data.length;i++) {

			if (SpreadSheetConfig.data[i][0].length > 0) {
				for (var key in dataset) {
					if (dataset.hasOwnProperty(key)) {
						var index = SpreadSheetConfig.data[0].indexOf(key);

						var columnName = SpreadSheetConfig.data[i][0];
						var columnValue = SpreadSheetConfig.data[i][index];

						//let's test to see if this number is an integer
						var falsePositives = ['',' ',true,null]; //isNaN function thinks these are integers
						//test to see if this is a number
						if ( (falsePositives.indexOf(columnValue) == -1) && (!isNaN(columnValue)) ) { 
							//this is an integer
							columnValue = Number(columnValue); //make sure this is an int
						}

						dataset[key].push({name:columnName,value:columnValue});
					}
				}
			}
		}

	} else if (Series == 'single') {

		/*NOTE - this code only allows for one row of data after the headers*/
		/*(such is the definition of a single series chart)*/
		//console.log(SpreadSheetConfig.data)

		//set the categories array, set dataset properties based upon categories
		for (var i=0;i<SpreadSheetConfig.data.length;i++) { //looping each row of the spreadsheet

			if (i == 0) { //first row is always the headers
				categories.push('series');
				dataset.series = [];
				for (var c=0;c<SpreadSheetConfig.data[i].length;c++) { //loop each cell of the header data
					dataset.series.push({name:SpreadSheetConfig.data[i][c],value:0});
				}
			} else {
				for (var c=0;c<dataset.series.length;c++) {
					var columnValue = SpreadSheetConfig.data[1][c];
					//let's test to see if this number is an integer
					var falsePositives = ['',' ',true,null]; //isNaN function thinks these are integers
					//test to see if this is a number
					if ( (falsePositives.indexOf(columnValue) == -1) && (!isNaN(columnValue)) ) { 
						//this is an integer
						dataset.series[c].value = Number(columnValue); //make sure this is an int
					} else {
						dataset.series[c].value = columnValue;
					}
				}				
			}

		}
		
	} else {

	}

	var graphDefinition = {};
	graphDefinition.categories = categories;
	graphDefinition.dataset = dataset;

	return graphDefinition;
}

/**
* go from chart format to spreadsheet format
*
*/
function translateChartDataToSpreadsheetData() {
	var dataset = [];
	
	var data = JSON.parse(window.ArtDataDataset.content); //this is the graph definition formatted data
	//console.log(data)

	if (window.ArtDataDataset.series == 'multiple') {

		//create first row of first series
		var row = [''];
		for (var key in data.dataset) {
			if (data.dataset.hasOwnProperty(key)) {
				row.push(key);
			}
		}
		dataset.push(row);

		//console.log(dataset)

		//assemble second series
		if ( dataset[0][1] !=="" ) {
			for (var c=0;c<data.dataset[dataset[0][1]].length;c++) {
				dataset.push([data.dataset[dataset[0][1]][c].name]);
			}
		}
		

		for (var i=0;i<dataset[0].length;i++) {
			if ( dataset[0][i] !=="" ) {
				for (var c=0;c<data.dataset[dataset[0][i]].length;c++) {

					var index = dataset[0].indexOf(dataset[0][i]);

					for (var a=0;a<dataset.length;a++) {
						if (a > 0) {
							//if this is the array with the secondary series we're looking for
							if (dataset[a].indexOf(data.dataset[dataset[0][i]][c].name) !== -1) {
								dataset[a][index] = data.dataset[dataset[0][i]][c].value;
							}

						}
					}

					
				}
			}
		}

		//console.log(dataset)

	} else if (window.ArtDataDataset.series == 'single') {

		var row1 = [];
		var row2 = [];

		for (var i=0;i<data.dataset.series.length;i++) {
			row1.push(data.dataset.series[i].name);
			row2.push(data.dataset.series[i].value);
		} 

		dataset.push(row1);
		dataset.push(row2);
		
	} else {

	}

	return dataset;
}

function renderTablePreview() {
	var html = '';	
	html += '<table class="art-data-table">';	
	    html += '<thead>';

	    	html += '<tr>';

	    		//SpreadSheetConfig.data

		    	for (var i=0;i<SpreadSheetConfig.data[0].length;i++) {
		    		html += '<th>'+SpreadSheetConfig.data[0][i]+'</th>';
		    	}

	        html += '</tr>';
	    html += '</thead>';
	    html += '<tbody>';

	    	for (var i=0;i<SpreadSheetConfig.data.length;i++) {
	    		if (i > 0) {
	    			html += '<tr>';
	    			for (var c=0;c<SpreadSheetConfig.data[i].length;c++) {
	    				html += '<td>'+SpreadSheetConfig.data[i][c]+'</td>';
	    			}
	    			html += '</tr>';
	    		}
	    	}

	    html += '</tbody>';
	html += '</table>';

	return html;
}


/******************************************************************************************
* initiate creation of charts, define chart object
*
*/

var ArtDataChart = {
	
	config : {
			    meta : {
			    	position: '',
			        caption : '',
			        subcaption : '',
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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

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

	graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format

	//create the charts
	ArtDataChart.createDonutChart(graphDef,'#uv-div-donut');	
}

function validateDataset() {
	var data = jQuery("#createNewForm").serializeArray();
	//console.log(data)
	var visualizationDataSource = false;
	for (var i=0;i<data.length;i++) {
		//name must be entered
		if (data[i].name == 'art-data-dataset-name') {
			//console.log('name')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
			}
		}
		//type must be selected
		if (data[i].name == 'art-data-dataset-visualization-type') {
			//console.log('type')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
			}
		}		
		//series must be selected if using a chart
		if (data[i].name == 'art-data-dataset-series') {
			//console.log('series')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
				visualizationDataSource = data[i].value;
			}
		}
	}

	return data;
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

function initSave() {

	var data = validateDataset();
	if (VisualizationType == 'table') {
		jQuery( "#art-data-dataset-content" ).val( JSON.stringify(SpreadSheetConfig.data) );
	} else if (VisualizationType == 'chart') {
		graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format
	
		//console.log(graphDef)

		jQuery( "#art-data-dataset-content" ).val( JSON.stringify(graphDef) );
	} else {
		return false;
	}

	jQuery( "#art-data-dataset-after-processing-action" ).val(1);

	document.forms['createNewForm'].submit();
}

function initSaveClose() {
	var data = validateDataset();
	if (VisualizationType == 'table') {
		jQuery( "#art-data-dataset-content" ).val( JSON.stringify(SpreadSheetConfig.data) );
	} else if (VisualizationType == 'chart') {
		graphDef = translateSpreadSheetDataToChartData(); //translate spreadsheet data into chart data format
		jQuery( "#art-data-dataset-content" ).val( JSON.stringify(graphDef) );
	} else {
		return false;
	}

	jQuery( "#art-data-dataset-after-processing-action" ).val(2);

	document.forms['createNewForm'].submit();
}


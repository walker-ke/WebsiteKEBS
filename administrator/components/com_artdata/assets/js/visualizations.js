/**
 * @version     2.2.9
 * @package     com_artdata
 * @copyright   Copyright (C) 2016. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Mike Hill <info@artetics.com> - http://artetics.com
 */


var ArtDataTypes = {
						'StaticTable':{
											'name':'static table',
											'icon':'components/com_artdata/assets/images/art-data-table-small.png'
									  },
						'DynamicTable':{
											'name':'dynamic table',
											'icon':'components/com_artdata/assets/images/art-data-table-small.png'
									    },
						'Bar':{
									'name':'bar chart',
									'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
							   },
						'Line':{
									'name':'line chart',
									'icon':'components/com_artdata/assets/images/art-data-line-chart-small.png'
								},
						'Area':{
									'name':'area chart',
									'icon':'components/com_artdata/assets/images/art-data-area-chart-small.png'
								},
						'StackedBar':{
										'name':'stacked bar chart',
										'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
									 },
						'StackedArea':{
										'name':'stacked area chart',
										'icon':'components/com_artdata/assets/images/art-data-area-chart-small.png'
									  },
						'Pie':{
								'name':'pie chart',
								'icon':'components/com_artdata/assets/images/art-data-pie-chart-small.png'
							  },
						'PercentBar':{
										'name':'percent bar chart',
										'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
									 },
						'PercentArea':{
										'name':'percent area chart',
										'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
									  },
						'Donut':{
										'name':'donut chart',
										'icon':'components/com_artdata/assets/images/art-data-pie-chart-small.png'
								},
						'StepUpBar':{
										'name':'step up bar chart',
										'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
									},
						'PolarArea':{
										'name':'polar area chart',
										'icon':'components/com_artdata/assets/images/art-data-area-chart-small.png'
									},
						'Waterfall':{
										'name':'waterfall chart',
										'icon':'components/com_artdata/assets/images/art-data-bar-chart-small.png'
									}
				   };

var ArtDataSources = {
						'html':{
									'name':'HTML table',
									'img':''
								},
						'sql':{
									'name':'SQL query',
									'img':''
								},					 
						'csv':{
									'name':'CSV file',
									'img':''
								}
					 };
var ArtDataChartPalettes = {
							  'Default':['#7E6DA1', '#C2CF30', '#FF8900', '#FE2600', '#E3003F', '#8E1E5F', '#FE2AC2', '#CCF030', '#9900EC', '#3A1AA8', '#3932FE', '#3276FF', '#35B9F6', '#42BC6A', '#91E0CB'],
							  'Plain':['#B1EB68', '#B1B9B5', '#FFA16C', '#9B64E7', '#CEE113', '#2F9CFA', '#CA6877', '#EC3D8C', '#9CC66D', '#C73640', '#7D9532', '#B064DC' ],
							  'Android':['#33B5E5', '#AA66CC', '#99CC00', '#FFBB33', '#FF4444', '#0099CC', '#9933CC', '#669900', '#FF8800', '#CC0000'],
							  'Soft':['#9ED8D2', '#FFD478', '#F16D9A', '#A8D59D', '#FDC180', '#F05133', '#EDED8A', '#F6A0A5', '#9F218B' ],
							  'Simple':['#FF8181', '#FFB081', '#FFE081', '#EFFF81', '#BFFF81', '#90FF81', '#81FFA2', '#81FFD1', '#9681FF', '#C281FF', '#FF81DD' ],
							  'Egypt':['#3A3E04','#784818','#FCFCA8','#C03C0C','#F0A830','#A8783C','#FCFCFC','#FCE460','#540C00','#C0C084','#3C303C','#1EA34A','#606C54','#F06048' ],
							  'Olive':['#18240C','#3C6C18','#60A824','#90D824','#A8CC60','#789C60','#CCF030','#B4CCA8','#D8F078','#40190D','#E4F0CC' ],
							  'Candid':['#AF5E14','#81400C','#E5785D','#FEBFBF','#A66363','#C7B752','#EFF1A7','#83ADB7','#528F98','#BCEDF5','#446B3D','#8BD96F','#E4FFB9' ],
							  'Sulphide':['#594440','#0392A7','#FFC343','#E2492F','#007257','#B0BC4A','#2E5493','#7C2738','#FF538B','#A593A1','#EBBA86','#E2D9CA' ],
							  'Lint':['#A8A878','#F0D89C','#60909C','#242418','#E49C30','#54483C','#306090','#C06C00','#C0C0C0','#847854','#6C3C00','#9C3C3C','#183C60','#FCCC00','#840000','#FCFCFC']
							};

var ArtDataTablePalettes = {
									'table1':'components/com_artdata/assets/images/tables/table-1.jpg',
									'table2':'components/com_artdata/assets/images/tables/table-2.jpg',
									'table3':'components/com_artdata/assets/images/tables/table-3.jpg',
									'table4':'components/com_artdata/assets/images/tables/table-4.jpg',
									'table5':'components/com_artdata/assets/images/tables/table-5.jpg',
									'table6':'components/com_artdata/assets/images/tables/table-6.jpg'
							 };


var codeMirrorInstance = false;

var selectedType = '';
var selectedDataSource = '';
var editSelectedType = '';
var editSelectedDataSource = '';

var published = 1;
var showTitle = 1;
var downloadable = 0;
var editPublished = 1;
var editShowTitle = 1;
var editDownloadable = 0;

var editVisualization = 0;

//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms

/***** CREATE NEW ****/

function launchCreateNewModal() {
	UIkit.modal( "#art-data-create-new" ).show();
}

function typeSelectionActivate(value) {
	if (value !=="") {
		selectedType = value;
		var html = '';
		//html += '<div>'; // class="uk-margin-top"
			html += '<div class="uk-panel uk-panel-box uk-width-1-1" style="background-color:#fff;">';
				html += '<img class="uk-margin-right uk-margin-left uk-float-left" style="max-height:22px;position:relative;top:15px;" src="'+ArtDataTypes[value].icon+'">';
				html += '<span class="uk-margin-right uk-float-left"><h2>new '+ArtDataTypes[value].name+'</h2></span>';
				html += '<a href="javascript:void(0);" class="uk-close uk-float-right" onclick="deactivateTypeSelection()" style="position:relative;top:15px;"></a>';
			html += '</div>';
		//html += '</div>';

		jQuery( "#art-data-type" ).hide(); //hide select
		jQuery( "#art-data-type-label" ).hide(); //hide label
		//jQuery( "#art-data-type-activated" ).show('blind');
		jQuery( "#art-data-type-activated" ).empty().html(html);

		showDataSourceSelect();

		if (value == 'StaticTable' || value == 'DynamicTable') {
			jQuery( "#art-data-new-visualization-table-theme-container" ).show();
			jQuery( "#art-data-accordion-node-other" ).show();
			jQuery( "#art-data-other-options-chart" ).hide();
			jQuery( "#art-data-other-options-table" ).show();
			jQuery( "#art-data-new-visualization-chart-theme-container" ).hide();
		} else {
			jQuery( "#art-data-new-visualization-chart-theme-container" ).show();
			jQuery( "#art-data-accordion-node-other" ).show();
			jQuery( "#art-data-other-options-table" ).hide();
			jQuery( "#art-data-other-options-chart" ).show();
			jQuery( "#art-data-new-visualization-table-theme-container" ).hide();			
		}
	}
}

function deactivateTypeSelection() {
	selectedType = '';
	jQuery( "#art-data-type-activated" ).empty().html('<h2><i class="uk-icon-plus"></i> new</h2>');	

	jQuery( "#art-data-type" ).show();
	jQuery( "#art-data-type-label" ).show();

	//hideDataSourceSelect();
	//deactivateDataSourceSelection();
	jQuery( "#art-data-new-accordion" ).hide();
}

function showDataSourceSelect() {
	jQuery( "#art-data-new-accordion" ).show('blind');
	//UIkit.accordion(jQuery( "#art-data-new-accordion" ), { /* options */ });
	//jQuery( "#art-data-new-visualization-data-source-container" ).show('blind');
}

function hideDataSourceSelect() {
	jQuery( "#art-data-new-visualization-data-source-container" ).hide();
}

function dataSourceSelectionActivate(value) {
	if (value !=="") {
		selectedDataSource = value;
		if (value == 'csv') {
			jQuery( "#art-data-new-visualization-data-source-db-type-container" ).hide();
			jQuery( "#art-data-new-visualization-data-source-content" ).hide();
			jQuery( "#art-data-new-visualization-data-source-connection-details-container" ).hide();
			jQuery( "#art-data-new-visualization-data-source-csv-entry" ).show();
			jQuery( "#art-data-new-visualization-data-source-csv-delimiter-container" ).show();
		} else {
			jQuery( "#art-data-new-visualization-data-source-csv-delimiter-container" ).hide();
			jQuery( "#art-data-new-visualization-data-source-csv-entry" ).hide();
			jQuery( "#art-data-new-visualization-data-source-content" ).show();
			if (value == 'sql') {
				jQuery( "#art-data-new-visualization-data-source-db-type-container" ).show();
			} else {
				jQuery( "#art-data-new-visualization-data-source-db-type-container" ).hide();
				jQuery( "#art-data-new-visualization-data-source-connection-details-container" ).hide();
			}
		}	
		var name = "Source Content ("+ArtDataSources[value].name+")";
		jQuery( "#art-data-new-visualization-data-source-content-label" ).empty().html(name);			
	} else {
		jQuery( "#art-data-new-visualization-data-source-csv-delimiter-container" ).hide();
		jQuery( "#art-data-new-visualization-data-source-csv-entry" ).hide();		
		jQuery( "#art-data-new-visualization-data-source-db-type-container" ).hide();
		jQuery( "#art-data-new-visualization-data-source-connection-details-container" ).hide();
		jQuery( "#art-data-new-visualization-data-source-content-label" ).empty().html('Source Content');
	}
}

function dataSourceTypeSelectionActivate(value) {
	if (value !=="") {
		selectedDataSource = value;
		if (value == 'custom') {
			jQuery( "#art-data-new-visualization-dataset-source-container" ).hide();
			jQuery( "#art-data-new-visualization-custom-source-container" ).show();
		} else {
			jQuery( "#art-data-new-visualization-custom-source-container" ).hide();
			jQuery( "#art-data-new-visualization-dataset-source-container" ).show();
		}				
	} else {
		jQuery( "#art-data-new-visualization-custom-source-container" ).hide();
		jQuery( "#art-data-new-visualization-dataset-source-container" ).hide();
	}
}

function getChartTemplateItemData(templateId) {
	for (var i=0;i<window.ArtDataChartTemplates.length;i++) {
		if (window.ArtDataChartTemplates[i].id == templateId) {
			return window.ArtDataChartTemplates[i];
		}
	}

	return false;
}

function getTableTemplateItemData(templateId) {
	for (var i=0;i<window.ArtDataTableTemplates.length;i++) {
		if (window.ArtDataTableTemplates[i].id == templateId) {
			return window.ArtDataTableTemplates[i];
		}
	}

	return false;
}

function toggleChartPalletteSamples(templateId) {

	var chartTemplate = getChartTemplateItemData(templateId);
	if (chartTemplate) {
		var config = JSON.parse(chartTemplate.content);
		var html = '';
		for (var i=0;i<config.graph.custompalette.length;i++) {
			html += '<div class="art-data-square-palette-item" style="background-color:'+config.graph.custompalette[i]+';"></div>';
		}

		jQuery( "#art-data-new-visualization-palette-samples" ).empty().html(html);
	} else {
		jQuery( "#art-data-new-visualization-palette-samples" ).empty();
	}

}

function toggleTablePalletteSamples(templateId) {

	var tableTemplate = getTableTemplateItemData(templateId);
	if (tableTemplate) {

		jQuery( "#art-data-new-visualization-table-palette-samples" ).show();

		//first the modifier classes
		var modifiers = JSON.parse(tableTemplate.modifier_classes);
		var classes = ['art-data-table'];
		if (modifiers.condensed == 1) {
			classes.push('art-data-table-condensed');
		}
		if (modifiers.hover == 1) {
			classes.push('art-data-table-hover');
		}
		if (modifiers.striped == 1) {
			classes.push('art-data-table-striped');
		}
		jQuery( "#art-data-preview-table" ).removeAttr('class');
		jQuery( "#art-data-preview-table" ).attr('class',classes.join(' '))

		//let's modify the stylesheet for this template
		artDataTableCss = JSON.parse(tableTemplate.content);
		renderCssRuleChanges();

	} else {
		jQuery( "#art-data-new-visualization-table-palette-samples" ).hide();
	}

}

function removeCodeMirrorInstance() {
	if (codeMirrorInstance !==false) {
		codeMirrorInstance.toTextArea();
		//codeMirrorInstance = false;
	}
}

function deactivateDataSourceSelection() {
	removeCodeMirrorInstance();
	selectedDataSource = '';
	jQuery( "#art-data-data-source-activated" ).empty().hide();	
	jQuery( "#art-data-new-visualization-data-source" ).show(); //select
	jQuery( "#art-data-new-visualization-data-source-label" ).show(); //label

	//hide all data source entry containers
	for (var property in ArtDataSources) {
	    if (ArtDataSources.hasOwnProperty(property)) {
	       jQuery( "#art-data-new-visualization-data-source-"+property+"-entry-container" ).hide();
	    }
	}
}

function connectionDetailsActivate(value) {
	if (value !== 'mysql-joomla') {
		jQuery( "#art-data-new-visualization-data-source-connection-details-container" ).show();
	} else {
		jQuery( "#art-data-new-visualization-data-source-connection-details-container" ).hide();
	}
}

function closeNewVisualizationModal() {
	UIkit.modal("#art-data-create-new").hide();
}

function saveNewVisualization() {
	var data = validateVisualization();
	if (data) {
		//add the togle button values
		data.push({name:'art-data-new-visualization-published',value:published});
		data.push({name:'art-data-new-visualization-show-title',value:showTitle});

		jQuery( "#art-data-new-visualization-published-value" ).val(published);
		jQuery( "#art-data-new-visualization-show-title-value" ).val(showTitle);

		//console.log('all good set the structure and submit form')
		jQuery( "#art-data-new-visualization-structure" ).val( JSON.stringify(data) );
		jQuery( "#art-data-new-visualization-html-content" ).val( jQuery( "#art-data-new-visualization-data-source-content" ).val() );
		
		jQuery( "#art-data-new-visualization-config-meta-isDownloadable" ).val(downloadable);

		//console.log(data)

		document.forms['createNewForm'].submit();
	} else {
		return false;
	}
}

function validateVisualization() {
	var data = jQuery("#createNewForm").serializeArray();
	//console.log(data)
	var visualizationDataSource = false;
	var visualizationDataSourceType = false;
	for (var i=0;i<data.length;i++) {
		//type must be selected
		if (data[i].name == 'art-data-type') {
			//console.log('type')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
			}
		}
		//name must be entered
		if (data[i].name == 'art-data-new-visualization-name') {
			//console.log('name')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				validationAccordionNode('basics');
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
			}
		}

		//data source type must be selected
		if (data[i].name == 'art-data-new-visualization-data-source-type') {
			//console.log('datasource type')
			if (data[i].value == "") {
				highlightValidatedFields("#"+data[i].name);
				validationAccordionNode('data');
				return false;
			} else {
				removeHighlightValidatedFields("#"+data[i].name);
				visualizationDataSourceType = data[i].value;
			}
		}

		if (visualizationDataSourceType == 'custom') {

			//data source must be selected
			if (data[i].name == 'art-data-new-visualization-data-source') {
				//console.log('datasource')
				if (data[i].value == "") {
					highlightValidatedFields("#"+data[i].name);
					validationAccordionNode('data');
					return false;
				} else {
					removeHighlightValidatedFields("#"+data[i].name);
					visualizationDataSource = data[i].value;
				}
			}

			//custom data source content cmust be entered
			if ((visualizationDataSource == "csv") && data[i].name == "art-data-new-visualization-data-source-csv-entry") {
				//console.log('csv datasource content')
				if (data[i].value == "") {
					highlightValidatedFields("#"+data[i].name);
					validationAccordionNode('data');
					return false;
				} else {
					removeHighlightValidatedFields("#"+data[i].name);
				}
			}
			//custom data source content must be entered
			if ((visualizationDataSource == "html" || visualizationDataSource == "sql") && (data[i].name == "art-data-new-visualization-data-source-content")) {
				//console.log('html or sql datasource content')
				if (data[i].value == "") {
					highlightValidatedFields("#"+data[i].name);
					validationAccordionNode('data');
					return false;
				} else {
					removeHighlightValidatedFields("#"+data[i].name);
				}
			}

		} else if (visualizationDataSourceType == 'dataset') {

			//data source dataset must be selected
			if (data[i].name == 'art-data-new-visualization-dataset-source') {
				//console.log('dataset')
				if (data[i].value == "") {
					highlightValidatedFields("#"+data[i].name);
					validationAccordionNode('data');
					return false;
				} else {
					removeHighlightValidatedFields("#"+data[i].name);
				}
			}

		}


	}

	return data;
}

function validationAccordionNode(node) {

	if (ArtAccordionOpen.indexOf(node) == -1) {
		toggleAccordionNode(node);
	}
	
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

function launchEditModal(id) {
	editVisualization = id;
	UIkit.modal( "#art-data-edit" ).show();

	populateEditForm(id);
}

function populateEditForm(id) {
	var visualization = getVisualizationItemData(id);

	//console.log(visualization)

	//visualization type
	jQuery( "#art-data-edit-type" ).val(visualization.type); //set the type
	typeEditSelectionActivate(visualization.type); //change UI based on type

	//visualization name
	jQuery( "#art-data-edit-visualization-name" ).val(visualization.name);

	//visualization published toggle, showtitle toggle
	toggleEditIcon(visualization.published,'published','art-data-edit-published');
	toggleEditIcon(visualization.show_title,'showTitle','art-data-edit-show-title');

	//visualization access group id
	jQuery( "#art-data-edit-visualization-access" ).val(visualization.access);

	//visualization description
	jQuery( "#art-data-edit-visualization-description" ).val(visualization.description);

	//visualization data source
	//set the source type
	dataEditSourceTypeSelectionActivate(visualization.data_source_type);
	jQuery( "#art-data-edit-visualization-data-source-type" ).val(visualization.data_source_type); //set the data source type

	//populate the appropriate dataset
	if (visualization.data_source_type == 'custom') { //if using a custom data source

		jQuery( "#art-data-edit-visualization-data-source" ).val(visualization.data_source); //set the data source
		dataEditSourceSelectionActivate(visualization.data_source); //change ui based on data source
		if (visualization.data_source == 'html') {
			jQuery( "#art-data-edit-visualization-data-source-content" ).val(visualization.data_source_content);
		} else if (visualization.data_source == 'sql') {
			jQuery( "#art-data-edit-visualization-data-source-content" ).val(visualization.data_source_content);
			jQuery( "#art-data-edit-visualization-data-source-db-type" ).val(visualization.data_source_db_type);
			if (visualization.data_source_db_type !=='mysql-joomla') {
				connectionEditDetailsActivate(visualization.data_source_db_type)
				//this is an external db, populate connection details
				jQuery( "#art-data-edit-visualization-data-source-connection-details-db-host" ).val(visualization.data_source_connection_details_db_host);
				jQuery( "#art-data-edit-visualization-data-source-connection-details-db-name" ).val(visualization.data_source_connection_details_db_name);
				//console.log('dbname: '+visualization.data_source_connection_details_db_name)
				jQuery( "#art-data-edit-visualization-data-source-connection-details-db-user" ).val(visualization.data_source_connection_details_db_user);
				jQuery( "#art-data-edit-visualization-data-source-connection-details-db-password" ).val(visualization.data_source_connection_details_db_password);
			}
		} else if (visualization.data_source == 'csv') {
			jQuery( "#art-data-edit-visualization-data-source-csv-entry" ).val(visualization.data_source_csv_entry);
			jQuery( "#art-data-edit-visualization-data-source-csv-delimiter" ).val(visualization.data_source_csv_delimiter);
		}

	} else if (visualization.data_source_type == 'dataset') { //if using a dataset data source

		jQuery( "#art-data-edit-visualization-dataset-source" ).val(visualization.dataset_source); //set the data source dataset id

	}

	//style / template / theme
	if (visualization.type == 'StaticTable' || visualization.type == 'DynamicTable') {
		jQuery( "#art-data-edit-visualization-table-template-id" ).val(visualization.template_id);
		toggleEditTablePalletteSamples(visualization.template_id);
	} else {
		jQuery( "#art-data-edit-visualization-template-id" ).val(visualization.template_id);
		toggleEditChartPalletteSamples(visualization.template_id);
	}

	//visualization other category (tables)
	if (visualization.type == 'StaticTable' || visualization.type == 'DynamicTable') {
		jQuery( "#art-data-edit-visualization-convert-links-images" ).val(visualization.convert_links_images);
		jQuery( "#art-data-edit-visualization-links-pattern" ).val(visualization.links_pattern);
		jQuery( "#art-data-edit-visualization-links-no-follow" ).val(visualization.links_no_follow);
		jQuery( "#art-data-edit-visualization-links-new-window" ).val(visualization.links_new_window);
		jQuery( "#art-data-edit-visualization-pagination-limit" ).val(visualization.pagination_limit);
		jQuery( "#art-data-edit-visualization-pagination-limit-options" ).val(visualization.pagination_limit_options);
	} else { 
		// (charts)
		jQuery( "#art-data-edit-visualization-config-graph-orientation" ).val(visualization.config_graph_orientation);
		jQuery( "#art-data-edit-visualization-config-meta-caption" ).val(visualization.config_meta_caption);
		jQuery( "#art-data-edit-visualization-config-meta-subcaption" ).val(visualization.config_meta_subcaption);
		jQuery( "#art-data-edit-visualization-config-meta-hlabel" ).val(visualization.config_meta_hlabel);
		jQuery( "#art-data-edit-visualization-config-meta-hsublabel" ).val(visualization.config_meta_hsublabel);
		jQuery( "#art-data-edit-visualization-config-meta-vlabel" ).val(visualization.config_meta_vlabel);
		jQuery( "#art-data-edit-visualization-config-meta-vsublabel" ).val(visualization.config_meta_vsublabel);

		jQuery( "#art-data-edit-visualization-config-meta-isDownloadable" ).val(visualization.config_meta_isDownloadable);
		toggleEditIcon(visualization.config_meta_isDownloadable,'downloadable','art-data-edit-downloadable');

		jQuery( "#art-data-edit-visualization-config-meta-downloadLabel" ).val(visualization.config_meta_downloadLabel);

	}

	

}	

function getVisualizationItemData(id) {
	for (var i=0;i<window.VisualizationItems.length;i++) {
		if (window.VisualizationItems[i].id == id) {
			return window.VisualizationItems[i];
		}
	}
}

function typeEditSelectionActivate(value) {
	if (value !=="") {
		editSelectedType = value;
		var html = '';
		//html += '<div>'; // class="uk-margin-top"
			html += '<div class="uk-panel uk-panel-box uk-width-1-1" style="background-color:#fff;">';
				html += '<img class="uk-margin-right uk-margin-left uk-float-left" style="max-height:22px;position:relative;top:15px;" src="'+ArtDataTypes[value].icon+'">';
				html += '<span class="uk-margin-right uk-float-left"><h2>edit '+ArtDataTypes[value].name+'</h2></span>';
				html += '<a href="javascript:void(0);" class="uk-close uk-float-right" onclick="deactivateEditTypeSelection()" style="position:relative;top:15px;"></a>';
			html += '</div>';
		//html += '</div>';

		jQuery( "#art-data-edit-type" ).hide(); //hide select
		jQuery( "#art-data-edit-type-label" ).hide(); //hide label
		//jQuery( "#art-data-edit-type-activated" ).show('blind');
		jQuery( "#art-data-edit-type-activated" ).empty().html(html);

		showEditDataSourceSelect();

		if (value == 'StaticTable' || value == 'DynamicTable') {
			jQuery( "#art-data-edit-visualization-table-theme-container" ).show();
			jQuery( "#art-data-edit-other-options-chart" ).hide();
			jQuery( "#art-data-edit-other-options-table" ).show();
			jQuery( "#art-data-edit-visualization-chart-theme-container" ).hide();
		} else {
			jQuery( "#art-data-edit-visualization-chart-theme-container" ).show();
			jQuery( "#art-data-edit-other-options-table" ).hide();
			jQuery( "#art-data-edit-other-options-chart" ).show();
			jQuery( "#art-data-edit-visualization-table-theme-container" ).hide();			
		}
	}
}

function deactivateEditTypeSelection() {
	editSelectedType = '';
	jQuery( "#art-data-edit-type-activated" ).empty().html('<h2><i class="uk-icon-plus"></i> new</h2>');	

	jQuery( "#art-data-edit-type" ).show();
	jQuery( "#art-data-edit-type-label" ).show();

	//hideDataSourceSelect();
	//deactivateDataSourceSelection();
	jQuery( "#art-data-edit-accordion" ).hide();
}

function showEditDataSourceSelect() {
	jQuery( "#art-data-edit-accordion" ).show('blind');
	//UIkit.accordion(jQuery( "#art-data-new-accordion" ), { /* options */ });
	//jQuery( "#art-data-edit-visualization-data-source-container" ).show('blind');
}

function hideEditDataSourceSelect() {
	jQuery( "#art-data-edit-visualization-data-source-container" ).hide();
}

function dataEditSourceSelectionActivate(value) {
	if (value !=="") {
		editSelectedDataSource = value;
		if (value == 'csv') {
			jQuery( "#art-data-edit-visualization-data-source-db-type-container" ).hide();
			jQuery( "#art-data-edit-visualization-data-source-content" ).hide();
			jQuery( "#art-data-edit-visualization-data-source-connection-details-container" ).hide();
			jQuery( "#art-data-edit-visualization-data-source-csv-entry" ).show();
			jQuery( "#art-data-edit-visualization-data-source-csv-delimiter-container" ).show();
		} else {
			jQuery( "#art-data-edit-visualization-data-source-csv-delimiter-container" ).hide();
			jQuery( "#art-data-edit-visualization-data-source-csv-entry" ).hide();
			jQuery( "#art-data-edit-visualization-data-source-content" ).show();
			if (value == 'sql') {
				jQuery( "#art-data-edit-visualization-data-source-db-type-container" ).show();
			} else {
				jQuery( "#art-data-edit-visualization-data-source-db-type-container" ).hide();
				jQuery( "#art-data-edit-visualization-data-source-connection-details-container" ).hide();
			}
		}	
		var name = "Source Content ("+ArtDataSources[value].name+")";
		jQuery( "#art-data-edit-visualization-data-source-content-label" ).empty().html(name);			
	} else {
		jQuery( "#art-data-edit-visualization-data-source-csv-delimiter-container" ).hide();
		jQuery( "#art-data-edit-visualization-data-source-csv-entry" ).hide();		
		jQuery( "#art-data-edit-visualization-data-source-db-type-container" ).hide();
		jQuery( "#art-data-edit-visualization-data-source-connection-details-container" ).hide();
		jQuery( "#art-data-edit-visualization-data-source-content-label" ).empty().html('Source Content');
	}
}

function dataEditSourceTypeSelectionActivate(value) {
	if (value !=="") {
		selectedDataSource = value;
		if (value == 'custom') {
			jQuery( "#art-data-edit-visualization-dataset-source-container" ).hide();
			jQuery( "#art-data-edit-visualization-custom-source-container" ).show();
		} else {
			jQuery( "#art-data-edit-visualization-custom-source-container" ).hide();
			jQuery( "#art-data-edit-visualization-dataset-source-container" ).show();
		}				
	} else {
		jQuery( "#art-data-edit-visualization-custom-source-container" ).hide();
		jQuery( "#art-data-edit-visualization-dataset-source-container" ).hide();
	}
}

function toggleEditChartPalletteSamples(templateId) {

	var chartTemplate = getChartTemplateItemData(templateId);
	if (chartTemplate) {
		var config = JSON.parse(chartTemplate.content);
		var html = '';
		for (var i=0;i<config.graph.custompalette.length;i++) {
			html += '<div class="art-data-square-palette-item" style="background-color:'+config.graph.custompalette[i]+';"></div>';
		}

		jQuery( "#art-data-edit-visualization-palette-samples" ).empty().html(html);
	} else {
		jQuery( "#art-data-edit-visualization-palette-samples" ).empty();
	}

}

function toggleEditTablePalletteSamples(templateId) {

	var tableTemplate = getTableTemplateItemData(templateId);
	if (tableTemplate) {

		jQuery( "#art-data-edit-visualization-table-palette-samples" ).show();

		//first the modifier classes
		var modifiers = JSON.parse(tableTemplate.modifier_classes);
		var classes = ['art-data-table'];
		if (modifiers.condensed == 1) {
			classes.push('art-data-table-condensed');
		}
		if (modifiers.hover == 1) {
			classes.push('art-data-table-hover');
		}
		if (modifiers.striped == 1) {
			classes.push('art-data-table-striped');
		}
		jQuery( "#art-data-edit-preview-table" ).removeAttr('class');
		jQuery( "#art-data-edit-preview-table" ).attr('class',classes.join(' '))

		//let's modify the stylesheet for this template
		artDataTableCss = JSON.parse(tableTemplate.content);
		renderCssRuleChanges();

	} else {
		jQuery( "#art-data-edit-visualization-table-palette-samples" ).hide();
	}

}

function deactivateEditDataSourceSelection() {
	editSelectedDataSource = '';
	jQuery( "#art-data-edit-data-source-activated" ).empty().hide();	
	jQuery( "#art-data-edit-visualization-data-source" ).show(); //select
	jQuery( "#art-data-edit-visualization-data-source-label" ).show(); //label

	//hide all data source entry containers
	for (var property in ArtDataSources) {
	    if (ArtDataSources.hasOwnProperty(property)) {
	       jQuery( "#art-data-edit-visualization-data-source-"+property+"-entry-container" ).hide();
	    }
	}
}

function connectionEditDetailsActivate(value) {
	if (value !== 'mysql-joomla') {
		jQuery( "#art-data-edit-visualization-data-source-connection-details-container" ).show();
	} else {
		jQuery( "#art-data-edit-visualization-data-source-connection-details-container" ).hide();
	}
}

function closeEditVisualizationModal() {
	UIkit.modal("#art-data-edit").hide();
}

function saveEditVisualization() {

	jQuery( "#art-data-edit-visualization-config-meta-isDownloadable" ).val(editDownloadable);
	jQuery( "#art-data-edit-visualization-published-value" ).val(editPublished);
	jQuery( "#art-data-edit-visualization-show-title-value" ).val(editShowTitle);

	var data = validateEditVisualization();
	if (data) {
		//add the togle button values
		//data.push({name:'art-data-edit-visualization-published',value:editPublished});
		//data.push({name:'art-data-edit-visualization-show-title',value:editShowTitle});
		//data.push({name:'art-data-edit-visualization-config-meta-isDownloadable',value:editDownloadable});

		


		//console.log('all good set the structure and submit form')
		jQuery( "#art-data-edit-visualization-structure" ).val( JSON.stringify(data) );
		jQuery( "#art-data-edit-visualization-html-content" ).val( jQuery( "#art-data-edit-visualization-data-source-content" ).val() );
		jQuery( "#art-data-edit-item-id" ).val(editVisualization);

		//jQuery( "#art-data-edit-visualization-config-meta-isDownloadable" ).val(editDownloadable);

		//console.log(data)

		document.forms['editForm'].submit();
	} else {
		return false;
	}
}



function validateEditVisualization() {
	var data = jQuery("#editForm").serializeArray();
	//console.log(data)
	var visualizationDataSource = false;
	var visualizationDataSourceType = false;
	var visualizationType = '';
	for (var i=0;i<data.length;i++) {
		//type must be selected
		if (data[i].name == 'art-data-edit-type') {
			//console.log('type')
			if (data[i].value == "") {

				visualizationType = data[i].value;

				highlightEditValidatedFields("#"+data[i].name);
				return false;
			} else {
				removeEditHighlightValidatedFields("#"+data[i].name);
			}
		}
		//name must be entered
		if (data[i].name == 'art-data-edit-visualization-name') {
			//console.log('name')
			if (data[i].value == "") {
				highlightEditValidatedFields("#"+data[i].name);
				validationEditAccordionNode('basics');
				return false;
			} else {
				removeEditHighlightValidatedFields("#"+data[i].name);
			}
		}

		//data source type must be selected
		if (data[i].name == 'art-data-edit-visualization-data-source-type') {
			//console.log('datasource type')
			if (data[i].value == "") {
				highlightEditValidatedFields("#"+data[i].name);
				validationEditAccordionNode('data');
				return false;
			} else {
				removeEditHighlightValidatedFields("#"+data[i].name);
				visualizationDataSourceType = data[i].value;
			}
		}

		if (visualizationDataSourceType == 'custom') {

			//data source must be selected
			if (data[i].name == 'art-data-edit-visualization-data-source') {
				//console.log('datasource')
				if (data[i].value == "") {
					highlightEditValidatedFields("#"+data[i].name);
					validationEditAccordionNode('data');
					return false;
				} else {
					removeEditHighlightValidatedFields("#"+data[i].name);
					visualizationDataSource = data[i].value;
				}
			}

			//custom data source content cmust be entered
			if ((visualizationDataSource == "csv") && data[i].name == "art-data-edit-visualization-data-source-csv-entry") {
				//console.log('csv datasource content')
				if (data[i].value == "") {
					highlightEditValidatedFields("#"+data[i].name);
					validationEditAccordionNode('data');
					return false;
				} else {
					removeEditHighlightValidatedFields("#"+data[i].name);
				}
			}
			//custom data source content must be entered
			if ((visualizationDataSource == "html" || visualizationDataSource == "sql") && (data[i].name == "art-data-edit-visualization-data-source-content")) {
				//console.log('html or sql datasource content')
				if (data[i].value == "") {
					highlightEditValidatedFields("#"+data[i].name);
					validationEditAccordionNode('data');
					return false;
				} else {
					removeEditHighlightValidatedFields("#"+data[i].name);
				}
			}

		} else if (visualizationDataSourceType == 'dataset') {

			//data source dataset must be selected
			if (data[i].name == 'art-data-edit-visualization-dataset-source') {
				//console.log('dataset')
				if (data[i].value == "") {
					highlightEditValidatedFields("#"+data[i].name);
					validationEditAccordionNode('data');
					return false;
				} else {
					removeEditHighlightValidatedFields("#"+data[i].name);
				}
			}

		}


	}

	return data;
}

function highlightEditValidatedFields(selector) {
	var fieldClass = "uk-width-1-1 uk-form-large";
	jQuery(selector).removeAttr('class');
	jQuery(selector).attr('class',fieldClass+" uk-form-danger");
}

function removeEditHighlightValidatedFields(selector) {
	var fieldClass = "uk-width-1-1 uk-form-large";
	jQuery(selector).removeAttr('class');
	jQuery(selector).attr('class',fieldClass);	
}

function validationEditAccordionNode(node) {

	if (EditArtAccordionOpen.indexOf(node) == -1) {
		toggleEditAccordionNode(node);
	}
	
}

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
            url: "index.php?option=com_artdata&task="+task+"&format=raw", 
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
        			var html = renderVisualizationTable(result.items);
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

function renderVisualizationTable(items) {

	var html = '';
	for (var i=0;i<items.length;i++) {

		html += '<tr>';
			html += '<td>';
				html += '<a href="javascript:void(0);" onclick="launchEditModal('+items[i].id+')">';
					html += items[i].name; 
				html += '</a>';
			html += '</td>';
			html += '<td>';
				html += items[i].usergroup;
			html += '</td>';								
			html += '<td>';
				html += getVisualizationTypeIcon(items[i].type); 
				html += '&nbsp;';
				html += uppercaseWords(items[i].type); 
			html += '</td>';
			html += '<td>';

				if (items[i].data_source_type == 'custom') {
					if (items[i].data_source == 'html') { 
							html += 'Custom: HTML';
					} else if (items[i].data_source == 'sql') { 
							html += 'Custom: SQL';
					} else if (items[i].data_source == 'csv') { 
							html += 'Custom: CSV';
					} 
				} else {
					html += 'Dataset: <a href="index.php?option=com_artdata&amp;view=data&amp;layout=default_new&amp;id='+items[i].dataset_source_name+'">'+items[i].dataset_source_name+'</a>';
				}

			html += '</td>';
			html += '<td>';
				var templateUri = (items[i].type == 'DynamicTable' || items[i].type == 'StaticTable') ? 'index.php?option=com_artdata&view=templates&layout=default_edit_table&id='+items[i].template_id : 'index.php?option=com_artdata&view=templates&layout=default_edit_chart&id='+items[i].template_id ; 
				html += '<a href="'+templateUri+'">'+items[i].template_name+'</a>';
			html += '</td>';		
			html += '<td>';
				html += '<code style="padding:2px;">[artdata id="'+items[i].id+'"]</code>';
			html += '</td>';				

			html += '<td>';
				html += '<a target="_blank" href="'+window.JuriRoot+'index.php?option=com_artdata&amp;view=visualizations&amp;id='+items[i].id+'">Preview</a>';
			html += '</td>';	

			html += '<td class="uk-text-center" style="width:1%;">';
				if (items[i].published == 1) { 
					html += '<a href="javascript:void(0);" data-uk-tooltip title="Toggle publishing" onclick="togglePublishing(0,'+items[i].id+')"><i class="uk-icon-check-circle-o" style="color:rgba(101, 159, 19, 1) !important;"></i></a>';
				} else { 
					html += '<a href="javascript:void(0);" data-uk-tooltip title="Toggle publishing" onclick="togglePublishing(1,'+items[i].id+')"><i class="uk-icon-times-circle" style="color:rgba(216, 80, 48, 1) !important;"></i></a>';
				} 
			html += '</td>';	
			html += '<td class="uk-text-center" style="width:1%;">';	
				html += '<a href="javascript:void(0);" onclick="makeDuplicate('+items[i].id+')" data-uk-tooltip title="Make a copy"><i class="uk-icon-clone"></i></a>';	
			html += '</td>';									
			html += '<td class="uk-text-center" style="width:1%;">';	
				html += '<a href="javascript:void(0);" onclick="removeVisualization('+items[i].id+')" data-uk-tooltip title="Remove"><i class="uk-icon-close"></i></a>';	
			html += '</td>';																																											
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

function clearArtDataVisualizationEditModal() {

	//visualization type
	jQuery( "#art-data-edit-type" ).val(''); //set the type

	//visualization name
	jQuery( "#art-data-edit-visualization-name" ).val('');

	//visualization published toggle, showtitle toggle
	toggleEditIcon(1,'published','art-data-edit-published');
	toggleEditIcon(0,'showTitle','art-data-edit-show-title');

	//visualization access group id
	jQuery( "#art-data-edit-visualization-access" ).val(1);

	//visualization description
	jQuery( "#art-data-edit-visualization-description" ).val('');

	//visualization data source


	dataEditSourceTypeSelectionActivate('');
	jQuery( "#art-data-edit-visualization-data-source-type" ).val('');
	jQuery( "#art-data-edit-visualization-dataset-source" ).val('');

	jQuery( "#art-data-edit-visualization-data-source" ).val(''); //set the data source
	dataEditSourceSelectionActivate(''); //change ui based on data source

	jQuery( "#art-data-edit-visualization-data-source-content" ).val('');
	jQuery( "#art-data-edit-visualization-data-source-db-type" ).val('');

	jQuery( "#art-data-edit-visualization-data-source-connection-details-db-host" ).val('');
	jQuery( "#art-data-edit-visualization-data-source-connection-details-db-names" ).val('');
	jQuery( "#art-data-edit-visualization-data-source-connection-details-db-user" ).val('');
	jQuery( "#art-data-edit-visualization-data-source-connection-details-db-password" ).val('');
	
	jQuery( "#art-data-edit-visualization-data-source-csv-entry" ).val('');
	jQuery( "#art-data-edit-visualization-data-source-csv-delimiter" ).val(',');

	jQuery( "#art-data-edit-visualization-table-template-id" ).val('');

	jQuery( "#art-data-edit-visualization-template-id" ).val('');

	jQuery( "#art-data-edit-visualization-convert-links-images" ).val('');
	jQuery( "#art-data-edit-visualization-links-pattern" ).val('');
	jQuery( "#art-data-edit-visualization-links-no-follow" ).val('');
	jQuery( "#art-data-edit-visualization-links-new-window" ).val('');

	jQuery( "#art-data-edit-visualization-config-graph-orientation" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-caption" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-subcaption" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-hlabel" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-hsublabel" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-vlabel" ).val('');
	jQuery( "#art-data-edit-visualization-config-meta-vsublabel" ).val('');

	jQuery( "#art-data-edit-visualization-config-meta-isDownloadable" ).val(0);
	toggleEditIcon(0,'downloadable','art-data-edit-downloadable');

	jQuery( "#art-data-edit-visualization-config-meta-downloadLabel" ).val('Download');

}

//modal event handling to clear data from closed modals
jQuery(function($){

	//anytime the edit modal is closed we want to be sure we have cleared all input data from form
	//set form back to 'empty' state so we don't leave behind data in edit form
	$('#art-data-edit').on({

	    'hide.uk.modal': function(){
	    	clearArtDataVisualizationEditModal();
	    }

	});

});





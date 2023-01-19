(function($){
	if($.G2 == undefined){
		$.G2 = {};
	}
	$.G2.boot = {};
	
	$.G2.boot.autocompleter = function(Container){
		Container.find('[data-autocomplete]').each(function(i, dropfield){
			$(dropfield).closest('.ui.search.dropdown').dropdown({
				apiSettings : {
					url: $(dropfield).data('url') + '&' + $(dropfield).attr('name') + '={query}',
					cache : false,
					onResponse : function(Response){
						if(!Response.hasOwnProperty('results')){
							var results = [];
							results['success'] = true;
							results['results'] = [];
							
							var count = 0;
							$.each(Response, function(key, obj){
								results['results'][count] = {};
								results['results'][count]['value'] = key;
								results['results'][count]['name'] = obj;
								count = count + 1;
							});
							
							return results;
						}
					}
				},
				minCharacters: $(dropfield).data('mincharacters') ? $(dropfield).data('mincharacters') : 0,
				message : {noResults : $(dropfield).data('noresults') ? $(dropfield).data('noresults') : 'No results found'},
				//saveRemoteData:false
			});
		});
	};
	
	$.G2.boot.calendar = function(Container){
		//calendar
		Container.find('[data-calendar]').each(function(i, calfield){
			if($(calfield).data('calendarready') === true){
				return true;
			}
			$(calfield).data('calendarready', true);
			
			var dformat = $(calfield).data('dformat') ? $(calfield).data('dformat') : 'YYYY-MM-DD';
			var sformat = $(calfield).data('sformat') ? $(calfield).data('sformat') : 'YYYY-MM-DD';
			
			var mindate = null;
			if($(calfield).data('mindate')){
				//var parts = $(calfield).data('mindate').split('-');
				//var mindate = new Date(parts[0], parts[1]-1, parts[2]);
				var mindate = moment($(calfield).data('mindate'), sformat).toDate();
			}
			var maxdate = null;
			if($(calfield).data('maxdate')){
				//var parts = $(calfield).data('maxdate').split('-');
				//var maxdate = new Date(parts[0], parts[1]-1, parts[2]);
				var maxdate = moment($(calfield).data('maxdate'), sformat).toDate();
			}
			if(jQuery.fn.calendar != undefined){
				
				var $realDate = $('<input type="hidden" name="'+$(calfield).attr('name')+'">');
				if($('[type="hidden"][name="'+$(calfield).attr('name')+'"]').length == 0){
					$(calfield).closest('.field').after($realDate);
				}else{
					$realDate = $('[type="hidden"][name="'+$(calfield).attr('name')+'"]').first();
				}
				
				//var dformat = $(calfield).data('dformat') ? $(calfield).data('dformat') : 'YYYY-MM-DD';
				//var sformat = $(calfield).data('sformat') ? $(calfield).data('sformat') : 'YYYY-MM-DD';
				
				if($(calfield).val().length > 0){
					var calval = $(calfield).val();
					$realDate.val(calval);
					$(calfield).val(moment(calval, sformat).format(dformat));
				}
				
				var opendays = [1,2,3,4,5,6,7];//1 for monday
				if($(calfield).data('opendays')){
					opendays = $(calfield).data('opendays').toString().split(',').map(Number);
				}
				
				var openhours = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
				if($(calfield).data('openhours')){
					openhours = $(calfield).data('openhours').toString().split(',').map(Number);
				}
				
				$(calfield).closest('.field').calendar({
					startMode : $(calfield).data('startmode'),
					type : $(calfield).data('type'),
					minDate : mindate,
					maxDate : maxdate,
					startCalendar: $(calfield).data('startcalendar') ? $($(calfield).data('startcalendar')).closest('.field') : null,
					endCalendar: $(calfield).data('endcalendar') ? $($(calfield).data('endcalendar')).closest('.field') : null,
					firstDayOfWeek: $(calfield).data('firstday') ? $(calfield).data('firstday') : 0,
					ampm: ($(calfield).data('ampm') != undefined) ? $(calfield).data('ampm') : true,
					monthFirst: $(calfield).data('monthfirst') ? $(calfield).data('monthfirst') : true,
					disableMinute: $(calfield).data('disableminute') ? $(calfield).data('disableminute') : false,
					
					formatter:{
						datetime: function (date, settings) {
							if (!date) return '';
							return moment(date).format(dformat);
						},
						cell: function(cell, date, cellOptions){
							if(cellOptions.mode == 'day' && (opendays.indexOf(parseInt(moment(date).format('E'))) == -1)){
								$(cell).addClass('disabled');
							}
							
							if(cellOptions.mode == 'hour' && (openhours.indexOf(parseInt(moment(date).format('k'))) == -1)){
								$(cell).addClass('disabled');
							}
						}
					},
					parser:{
						date: function (text, settings) {
							if (!text) return '';
							return moment(text, dformat).toDate();
						}
					},
					onChange: function (date, text, mode){
						if(text){
							$realDate.val(moment(date).format(sformat));
						}else{
							$realDate.val('');
						}
						$(calfield).trigger('input.events');
					},
					popupOptions:{
						position: $(calfield).data('popuppos') ? $(calfield).data('popuppos') : 'top center'
					},
					className:{
						popup: $(calfield).data('size') ? 'ui popup ' + $(calfield).data('size') : 'ui popup'
					},
					inline: ($(calfield).data('inline') === 1 || $(calfield).data('inline') === 2) ? true : false, 

					text:{
						days: $(calfield).data('days') ? $(calfield).data('days').split(',') : ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
						months: $(calfield).data('months') ? $(calfield).data('months').split(',') : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						monthsShort: $(calfield).data('monthsshort') ? $(calfield).data('monthsshort').split(',') : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
						today: $(calfield).data('today') ? $(calfield).data('today').split(',') : 'Today',
						now: $(calfield).data('now') ? $(calfield).data('now').split(',') : 'Now',
						am: $(calfield).data('am') ? $(calfield).data('am').split(',') : 'AM',
						pm: $(calfield).data('pm') ? $(calfield).data('pm').split(',') : 'PM'
					}
				});
				
				if($(calfield).data('inline') === 2){
					$(calfield).css('display', 'none');
				}
			}
		});
	};
	
	$.G2.boot.ready = function(){
		
		$('body').on('contentChange.basics', '*', function(e, settings){
			e.stopPropagation();
			
			if($(this).prop('tagName') != 'DIV' && $(this).prop('tagName') != 'FORM'){
				//return false;
			}
			
			if(jQuery.fn.tab != undefined){
				$(this).find('.ui.menu.G2-tabs .item, .ui.steps.G2-tabs .step').tab();
			}
			if(jQuery.fn.dropdown != undefined){
				$(this).find('.ui.dropdown').dropdown({'forceSelection' : false, 'placeholder' : ''});
				
				//$.G2.boot.autocompleter($(this));
				$(this).find('select').each(function(i, dropfield){
					var dsettings = {};//{'forceSelection' : false, 'placeholder' : ''};
					
					if($(dropfield).is('[data-autocomplete]')){
						$.extend(dsettings, {
							apiSettings : {
								url: $(dropfield).data('url') + '&' + $(dropfield).attr('name') + '={query}',
								cache : false,
								onResponse : function(Response){
									if(!Response.hasOwnProperty('results')){
										var results = [];
										results['success'] = true;
										results['results'] = [];
										
										var count = 0;
										$.each(Response, function(key, obj){
											results['results'][count] = {};
											results['results'][count]['value'] = key;
											results['results'][count]['name'] = obj;
											count = count + 1;
										});
										
										return results;
									}
								}
							},
							minCharacters: $(dropfield).data('mincharacters') ? $(dropfield).data('mincharacters') : 0,
							message : {noResults : $(dropfield).data('noresults') ? $(dropfield).data('noresults') : 'No results found'},
							//saveRemoteData:false
						});
					}
					
					if($(dropfield).attr('data-allowadditions')){
						$.extend(dsettings, {allowAdditions:true});
					}
					
					if($(dropfield).attr('data-fulltextsearch')){
						$.extend(dsettings, {fullTextSearch: 'exact'});
					}
					
					$(dropfield).closest('.ui.dropdown').dropdown(dsettings);
				});
			}
			if(jQuery.fn.checkbox != undefined){
				$(this).find('.ui.checkbox').checkbox('refresh');
			}
			
			if(jQuery.fn.embed != undefined){
				$(this).find('.ui.embed').embed();
			}
			
			if(jQuery.fn.sticky != undefined){
				$(this).find('.ui.sticky').sticky();
			}
			
			if(jQuery.fn.rating != undefined){
				$(this).find('.ui.rating').each(function(r, rwidget){
					var id = $(rwidget).attr('data-id');
					$(rwidget).attr('data-rating', $(id).val());
					
					$(rwidget).rating({
						onRate:function(){
							$(id).val($(this).rating('get rating'));
						},
						interactive: ($(rwidget).attr('data-interactive') == 1) ? true : false,
						clearable: ($(rwidget).attr('data-clearable') == 1) ? true : false,
					});
				});
			}
			
			if(jQuery.fn.accordion != undefined){
				$(this).find('.ui.accordion').accordion();
				$(this).find('.ui.accordion').accordion('refresh');
			}
			
			if(jQuery.fn.tooltipster != undefined){
				$(this).find('[data-hint]').addBack().each(function(i, element){
					$(element).tooltipster({
						content: $(element).data('hint'),
						maxWidth: 300,
						delay: 50,
						debug: false,
						contentAsHTML: true
					});
				});
			}
			
			//G2 actions
			if($.G2.actions != undefined){
				$.G2.actions.ready();
			}
			
			if($.G2.actions2 != undefined){
				$.G2.actions2.ready($(this));
			}
			
			if($.G2.forms2 != undefined){
				$.G2.forms2.ready($(this));
			}
			
			$.G2.boot.calendar($(this));
			
			//wysiwyg editor
			if($.G2.tinymce != undefined){
				$.G2.tinymce.init();
			}
			//textareas expand
			$(this).on('keyup.resize', 'textarea[data-autoresize="1"]', function(e){
				$(this).css('overflow', 'hidden');
				if($(this).val().split("\n").length > $(this).attr('rows')){
					$(this).attr('rows', $(this).val().split("\n").length);
				}else{
					if($(this).data('rows') == undefined){
						$(this).data('rows', $(this).attr('rows'));
					}
					if($(this).data('rows') <= $(this).val().split("\n").length){
						$(this).attr('rows', $(this).val().split("\n").length);
					}
				}
			});
			$(this).find('textarea[data-autoresize="1"]').trigger('keyup.resize');
			
			//if(settings && settings.bodyChange){
			$('body').trigger('bodyChange');
			//}
		});
		
		//new forms
		//if($('form.ui.form.ce_form').length > 0){
		if($.G2.validation != undefined){
			$('body').on('contentChange.form', 'form', function(e){
				e.stopPropagation();
				$.G2.validation.ready($(this));
			});
			
			$('form.ui.form.ce_form').trigger('contentChange');
		}
		
		//toolbar
		$('.ui.toolbar-button').on('click', function(e){
			if($(this).attr('data-form')){
				var toolbar_form = $($(this).attr('data-form'));
			}else{
				var toolbar_form = $(this).closest('form');
			}
			
			if($(this).attr('data-url')){
				toolbar_form.attr('action', $(this).data('url'));
			}
			
			if($(this).attr('name') && $(this).attr('data-url')){
				//if the button has a url setting then use a hidden field
				toolbar_form.append($('<input />').attr('type', 'hidden').attr('name', $(this).attr('name')).val(1));
			}
			
			if($(this).data('selections') == '1' && toolbar_form.find('.ui.selector.checkbox.checked').length == 0){
				alert($(this).data('message'));
				return false;
			}
			
			if($(this).attr('data-fn')){
				var fn = $(this).attr('data-fn');
				window[$(this).attr('data-fn')]($(this));
			}else{
				toolbar_form.submit();
			}
		});
		
		//list selectors
		if(jQuery.fn.checkbox != undefined){
			$('.ui.selector.checkbox').checkbox({
				onChecked: function(){
					$(this).closest('tr').addClass('warning');
				},
				onUnchecked: function(){
					$(this).closest('tr').removeClass('warning');
				}
			});
			$('.ui.selector.checkbox').checkbox('attach events', '.ui.select_all.checkbox');
		}
		
		//errors
		$(':input[data-error]').closest('.field').addClass('error');
		
	};
	
}(jQuery));
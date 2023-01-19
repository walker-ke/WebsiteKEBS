<?php
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
?>
<?php
	ob_start();
?>
<style>
.active_droppable{border:2px solid black !important;}
.draggable{cursor:move;}
.draggable-receiver-title{cursor:pinter;}
.draggable-receiver.green{background-color:#eef8e8 !important;}
.draggable-receiver.blue{background-color:#d7edff !important;}
.draggable-receiver.orange{background-color:#fff1be !important;}
.draggable-receiver.purple{background-color:#f9e6ff !important;}
.draggable-receiver.red{background-color:#ffefea !important;}
.ui.segment.active.functions-tab{background-color:#f2f2f2;}
.ui.segment.active.views-tab{background-color:#f2f2f2;}

<?php if(\GApp::instance()->extension == 'chronoforms'): ?>
.advanced_conf{display:none !important;}
.ui.segment.compact .view_section{display:none !important;}
.ui.segment.compact .function_event{display:none !important;}
<?php endif; ?>

.mce-tinymce-inline.mce-floatpanel{display:none !important;}

.dragged_actions{float:right;}

.active_sortable{max-width:150px;}
.active_sortable .ui.fluid{display:none;}
</style>
<script>
	//jQuery('form').addClass('loading');
	jQuery(document).ready(function($) {
		$('body').on('dragndrop.make.draggable', '.draggable', function(e){
			$(this).draggable({
				'helper' : 'clone',
				//'revert' : 'invalid',
				connectToSortable: '.draggable-receiver',
				start: function(e, ui){
					$(ui.helper).css('z-index', 9999);
					$(ui.helper).css('min-width', '200px');
				}
			});
		});
		$('body').find('.draggable').trigger('dragndrop.make.draggable');
		
		$('body').on('dragndrop.make.droppable', '.draggable-receiver', initDroppable);
		$('body').find('.draggable-receiver').trigger('dragndrop.make.droppable');
		/*
		$('body').on('click', '.edit_name', function(){
			$('.advanced_conf').removeClass('advanced_conf');
		});
		*/
		$('body').on('input', '.dragged-name', function(){
			var ninput = this;
			$(this).val($(this).val().toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'_'));
			$(this).closest('.dragged').children('.dragged_name').first().html($(this).val());
			
			if($(ninput).closest('.dragged').children('.dragged-areas').children('.draggable-receiver').length > 0){
				$(ninput).closest('.dragged').children('.dragged-areas').children('.draggable-receiver').each(function(ak, area){
					$(area).attr('data-aname', $(ninput).val());
					$(area).attr('data-name', $(area).attr('data-aname') + '/' + $(area).attr('data-ename'));
					$(area).children('.dragged').each(function(adk, area_dragged){
						$(area_dragged).find('.dragged_parent').first().val($(area).attr('data-name'));
					});
				});
			}
		});
		
		$('body').on('bodyChange', function(){
			$('.advanced_conf').remove();
		});
		
		$('.draggable-receiver-title').each(function(rti, receiver_title){
			$(receiver_title).find('.dragged_count').html($(receiver_title).next('.draggable-receiver').children().length);
		});
		
		$('body').on('click', '.edit_dragged', function(){
			var element = $(this);
			element.closest('.dragged').find('.config_area').first().transition('slide down');
			
			if(element.closest('.dragged').find('.config_area').first().hasClass('visible') == false){
				element.addClass('circular inverted');
			}else{
				element.removeClass('circular inverted');
			}
		});
		
		$('body').on('click', '.label_dragged', function(){
			var element = $(this);
			element.closest('.dragged').find('.label_area').first().transition('slide down');
			
			if(element.closest('.dragged').find('.label_area').first().hasClass('visible') == false){
				element.addClass('circular inverted');
			}else{
				element.removeClass('circular inverted');
			}
		});
		
		$('body').on('click', '.close_config', function(){
			$(this).closest('.dragged').find('.edit_dragged').first().trigger('click');
		});
		
		$('body').on('click', '.delete_dragged', function(){
			var element = $(this);
			element.closest('.dragged').transition({
				'animation' : 'fly right', 
				'onComplete' : function(){
					element.closest('.dragged').remove();
				}
			});
		});
		
		$('body').on('click', '.copy_dragged', function(){
			var element = $(this);
			var blockType = element.data("block");
			element.closest('.dragged').addClass('loading');
			
			$.ajax({
				url: element.data('url') + "&block="+blockType+"&count=" + (parseInt($('#'+blockType+'s-count').val()) + 1),
				data: element.closest('.dragged').find(':input').serialize(),
				type: 'POST',
				//proccessData: false,
				success: function(result){
					var newFunc2 = $(result);
					
					element.closest('.dragged').after(newFunc2);
					element.closest('.dragged').removeClass('loading');
					
					$('#'+blockType+'s-count').val(parseInt($('#'+blockType+'s-count').val()) + 1 + element.closest('.dragged').find('.dragged').length);
					
					$(newFunc2).find('.draggable-receiver').trigger('dragndrop.make.droppable');
					newFunc2.trigger('contentChange.basics');
				}
			});
		});
		
		$('body').on('click', '.load_content', function(){
			var element = $(this);
			element.closest('.dragged').addClass('loading');
			
			$.ajax({
				url: element.data('url'),
				type: 'POST',
				success: function(result){
					var newFunc2 = $(result);
					
					element.closest('.dragged').removeClass('loading');
					
					element.replaceWith(newFunc2);
					newFunc2.trigger('contentChange.basics');
				}
			});
		});
		
		$('body').on('click', '.refresh_dragged', function(){
			var element = $(this);
			var blockType = element.data("block");
			element.closest('.dragged').addClass('loading');
			
			$.ajax({
				url: element.data('url') + "&block="+blockType+"&count=" + (parseInt($('#'+blockType+'s-count').val()) + 1),
				data: element.closest('.dragged').find(':input').serialize(),
				type: 'POST',
				//proccessData: false,
				success: function(result){
					var newFunc2 = $(result);
					
					element.closest('.dragged').after(newFunc2);
					element.closest('.dragged').removeClass('loading');
					
					//$('#'+blockType+'s-count').val(parseInt($('#'+blockType+'s-count').val()) + 1 + element.closest('.dragged').find('.dragged').length);
					$(newFunc2).find('.draggable-receiver').trigger('dragndrop.make.droppable');
					//newFunc2.trigger('contentChange.basics');
					element.closest('.dragged').remove();
					newFunc2.trigger('contentChange.basics');
					//$('body').trigger('contentChange.basics', [newFunc2]);
					//$('body').trigger('g2.dragndrop.drop.complete', [newFunc2]);
				}
			});
		});
		
		$('body').on('g2.actions.dynamic.complete', '.save_block', function(e, data, is_json, newContent){
			if(!data.error){
				var save_button = $(this);
				var text = save_button.text();
				save_button.text($(this).data("completeMessage"));
				save_button.addClass('green');
				save_button.removeClass('black');
				
				setTimeout(function(){
					save_button.text(text);
					save_button.addClass('black');
					save_button.removeClass('green');
				}, 1000);
			}
		});
		
		function initDroppable(e){
			e.stopPropagation();
			$(this).sortable({
				//items: item.children('div.dragged'), this is causing the sorted item to get into children lists
				//containment:'parent',
				//axis:'y',
				connectWith: '.draggable-receiver',
				scroll: false,
				//cursorAt: { left: 5, top: 0 },
				handle: '.sort_dragged',
				placeholder: 'ui segment inverted yellow',
				start: function( event, ui ) {
					//$(ui.item).addClass('active_sortable');
				},
				sort: function( event, ui ) {
					//$(ui.item).addClass('active_sortable');
				},
				receive: function( event, ui ) {
					if($(ui.helper).data('info')){
						$(ui.helper).css('width', '');
						$(ui.helper).find('.segment').addClass('fluid loading');
						drop($(ui.helper), $(this));
					}
					$(ui.item).find('.dragged_parent').first().val($(this).data('name'));
					//$(ui.item).find('.dragged_parent').first().val($(this).data('aname') + '/' + $(this).data('ename'));
					
				},
				update: function( event, ui ) {
				
				},
				stop: function( event, ui ) {
					$(ui.item).removeClass('active_sortable');
				},
				over: function( event, ui ) {
					$(this).addClass('active_droppable');
				},
				out: function( event, ui ) {
					$(this).removeClass('active_droppable');
				},
				tolerance: 'pointer'
			});
		}
		
		function drop(draggable, droppable){
			var blockType = draggable.data('type');
			var dropInfo = draggable.data('info');
			var type = dropInfo.name;
			//$('#'+blockType+'s-count').val(parseInt($('#'+blockType+'s-count').val()) + 1);
			
			//get the view config
			//droppable.addClass('loading');
			
			$.ajax({
				url: draggable.data('url'),
				data: {'block' : blockType+'s', 'name' : type, 'count' : $('#'+blockType+'s-count').val()},
				success: function(result){
					var newFunc = $(result);
					
					draggable.replaceWith(newFunc);
					$(newFunc).find('.draggable-receiver').trigger('dragndrop.make.droppable');
					//set the parent event value
					newFunc.each(function(nfk, newElem){
						$(newElem).find('.dragged_parent').first().val(droppable.data('name'));
					});
					//newFunc.find('.dragged_parent').first().val(droppable.data('aname') + '/' + droppable.data('ename'));
					//apply the auto name from label
					newFunc.find('.field_label').on('keyup change', function(){
						newFunc.find('.field_label_slug').each(function(iinp, inpauto){
							$(inpauto).val(newFunc.find('.field_label').first().val().toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'_'));
							if($(inpauto).data('brackets')){
								$(inpauto).val($(inpauto).val()+'[]');
							}
						});
					});
					newFunc.find('.field_label_slug').on('keyup', function(){
						$(this).removeClass('field_label_slug');
					});
					
					//newFunc.find('[data-event_switcher]').trigger('change');
					
					$('#'+blockType+'s-count').val(parseInt($('#'+blockType+'s-count').val()) + newFunc.closest('.dragged').length + newFunc.closest('.dragged').find('.dragged').length);
					//droppable.removeClass('loading');
					newFunc.trigger('contentChange.basics');
				}
			});
		}
		
		$('.structures-list').each(function(i, list){
			var list_id = $(list).data('name');
			var list_add_btn = $(list).find('.add-' + list_id);
			
			var list_name_field = $(list).find('.' + list_id + '-name');
			if(list_name_field.length){
				list_name_field.on('keyup mouseup', function(){
					if($(this).val()){
						list_add_btn.removeClass('disabled');
					}else{
						list_add_btn.addClass('disabled');
					}
				});
			}
			if($('.' + list_id + '-list').length > 0){
				$('.' + list_id + '-list').find('.item[data-tab]').first().addClass('active');
				
				$('.' + list_id + '-list').on('click', '.item[data-tab]', function(){
					$('.' + list_id + '-list').find('.item[data-tab]').removeClass('active');
					$(this).addClass('active');
				});
				
				$('.' + list_id + '-list').on('click', '.item > .header', function(){
					$(this).next('.menu').transition('fade');
				});
			}
			
			$('.' + list_id + '-data').children().not(':first').removeClass('active');
			
			list_add_btn.on('click', function(){
				list_add_btn = $(this);
				var list = $(this).closest('.structures-list');
				var list_id = $(list).data('name');
				var list_counter = $(list).find('.count-' + list_id);
				var list_name = '';
				var count = '';
				
				var list_name_field = $(list).find('.' + list_id + '-name');
				if(list_name_field.length){
					var list_name = list_name_field.val();
				}else{
					var list_name = list_add_btn.data('name');
				}
				
				var sendData = {'name' : list_name};
				
				if($(list).find('.count-' + list_id).length){
					var count = parseInt(list_counter.val()) + 1;
					list_counter.val(count);
					sendData['count'] = count;
				}
				
				list_name = list_name + count;
				
				if($('.' + list_id + '-list').length > 0){
					$('.' + list_id + '-list').find('.item').removeClass('active');
					
					$('.' + list_id + '-list').append(
						$('<a class="blue item active"></a>')
						.html('<i class="icon delete fitted red delete_block"></i>' + list_name)
						.attr('data-tab', list_id + '-' + list_name)
					);
				}
				
				$(list).closest('.segment').addClass('loading');
				
				$.ajax({
					url: list_add_btn.data('url'),
					data: sendData,
					success: function(result){
						result = $(result);
						
						$('.' + list_id + '-data').children().removeClass('active');
						$('.' + list_id + '-data').append(result);
						$('.' + list_id + '-data').children().last().addClass('active');
						result.attr('data-tab', list_id + '-' + list_name);
						
						$(list).removeClass('loading');
						
						if($(list).find('.' + list_id + '-name').length){
							list_name_field.val('');
							list_add_btn.addClass('disabled');
						}
						
						$(list).find('.draggable-receiver').trigger('dragndrop.make.droppable');
						
						$(list).trigger('contentChange.basics');
						//$('body').trigger('contentChange.basics', [$(list)]);
						//$('body').trigger('g2.lists.add.complete', [$(result)]);
					}
				});
			});
		});
		
		$('body').on('click', '.delete_block', function(){
			var block_id = $(this).parent().attr('data-tab');
			$('*[data-tab="'+block_id+'"]').remove();
		});
		
		$('body').on('click', '.delete_area', function(){
			var element = $(this);
			element.closest('.area').transition({
				'animation' : 'fly right', 
				'onComplete' : function(){
					element.closest('.area').remove();
				}
			});
		});
		
		$('.areas').sortable({
			items: '.area',
			scroll: false,
			handle: '.sort_area',
			placeholder: 'ui segment inverted yellow',
		});
		
		$('body').on('click', '.toggle_designer', function(){
			$('.scrollableBox').addClass('hidden');
			$('.scrollableBox[data-name="'+$(this).data('name')+'"]').removeClass('hidden');
			//$('.toggle_designer[data-name="'+$(this).data('name')+'"]').trigger('click');
			$('.toggle_designer[data-name="'+$(this).data('name')+'"]').each(function(i, item){
				$.tab('change tab', $(item).attr('data-tab'));
				$(item).parent('.menu').children('.item').removeClass('active');
				$(item).addClass('active');
			});
		});
		
		$('body').on('click', '.minimize_area', function(){
			if($('[data-minimized="'+$(this).data('named')+'"]').val() == "1"){
				$('[data-minimized="'+$(this).data('named')+'"]').val(0);
			}else{
				$('[data-minimized="'+$(this).data('named')+'"]').val(1);
			}
		});
		
		$('body').on('click', '.minimize_area.minimize_page', function(){
			$(this).closest('.main-area').find('[data-tab^="pages"]').not('.item.right').not('.item.title').toggleClass('hidden');
			$(this).toggleClass('minimize maximize');
		});
		
		$('body').on('click', '.minimize_area.draggable-receiver-title', function(){
			var element = $(this);
			element.toggleClass('pointing below');
			element.next('.draggable-receiver').transition({
				'animation' : 'slide up', 
				'onComplete' : function(){
					//element.toggleClass('top attached');
					element.find('.icon').toggleClass('down');
					element.find('.icon').toggleClass('right');
				}
			});
		});
		
		$('[data-class="preview-tab"]').each(function(i, section_tab){
			$(section_tab).on('click', function(){
				var section = $(section_tab).data('name');
				
				$('#'+section+'-preview').addClass('loading');
				
				var chunks = $('[data-tab="pages-'+section+'-views"], [data-tab="sections-'+section+'-general"]').find(':input');//.serializeArray();
				var data2 = $.G2.split(chunks, 900);
				
				$.ajax({
					url: "<?php echo r2('index.php?ext='.\GApp::instance()->extension.'&cont=connections&act=preview_section&tvout=view'); ?>",
					data: {'_formchunks':data2},
					method: 'POST',
					success: function(result){
						var precontent = $('<div></div>').append(result);
						
						precontent.find('button[type="submit"]').each(function(b, but){
							$(but).attr('type', 'button');
						});
						$('#'+section+'-preview').html(precontent);
						$('#'+section+'-preview').removeClass('loading');
						
						precontent.parent().trigger('contentChange.basics');
					}
				});
			});
		});
		
		//manage scrolling position
		jQuery(window).scroll(function(){
			$.each($('.scrollableBox'), function(i, dragList){
				if($(dragList).closest('.ui.segment.tab').hasClass('active')){
					if(jQuery(window).scrollTop() > $(dragList).closest('.ui.segment.tab').offset().top){
						$(dragList).stop().animate({'marginTop': (jQuery(window).scrollTop() - $(dragList).closest('.ui.segment.tab').offset().top + 100) + 'px'}, 'slow');
					}else{
						$(dragList).stop().animate({'marginTop': (0) + 'px'}, 'slow');
					}
				}
			});
		});
		
		//fields events support
		$('body').on('click', '.add_field_event', function(){
			var new_event = $(this).closest('.field_event').clone();
			new_event.find('.delete_field_event').removeClass('hidden');
			var events_count = 1 + parseInt($(this).closest('.fields_events_list').find('.fields_events_counter').first().val());
			$(this).closest('.fields_events_list').find('.fields_events_counter').first().val(events_count);
			
			new_event.html(new_event.html().replace(/\[events\]\[[0-9]+\]/g, '[events][' + events_count + ']'));
			
			$(this).closest('.fields_events_list').append(new_event);
			//new_event.find('.ui.dropdown').dropdown('setup menu');
			new_event.find('.ui.dropdown').dropdown('clear');
			new_event.find('.ui.dropdown').dropdown('refresh');
		});
		
		$('body').on('click', '.delete_field_event', function(){
			$(this).closest('.field_event').remove();
		});
		/*
		$('body').on('click', '.add_clone', function(){
			var new_item = $(this).closest('.clonable').clone();
			new_item.find('.delete_clone[data-group="'+$(this).data('group')+'"]').removeClass('hidden');
			var name = $(this).closest('.clonable_container').find('.clonable_counter').data('name');
			var clones_count = 1 + parseInt($(this).closest('.clonable_container').find('.clonable_counter').first().val());
			$(this).closest('.clonable_container').find('.clonable_counter').first().val(clones_count);
			
			var re = new RegExp('\\['+name+'\\]\\[[0-9]+\\]', 'g');
			new_item.html(new_item.html().replace(re, '['+name+'][' + clones_count + ']'));
			new_item.html(new_item.html().replace(/-N-/g, clones_count));
			
			$(this).closest('.clonable_container').append(new_item);
			
			new_item.find('.ui.dropdown').dropdown('clear');
			new_item.find('.ui.dropdown').dropdown('refresh');
		});
		
		$('body').on('click', '.delete_clone', function(){
			$(this).closest('.clonable').remove();
		});
		*/
		
		$('body').on('bodyChange.add', function(){
			$('.clonable_container').sortable({
				items: '.clonable',
				scroll: false,
				handle: '.sort_clone',
				placeholder: 'ui segment inverted yellow',
			});
			
			$('.clonable[data-source="1"]').addClass('hidden').find(':input').prop('disabled', true);
		});
		
		$('body').trigger('bodyChange.add');
		/*
		$('.clonable[data-source="1"]').addClass('hidden').find(':input').prop('disabled', true);
		$('body').on('click', function(){
			$('.clonable[data-source="1"]').addClass('hidden').find(':input').prop('disabled', true);
		});
		*/
		$('body').on('click', '.add_clone', function(){
			if($(this).closest('.clonable[data-group="'+$(this).data('group')+'"]').length){
				$(this).closest('.clonable[data-group="'+$(this).data('group')+'"]').trigger('clone', [this]);
			}else if($(this).closest('.clonable_container[data-group="'+$(this).data('group')+'"]').length){
				$(this).closest('.clonable_container[data-group="'+$(this).data('group')+'"]').trigger('clone', [this]);
			}
		});
		
		$('body').on('clone', '.clonable_container, .clonable', function(e, button){
			e.stopPropagation();
			//var button = $(this);
			var group = $(this).data('group');
			
			if($(this).is('.clonable')){
				var clonable = $(this);
				var container = $(this).closest('.clonable_container[data-group="'+group+'"]');
			}else{
				var container = $(this);//$(button).closest('.clonable_container[data-group="'+group+'"]');
				var clonable = container.find('.clonable[data-group="'+group+'"]').first();
				if($(button).data('grouptype')){
					var clonable = container.find('.clonable[data-group="'+group+'"][data-grouptype="'+$(button).data('grouptype')+'"]').first();
				}
			}
			/*
			if($(button).closest('.clonable[data-group="'+group+'"]').length > 0){
				var clonable = $(button).closest('.clonable[data-group="'+group+'"]');
			}
			*/
			//var container = $(clonable).closest('.clonable_container');
			
			var new_item = clonable.clone();
			if(new_item.attr('data-source') == 1){
				new_item.removeClass('hidden');
				new_item.removeAttr('data-source');
				new_item.find(':input').prop('disabled', false);
				new_item.find('.ui.dropdown').removeClass('disabled');
			}
			
			new_item.find('.delete_clone[data-group="'+group+'"]').removeClass('hidden');
			
			var clones_count = 1 + parseInt(container.attr('data-counter'));
			container.attr('data-counter', clones_count);
			
			new_item.attr('data-counter', clones_count);
			
			var re = new RegExp(group+'-N-', 'g');
			
			new_item.find('[data-origin]').each(function(i, item){
				var props = JSON.parse($(item).attr('data-origin'));
				$.each(props, function(propname, prop){
					var newprop = prop.replace(re, clones_count);
					//match parent clonables
					$.each(container.parents('.clonable[data-group]'), function(ci, pclonable){
						newprop = newprop.replace(new RegExp($(pclonable).data('group')+'-N-', 'g'), $(pclonable).attr('data-counter'));
					});
					//match child clonables
					$.each(new_item.find('.clonable[data-group]'), function(ci, pclonable){
						newprop = newprop.replace(new RegExp($(pclonable).data('group')+'-N-', 'g'), $(item).closest('.clonable[data-group="'+$(pclonable).data('group')+'"]').attr('data-counter'));
					});
					
					$(item).attr(propname, newprop);
				});
			});
			
			if($(this).is('.clonable')){
				$(this).after(new_item);
			}else{
				container.append(new_item);
			}
			
			new_item.trigger('contentChange');
		});
		
		$('body').on('click', '.delete_clone', function(){
			$(this).closest('.clonable').remove();
		});
		
		$('#apply').on('click', function(e){
			e.preventDefault();
			var button = $(this);
			button.closest('form').addClass('loading');
			
			var chunks = button.closest('form').find(':input');//.serializeArray();
			var data2 = $.G2.split(chunks, 900);
			
			$.ajax({
				url: button.data('url'),
				data: {'_formchunks':data2},
				method: 'POST',
				success: function(result){
					button.closest('form').removeClass('loading');
				}
			});
		});
	});
	
	//
	function saveform(btn){
		btn.closest('form').addClass('loading');
		if(jQuery.G2.tinymce != undefined){
			jQuery.G2.tinymce.remove('textarea[data-editor]');
		}
		
		var chunks_counter = 0;
		var chunks = btn.closest('form').find(':input[name^="Connection"]');//.serialize().match(/.{1,100}/g);
		var data2 = jQuery.G2.split(chunks, 900);
		
		chunks.prop('disabled', true);
		jQuery.each(data2, function(i, chunk){
			btn.closest('form').append(jQuery('<textarea></textarea>').css('display', 'none').attr('name', '_formchunks['+i+']').val(chunk));
		});
		/*
		var maxcount = 900;
		
		//jQuery.each(chunks, function(i, c){
		if(chunks.length > maxcount){
			for(i = 0; i <= chunks.length; i = i + maxcount){
				var $chunk_clone = jQuery('<textarea></textarea>').attr('class', '_chunk').attr('name', '_formchunks['+chunks_counter+']').val(chunks.slice(i, i + maxcount).serialize());
				btn.closest('form').append($chunk_clone.hide());
				chunks_counter++;
			}
			chunks.prop('disabled', true);
		}
		//});
		*/
		btn.closest('form').submit();
	}
	
</script>
<?php
	$jscode = ob_get_clean();
	\GApp::document()->addHeaderTag($jscode);
	\GApp::document()->_('jquery-ui');
	\GApp::document()->__('keepalive');
	\GApp::document()->_('semantic-ui', ['css' => ['accordion', 'transition']]);
	//\GApp::document()->_('tooltipster');
	\GApp::document()->_('tinymce');
	
	if($this->get('permissions_deactivated', false)){
		\GApp::document()->addCssCode('a[data-tab$="-permissions"]{display:none !important;}');
	}
	
	if(empty($this->data('Connection.params.permissions.app'))){
		\GApp::document()->addCssCode('a[data-tab^="view-"][data-tab$="-permissions"]{display:none !important;}');
		\GApp::document()->addCssCode('a[data-tab^="function-"][data-tab$="-permissions"]{display:none !important;}');
	}
?>
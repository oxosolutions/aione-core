<div id="oxo_loading_section" style="display:none;">
	<div class="loading_img"><p><?php _e('Saving...', 'oxo-core'); ?></p></div>
</div>
<div id="oxo-page-builder" class="oxo-page-builder-hide" instance="<?php echo get_the_ID();?>">
	<h2 class="section_heading oxo_toggler">
		<?php _e('Aione Page Builder', 'oxo-core'); ?> 
		<div class="oxo-toggler-wrapper"><i class="fa fa-sort-asc oxo-toggler"></i></div>
		<div class="section_heading_hidden"></div>
	</h2>
	<div class="oxo_insider">
		<div id="dialog_form"></div>
		
		<div id="ddbuilder">
			 
			<div class="width_flex" style="padding:0; width:100.2%; padding:0 0 20px 0; border-bottom:none; margin-top:-10px;" id="paletteContainer">
			
				<div style="border:none; width:100%; padding:0;" id="tabs">
								
						<div id="delete_section">
							<a id="del_icon" href="javascript:void(0)"><i class="oxoa-trash-o"></i></a>
								<div id="both_icon">
									<a class="b_left oxo_undo" href="javascript:void(0)"><i class="oxoa-reply"></i></a>
									<a class="b_right oxo_redo" href="javascript:void(0)"><i class="oxoa-forward"></i></a>
								</div>
						</div>
				</div>
			</div>
			<div id="editor" class="layout_builder drag-element" data-drop_level="0"></div>
		</div>
	  
		<!-- html template for the jquery tab title, each tab title will use this template.-->
		<script type="text/x-handlebars-template" id="tab-template">
			<li class="tabs_name"><a href='#{{id}}' class='{{id}}'><i class='{{class}}'></i>{{name}}</a></li>
		</script>
				
		<!-- html template for the jquery tab content, each tab content will use this template.-->
		<script type="text/x-handlebars-template" id="tabContent-template">
			<div id='{{id}}' href='javascript:void(0);' class='drag-container'></div>
		</script>
	
		<!-- each element in the palette will use this template.-->
		<script type="text/x-handlebars-template" id="element-template">
			<a href='javascript:void(0);' class='element_block item-container' id='{{id}}'>
				<i class='{{icon_class}}'></i>
				<span>{{name}}</span>
			</a>
		</script>
		
		<!-- each element in the editor will use this template.-->
		<script type="text/x-handlebars-template" id="content-child-div-template">
		{{#if popup_editor}} 
			<div class="handler pop-up-element menu-item-handle">
		{{else}}
		<div class="handler layout-element menu-item-handle">
		{{/if}}
				{{#if layout_opt}} 
				<a class="decrease-width change-width" href="javascript:void(0);" id='decrease-width-{{id}}' title="<?php _ex('Decrease width', 'in template', 'oxo-core'); ?>"><i class="oxoa-minus"></i></a>
				<a class="increase-width change-width" href="javascript:void(0);" id='increase-width-{{id}}' 
				title="<?php _ex('Increase width', 'in template', 'oxo-core'); ?>"><i class="oxoa-plus2"></i></a> 
				<span class="grid_width">{{name}}</span>
				{{else}}
				
				{{/if}}
				<div id="simple_option" class="oxo-columns-options {{#if popup_editor}}oxo-builder-element {{/if}}" > 
				{{#if popup_editor}} 
				 <a id='edit-element-{{id}}' class="edit-element " href="javascript:void(0);" title="<?php _ex('Edit Element', 'in template', 'oxo-core'); ?>"><?php _ex('<i class="oxoa-pen"></i>', 'Edit Element in template', 'oxo-core'); ?></a>
				 {{/if}}
				<a id='clone-element-{{id}}' class="clone-element" href="javascript:void(0);" title="<?php _ex('Clone Element', 'in template', 'oxo-core'); ?>"><?php _ex('<i class="oxoa-file-add"></i>', 'Clone Element in template', 'oxo-core'); ?></a>
				<a id='delete-element-{{id}}' class="delete-element" href="javascript:void(0);" title="<?php _ex('Delete Element', 'in template', 'oxo-core'); ?>"><i class="oxoa-trash-o"></i></a>
				</div>
			</div>
			
			{{#if popup_editor}}
				<div class="innerElement editable-element" id="editable-element-{{id}}"></div>
			{{else}}
				<div class="innerElement childrenPlaceholder droppable-area"></div>
			{{/if}}
		</script>
	 </div>
	 <?php
	 if( ! get_post_meta( get_the_ID(), 'oxo_builder_status', true ) ) {
		$builder_status = 'inactive';
	 } else {
		$builder_status = get_post_meta( get_the_ID(), 'oxo_builder_status', true );
	 }
	 ?>
	 <input type="hidden" name="oxo_builder_status" value="<?php echo $builder_status; ?>"/>
</div>

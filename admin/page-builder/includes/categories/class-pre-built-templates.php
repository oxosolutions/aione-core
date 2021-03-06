<?php
/**
 * Pre Built Templates implementation
 */
class PreBuiltTemplates {
	private $value = array();
	private $elements = array();
	
	public function __construct() {
		
		$this->value['id'] 		= "Pre_built_templates_div";
		$this->value['name'] 	= __('Templates', 'oxo-core');
		$this->value['icon'] 	= "icon_pack/tab_icon_2.png";
		$this->value['class']	= "oxo-tab oxoa-copy";
		
		$this->load_elements();
	}
	
	public function to_array() {
		
		$this->value['elements'] = $this->elements;
		return $this->value;
	}
	
	/**
	 * Load all the category's elements
	 */
	private function load_elements() {
	   
	}  
}
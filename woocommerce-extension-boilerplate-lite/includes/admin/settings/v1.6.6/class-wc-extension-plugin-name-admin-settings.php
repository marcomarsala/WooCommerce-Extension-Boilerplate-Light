<?php
/**
 * WooCommerce Extension Boilerplate Lite First Tab Settings
 *
 * @author 		Your Name / Your Company Name
 * @category 	Admin
 * @package 	WooCommerce Extension Boilerplate/Admin
 * @version 	1.0.2
 */

if(!defined('ABSPATH')) exit; // Exit if accessed directly

if(!class_exists('WC_Extend_Plugin_Name_Admin_Settings')) {

/**
 * WC_Extend_Plugin_Name_Admin_Settings
 */
class WC_Extend_Plugin_Name_Admin_Settings {

	/**
	 * Constructor.
	 */
	public function __construct(){
		$this->id 		= WC_EXTEND_PLUGIN_NAME_PAGE;
		$this->label 	= apply_filters( 'wc_extend_plugin_name_settings_tab_label', __( 'Your Settings', 'wc-extend-plugin-name' ) );

		add_filter('woocommerce_settings_tabs_array', array( &$this, 'add_settings_tab' ) );
		add_action('woocommerce_settings_tabs_' . $this->id, array( &$this, 'output' ) );
		add_action('woocommerce_update_options_' . $this->id, array( &$this, 'save' ) );
	}

	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings(){

		return apply_filters( 'wc_extend_' . $this->id . '_settings', array(

			array(
				'name' 		=> __( 'Settings Title', 'wc-extend-plugin-name' ), 
				'type' 		=> 'title', 
				'desc' 		=> __( 'The settings title is also used to put your settings into sections making it easy for the admin to identify the area they want to alter. You can even place a description here like this one.', 'wc-extend-plugin-name' ), 
				'id' 		=> $this->id . '_options'
			),

			array(
				'name' 		=> __( 'Select Country', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'This gives you a list of countries. Only one can be selected.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_country_list',
				'css' 		=> 'min-width:350px;',
				'std'		=> 'GB',
				'type' 		=> 'single_select_country',
				'desc_tip'	=> true,
			),

			array(
				'name' 		=> __( 'Multi Select Countries', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'This allows you to select more than one country.' ,'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_multi_countries',
				'css' 		=> 'min-width: 350px;',
				'std'		=> '',
				'type' 		=> 'multi_select_countries',
				'desc_tip'	=> true,
			),

			array(
				'name' 		=> __( 'Single Page', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'You can select a page to be used for either a single shortcode or to be redirected to when called.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_single_page_id',
				'type' 		=> 'single_select_page',
				'std'		=> '',
				'class'		=> 'chosen_select_nostd',
				'css' 		=> 'min-width:300px;',
				'desc_tip'	=> true,
			),

			array(
				'name' 		=> __( 'Single Select', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'If you not using the other select field types you can just use a standard select.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_select',
				'std'		=> 'no',
				'type' 		=> 'select',
				'class'		=> 'chosen_select',
				'desc_tip'	=> true,
				'options' 	=> array(
					'no'  	=> __( 'No', 'wc-extend-plugin-name' ),
					'yes' 	=> __( 'Yes', 'wc-extend-plugin-name' )
				)
			),

			array(
				'name' 		=> __( 'Single Checkbox', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'Can come in handy to display more options.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_checkbox',
				'std'		=> 'no',
				'type' 		=> 'checkbox'
			),

			array(
				'name' 		=> __( 'Single Input (Text) ', 'wc-extend-plugin-name' ),
				'desc' 		=> '',
				'id' 		=> 'plugin_name_input_text',
				'std'		=> __( 'This admin setting and other imput types can be hidden via a checkbox using some javascript.', 'wc-extend-plugin-name' ),
				'type' 		=> 'text',
				'css' 		=> 'min-width:300px;',
				'autoload' 	=> false
			),

			array(
				'name' 		=> __( 'Single Textarea ', 'wc-extend-plugin-name' ),
				'desc' 		=> '',
				'id' 		=> 'plugin_name_input_textarea',
				'std'		=> __( 'You can allow the user to use this field to enter their own CSS or HTML code.', 'wc-extend-plugin-name' ),
				'type' 		=> 'textarea',
				'css' 		=> 'min-width:300px;',
				'autoload' 	=> false
			),

			array(
				'name' 		=> __( 'Checkbox Group', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'Checkbox one', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_checkgroup_option_one',
				'std'		=> 'yes',
				'desc_tip'	=> __( 'You can group your checkbox options together also if you like.', 'wc-extend-plugin-name' ),
				'type' 		=> 'checkbox',
				'checkboxgroup'		=> 'start'
			),

			array(
				'desc' 		=> __( 'Checkbox two', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_checkgroup_option_two',
				'std'		=> 'no',
				'type' 		=> 'checkbox',
				'checkboxgroup'		=> '',
				'desc_tip'	=> __( 'Checkbox two', 'wc-extend-plugin-name' ),
				'autoload' 	=> false
			),

			array(
				'desc' 		=> __( 'Checkbox three', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_checkgroup_option_three',
				'std'		=> 'yes',
				'type' 		=> 'checkbox',
				'checkboxgroup'		=> 'end',
				'desc_tip'	=> __( 'End checkbox.', 'wc-extend-plugin-name' ),
				'autoload' 	=> false
			),

			array(
				'name' 		=> __( 'Radio', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'Radio, Radio! Which one do I choose?', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_radio_options',
				'std'		=> 'happy',
				'type' 		=> 'radio',
				'options' 	=> array(
					'happy' => __( 'Happy', 'wc-extend-plugin-name' ),
					'sad'	=> __( 'Sad', 'wc-extend-plugin-name' ),
				),
				'desc_tip'	=>  true,
				'autoload' 	=> false
			),

			array(
				'name' 		=> __( 'Colour', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'You can set a colour. std <code>#ffffff</code>.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_color',
				'type' 		=> 'color',
				'css' 		=> 'width:6em;',
				'std'		=> '#ffffff',
				'autoload'  => false
			),

			array(
				'name' 		=> __( 'Images', 'wc-extend-plugin-name' ),
				'desc' 		=> __( 'If you need to add your own image sizes then use this field.', 'wc-extend-plugin-name' ),
				'id' 		=> 'plugin_name_images',
				'css' 		=> '',
				'type' 		=> 'image_width',
				'std'		=> '150',
				'crop'		=> false,
				'desc_tip'	=>  true,
			),

			array( 'type' => 'sectionend', 'id' => $this->id . '_options'),

		)); // End of your settings

	}

	/**
	 * Add a tab to the settings page of WooCommerce for Product Reviews Plus.
	 *
	 * @access public
	 * @return void
	 */
	public function add_settings_tab( $tabs ){
		$tabs[$this->id] = $this->label;

		return $tabs;
	}

	/**
	 * Output the settings
	 */
	public function output(){
		$settings = $this->get_settings();

		woocommerce_admin_fields($settings);
	}

	/**
	 * Save settings
	 */
	public function save(){
		global $woocommerce;

		include_once($woocommerce->plugin_path.'/admin/settings/settings-save.php');

		$settings = $this->get_settings();

		woocommerce_update_options($settings);
	}

}

} // end if class exists.

?>
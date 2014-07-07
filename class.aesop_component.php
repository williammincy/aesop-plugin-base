<?php
/**
 * Aesop Core
 *
 * @package   Aesop_Component_Base
 * @author    William Mincy <will@slipperysource.com>
 * @license   MIT
 * @link      http://slipperysource.com
 */

/**
* Base class used for creating Aesop Story Engine shortcode components
*/
class Aesop_Component_Base {
	public $version = "1.0";
	/*
	 * This value will be used for both the shortcode within WordPress and as the key when refrencing the 
	 * TinyMCE plugin. This value should be copied into the js/scripts.js file to replace the placeholder name
	 * to make sure that there are no naming collisions.
	 */
	public $shortcode = "base_shortcode";
	/**
	 * String name of the component, will be used in the UI as name/title of the component
	 */
	public $name = "wmdev";
	/**
	 * Holds any options set for the component
	 */
	public $options = array();
	/**
	 *
	 */
	public function __construct( $opts = null ) {
		if( $opts!==null ) {
			$this->options = $opts;
		}
	}
	/**
	 * Initializer function for the component
	 * 
	 * @return 
	 */
	public function init() {
		add_shortcode( $this->shortcode , array( $this, 'replace_shortcode') );
		add_filter('mce_external_plugins', array($this, 'register_mce_plugins') );
		add_filter('tiny_mce_before_init', array($this, 'tinymce_settings') );
		add_filter('aesop_avail_components', array($this, 'register_aesop_component') );
	}
	/**
	 * Registers the plugin and the required JavaScript file's URL within TinyMCE
	 *
	 * @param $plugin_array Array containing all of the registered plugins within TinyMCE
	 * @return Array containing all of the registered plugins within TinyMCE
	 */
	public function register_mce_plugins( $plugin_array ) {
		return $plugin_array;
	}

	/**
	 * Handles the replacement of the shortcode within the site's page/post output. 
	 * 
	 * @param $atts Array of attributes
	 * @param $content
	 * @return Formatted HTML used to replace the shortcode string
	 */
	public function replace_shortcode( $atts, $content = null ) {
		return "<h4 class=\"".$this->shortcode."\">Base Shortcode</h4>";
	}

	/**
	 * Used to modify or add to the TinyMCE component's settings. Only needs to be modified to 
	 * make those adjustments, otherwise there is no need to edit or override this function.
	 * 
	 * @param $settings Array of settings provided by TinyMCE
	 * @return Array containing TinyMCE settings
	 */
	public function tinymce_settings( $settings ) {
		return $settings;
	}
	/**
	 * 
	 * 
	 */
	public function register_aesop_component( $shortcodes ) {
		$shortcodes[strtolower($this->name)] = array(
				'name' 				=> __($this->name, 'aesop-core'),
				'type' 				=> 'single',
				'atts' 				=> array(
					'height' 			=> array(
						'type'		=> 'text',
						'values' 	=> array( ),
						'default' 	=> '',
						'desc' 		=> __( 'Height', 'aesop-core' )
					),
					'URL' 			=> array(
						'type'		=> 'text',
						'values' 	=> array( ),
						'default' 	=> '',
						'desc' 		=> __( 'URL', 'aesop-core' )
					)
				)
		);
		return $shortcodes;
	}
}
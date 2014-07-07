aesop-plugin-base
=================

Base plugin I use when making [Aesop Story Engine](http://aesopstoryengine.com/) plugins to help speed up development. So far this has saved me from having to do a fair amount of redundant work with creating custom content types so I figured that I would open it up for anyone to use. Simply extend from the class and overwrite the components you need. 

To serve as a practical example for doing this, here is the code that I used as the basis of an iframe content type for a recent project.

```php
require_once(__DIR__."/class.aesop_component.php");

class AesopIframeComponent extends Aesop_Component_Base {

	public function __construct( $opts = null ) {
		$this->shortcode = "aesop_iframe";
		$this->name = "iFrame";
	}
	public function replace_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
							"width"		=> "100%",
							"height"	=> "200",
							"URL"		=> "youtube.com"
								), $atts, $this->shortcode) );
		return "<iframe class='".$this->shortcode."' width='".$width."' height='".$height."' src='".$URL."'></iframe>";
	}
}
```
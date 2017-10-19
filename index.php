<?php
/*
Plugin Name: Advanced Settings By Shirshak Bajgain.
Description: Change boring login to custom login .
Author: Shirshak Bajgain
Version: 1.0
Text Domain: shirshak
License: 
Don't use it unless asked from written permssion from Shirshak Bajgain. Strict rules and regulations .All rights reserved.
*/
defined('ABSPATH') or die("Cannot access pages directly."); 

$plugin_url=WP_PLUGIN_URL."/SHIRSHAK_ADVANCED_LOGIN";

class Theme_Options{
	public $options;
	public function __construct(){
		$this->options=get_option("shirshak_theme_option");
		add_action("admin_menu",array($this,'add_menu_page'));
		add_action('admin_init',array($this,'register_settings_and_fields'));
	}
	public function add_menu_page(){
		add_options_page("Theme Options","Theme Options","manage_options",__File__,array($this,'display_options_page'));
	}
	public function display_options_page(){
		?>
			<h2><?php esc_attr_e( 'Change the Theme Without Coding', 'wp_admin_style' ); ?></h2>

			<div class="wrap">
			<?php screen_icon(); ?>
			<h1><?php esc_attr_e( 'Theme Settings', 'wp_admin_style' ); ?></h1>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<div class="handlediv" title="Click to toggle"><br></div>
								<h2 class="hndle"><span><?php esc_attr_e( 'General Settings', 'wp_admin_style' ); ?></span></h2>

								<div class="inside">
									<form action="options.php" method="post" enc_type="multipart/form-data">
										<?php settings_errors(); ?>
										<?php settings_fields('shirshak_theme_option');?>
										<?php do_settings_sections( __File__ );?>
										<br>
										<input class="button-primary" type="submit" name="submit" value="<?php esc_attr_e( 'Submit' ); ?>" />
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div id="postbox-container-1" class="postbox-container">
						<div class="meta-box-sortables">
							<div class="postbox">
								<div class="handlediv" title="Click to toggle"><br></div>
								<h2 class="hndle"><span><?php esc_attr_e(
											'Support Us.', 'wp_admin_style'
										); ?></span></h2>

								<div class="inside">
									<p><?php esc_attr_e( 'This Theme was made by Shirshak exclusively for letslearnnepal. Please don\'t copy or distribute its code. THank you for kind support. If you wanna support him than kindly message bloggervista@gmail.com', 'wp_admin_style' ); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div> 

		<?php
	}
	public function register_settings_and_fields(){
		register_setting("shirshak_theme_option","shirshak_theme_option");

		add_settings_section('shirshak_general_section',"General Settings",array($this,"shirshak_general_section_cb"),__File__);
		add_settings_field('google_analytics',"Google Analytics",array($this,'google_analytics_setting_input'),__File__,'shirshak_general_section');
		add_settings_field('google_search',"Google Search",array($this,'google_search_setting_input'),__File__,'shirshak_general_section');
		add_settings_field('favicon',"Favicon",array($this,'favicon_setting_input'),__File__,'shirshak_general_section');
		add_settings_field('statcounter',"StatCounter",array($this,'statcounter_input'),__File__,'shirshak_general_section');

		add_settings_section('shirshak_captcha_section',"ReCaptcha",array($this,"shirshak_captcha_section_cb"),__File__);
		add_settings_field('recaptcha_secret_key',"Recaptcha Private Key",array($this,'recaptcha_secret_key'),__File__,'shirshak_captcha_section');
		add_settings_field('recaptcha_site_key',"Recaptcha Public Key",array($this,'recaptcha_site_key'),__File__,'shirshak_captcha_section');

		add_settings_section('shirshak_notes_section',"Notes",array($this,"shirshak_notes_section_cb"),__File__);
		add_settings_field('notes_submission',"Enable Notes Submission",array($this,'notes_submission'),__File__,'shirshak_notes_section');
	}
	public function shirshak_general_section_cb(){
	}	
	public function shirshak_captcha_section_cb(){
	}
	public function shirshak_notes_section_cb(){
	}
	public function google_analytics_setting_input(){
		$value=!empty($this->options['google_analytics'])? $this->options['google_analytics']:'';
		 echo  "<input type='text' name='shirshak_theme_option[google_analytics]' class='regular-text' value='{$this->options['google_analytics']}' />";
	}

	public function google_search_setting_input(){
		$value=!empty($this->options['google_search'])? $this->options['google_search']:'';
		 echo  "<input type='text' name='shirshak_theme_option[google_search]' class='regular-text' value='{$value}' />";
	}
	public function favicon_setting_input(){
		 $value=!empty($this->options['favicon'])? $this->options['favicon']:'';
		 echo  "<input type='text' name='shirshak_theme_option[favicon]' class='regular-text' value='{$value}' />";
	}
	public function statcounter_input(){
		 $value=!empty($this->options['statcounter'])? $this->options['statcounter']:'';
		 echo  "<textarea cols='80' rows='10' type='text' name='shirshak_theme_option[statcounter]' class='regular-text'>{$value}</textarea>";
	}
	public function recaptcha_site_key(){
		 $value=!empty($this->options['recaptcha_site_key'])? $this->options['recaptcha_site_key']:'';
		 echo  "<input type='text' name='shirshak_theme_option[recaptcha_site_key]' class='regular-text' value='{$value}' />";
	}
	public function recaptcha_secret_key(){
		 $value=!empty($this->options['recaptcha_secret_key'])? $this->options['recaptcha_secret_key']:'';
		 echo  "<input type='text' name='shirshak_theme_option[recaptcha_secret_key]' class='regular-text' value='{$value}' />";
	}
	public function notes_submission(){
		 $value=!empty($this->options['notes_submission'])? $this->options['notes_submission']:'';
		 $checked=($value==1)?"checked":'';;
		 echo  "<input type='checkbox' name='shirshak_theme_option[notes_submission]' {$checked} value='1' />";
	}


}
if(is_admin()) new Theme_Options;
?>
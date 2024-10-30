<?php
/*
Plugin Name: Cookie Control
Plugin URI: http://www.civicuk.com/cookie-law/index
Description: Cookie Control is a mechanism for controlling user consent for the use of cookies on their computer.
Version: 2.2
Author: Civic UK
Author URI: http://civicuk.com/cookie-law/index
*/

//  defaults
$def_cookiecontrol_consentmodel = 'INFO';

$def_cookiecontrol_popup = 'true';
$def_cookiecontrol_timeout = '7';

$def_cookiecontrol_position = 'LEFT';
$def_cookiecontrol_shape = 'TRIANGLE';
$def_cookiecontrol_theme = 'LIGHT';

$def_cookiecontrol_titleText = 'This site uses cookies to store information on your computer.';
$def_cookiecontrol_introText = 'Some of these cookies are essential to make our site work and others help us to improve by giving us some insight into how the site is being used.';
$def_cookiecontrol_fullText = 'These cookies are set when you submit a form, login or interact with the site by doing something that goes beyond clicking some simple links. We also use some non-essential cookies to anonymously track visitors or enhance your experience of this site.';
$def_cookiecontrol_privacyURL = '';

$def_cookiecontrol_countries = 'United Kingdom';
$def_cookiecontrol_protected = '';
$def_cookiecontrol_subdomains = 'true';

$def_cookiecontrol_gakey = '';
$def_cookiecontrol_analytics = '';

$def_cookiecontrol_ias = 'Information and Settings';
$def_cookiecontrol_on = 'Turn cookies on';
$def_cookiecontrol_off = 'Turn cookies off';
$def_cookiecontrol_bs = 'Browser Settings';
$def_cookiecontrol_rm = 'Read more';
$def_cookiecontrol_rl = 'Read less';
$def_cookiecontrol_ab = 'About this tool';
$def_cookiecontrol_c = 'I\'m fine with this';

$def_cookiecontrol_onlyHideIfConsented = 'false';

//	define defaults
$cookiecontrol_defaults = apply_filters('cookiecontrol_defaults', array(
	'consentmodel' => $def_cookiecontrol_consentmodel,
	'onlyHideIfConsented' => $def_cookiecontrol_onlyHideIfConsented,
	
	'popup' => $def_cookiecontrol_popup,
	'timeout' => $def_cookiecontrol_timeout,
	
	'position' => $def_cookiecontrol_position,
	'shape' => $def_cookiecontrol_shape,
	'theme' => $def_cookiecontrol_theme,
	
	'titleText' => $def_cookiecontrol_titleText,
	'introText' => $def_cookiecontrol_introText,
	'fullText' => $def_cookiecontrol_fullText,
	'privacyURL' => $def_cookiecontrol_privacyURL,
	
	'countries' => $def_cookiecontrol_countries,
	'protected' => $def_cookiecontrol_protected,
	'subdomains' => $def_cookiecontrol_subdomains,
	
	'gakey' => $def_cookiecontrol_gakey,
	'analytics' => $def_cookiecontrol_analytics,
	
	'ias' => $def_cookiecontrol_ias,
	'on' => $def_cookiecontrol_on,
	'off' => $def_cookiecontrol_off,
	'bs' => $def_cookiecontrol_bs,
	'rm' => $def_cookiecontrol_rm,
	'rl' => $def_cookiecontrol_rl,
	'ab' => $def_cookiecontrol_ab,
	'c' => $def_cookiecontrol_c,

));

//	pull the settings from the db
$cookiecontrol_settings = get_option('cookiecontrol_settings');
//	fallback default settings
$cookiecontrol_settings = wp_parse_args($cookiecontrol_settings, $cookiecontrol_defaults);

//	registers settings in the db
add_action('admin_init', 'cookiecontrol_register_settings');
function cookiecontrol_register_settings() {
	register_setting('cookiecontrol_settings', 'cookiecontrol_settings', 'cookiecontrol_settings_validate');
}

//	this function adds the settings page to the Appearance tab
add_action('admin_menu', 'add_cookiecontrol_menu');
function add_cookiecontrol_menu() {
	add_menu_page('Cookie Control', 'Cookie Control', 'administrator', 'cookiecontrol', 'cookiecontrol_admin_page');
}

// options page styling
function custom_admin_styles() {
wp_register_style( 'style.css', $siteurl.'/wp-content/plugins/cookie-control/css/style.css', null, '1.0', 'screen' );
wp_enqueue_style( 'style.css' );
}

add_action( 'admin_print_styles', 'custom_admin_styles' );

//Settings page
function cookiecontrol_admin_page() { 
?>

<div class="ccc-container">

<header>
	<h1>
		<a href="http://www.civicuk.com/cookie-law/index" title="Cookie Control by Civic" targt="_blank">Cookie Control by Civic</a>
	</h1>
</header>

<hr>

<div>
<p>With an elegant  user-interface that doesn't hurt the look and feel of your site, Cookie Control is a mechanism for controlling user consent for the use of cookies on their computer.</p>
<p>For more information, please visit Civic's Cookie Control pages at: <a href="http://www.civicuk.com/cookie-law/index" title="Cookie Control by Civic" target="_blank">http://www.civicuk.com/cookie-law/index</a></p>
<a class="civic" href="http://www.civicuk.com/cookie-law/pricing" target="_blank">Get Your API Key</a>
</div>

<div class="wrap">
<?php cookiecontrol_settings_update_check(); ?>
<form method="post" action="options.php">
<?php settings_fields('cookiecontrol_settings'); ?>
<?php global $cookiecontrol_settings; $options = $cookiecontrol_settings; ?>
	
	<!-- API -->
	<h2>Your Cookie Control Product Information</h2>
	<table class="form-table">
	<tr><th scope="row">
			<label for="cookiecontrol_settings[apikey]">API Key <span>&#42;</span></label>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[apiKey]" id="cookiecontrol_settings[apiKey]" value="<?php echo $options['apiKey'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[product]">Product License Type <span>&#42;</span></label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[product]" id="cookiecontrol_settings[product]" value="PROD_FREE" <?php checked('PROD_FREE', $options['product']); ?> />Free
			<input type="radio" name="cookiecontrol_settings[product]" id="cookiecontrol_settings[product]" value="PROD_PAID" <?php checked('PROD_PAID', $options['product']); ?> />Single Domain
			<input type="radio" name="cookiecontrol_settings[product]" id="cookiecontrol_settings[product]" value="PROD_PAID_MULTISITE" <?php checked('PROD_PAID_MULTISITE', $options['product']); ?> />Multi Domain
			<input type="radio" name="cookiecontrol_settings[product]" id="cookiecontrol_settings[product]" value="PROD_PAID_CUSTOM" <?php checked('PROD_PAID_CUSTOM', $options['product']); ?> />Custom
		</td>
	</tr>
	</table>
	
	<hr />
	
	<!-- CONSENT MODEL - H3 radio options, information_only, implicit, explicit. implicit default. need good explanation for each option -->
	<h2>Choose your compliance model</h2>
	<p>Select the consent model you wish Cookie Control to use. In each consent model the Cookie Control panel appears to the user when they first access the site.</p>
	<table class="form-table">
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[consentmodel]">Compliance Model</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[consentmodel]" value="INFO" <?php checked('INFO', $options['consentmodel']); ?> />Information Only
			<input type="radio" name="cookiecontrol_settings[consentmodel]" value="IMPLICIT" <?php checked('IMPLICIT', $options['consentmodel']); ?> />Implied Consent
			<input type="radio" name="cookiecontrol_settings[consentmodel]" value="EXPLICIT" <?php checked('EXPLICIT', $options['consentmodel']); ?> />Explicit Consent
		</td>
	</tr>						
	</table></br>

	<p>Select the behaviour of the ‘X’ button (for corner pop-up widgets) and ‘Close’ button (for bar widgets). Normally, pressing these buttons will hide the widget and not show it again on the next page load. Set this option to true to keep showing the widget until the user provides (or explicitly denies) consent.</p>
	<table class="form-table">
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[onlyHideIfConsented]">Close Behaviour</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[onlyHideIfConsented]" id="cookiecontrol_settings[onlyHideIfConsented]" value="true" <?php checked('true', $options['onlyHideIfConsented']); ?> />True - Keep showing the widget
			<input type="radio" name="cookiecontrol_settings[onlyHideIfConsented]" id="cookiecontrol_settings[onlyHideIfConsented]" value="false" <?php checked('false', $options['onlyHideIfConsented']); ?> />False - Hide the widget on close
		</td>
	</tr>						
	</table></br>
	<!-- END COSENT MODEL -->
	
	<hr />
	
	<!-- Pop Up -->
	<h2>Pop up by default</h2>
	<p>Choose whether the Cookie Control user interface (UI) is open by default on page load. This makes it much more explicit that you're seeking user's consent for the use of cookies and may be a safer option in terms of compliance.</p>
	<table class="form-table">
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[popup]">Pop up by default</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[popup]" id="cookiecontrol_settings[popup]" value="true" <?php checked('true', $options['popup']); ?> />Yes
			<input type="radio" name="cookiecontrol_settings[popup]" id="cookiecontrol_settings[popup]" value="false" <?php checked('false', $options['popup']); ?> />No
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[timeout]">Pop up Timeout</label></th>
		<td>
			<input type="text" name="cookiecontrol_settings[timeout]" id="cookiecontrol_settings[timeout]" value="<?php echo $options['timeout'] ?>" size="1" /> seconds
		</td>
	</tr>
	</table><br />
	
	<hr />
	<!-- End Pop Up -->
	
	<!-- Look and Feel -->
	<h2>Look and Feel</h2>
	<p>Choose your widget style, position, theme and background.</p>
	<p>Note that a license is required for the top bar and bottom bar versions of the interface.</p>
	<table class="form-table">
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[shape]">Widget Style</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[shape]" id="cookiecontrol_settings[shape]" value="TRIANGLE" <?php checked('TRIANGLE', $options['shape']); ?> />Triangle
			<input type="radio" name="cookiecontrol_settings[shape]" id="cookiecontrol_settings[shape]" value="SQUARE" <?php checked('SQUARE', $options['shape']); ?> />Square
			<input type="radio" name="cookiecontrol_settings[shape]" id="cookiecontrol_settings[shape]" value="DIAMOND" <?php checked('DIAMOND', $options['shape']); ?> />Diamond
			<input type="radio" name="cookiecontrol_settings[shape]" id="cookiecontrol_settings[shape]" value="BAR" <?php checked('BAR', $options['shape']); ?> />Bar
		</td>
	</tr>	
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[position]">Widget Position</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[position]" id="cookiecontrol_settings[position]" value="LEFT" <?php checked('LEFT', $options['position']); ?> />Left
			<input type="radio" name="cookiecontrol_settings[position]" id="cookiecontrol_settings[position]" value="RIGHT" <?php checked('RIGHT', $options['position']); ?> />Right
			<input type="radio" name="cookiecontrol_settings[position]" id="cookiecontrol_settings[position]" value="TOP" <?php checked('TOP', $options['position']); ?> />Top
			<input type="radio" name="cookiecontrol_settings[position]" id="cookiecontrol_settings[position]" value="BOTTOM" <?php checked('BOTTOM', $options['position']); ?> />Bottom
		</td>
	</tr>	
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[theme]">Widget Theme</label>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[theme]" id="cookiecontrol_settings[theme]" value="LIGHT" <?php checked('LIGHT', $options['theme']); ?> />Light
			<input type="radio" name="cookiecontrol_settings[theme]" id="cookiecontrol_settings[theme]" value="DARK" <?php checked('DARK', $options['theme']); ?> />Dark
		</td>
	</tr>						
	</table></br>
	
	<hr />
	
	<!--Text Options-->
	<h2>Text Options</h2>
	<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[titleText]">Title Text</label>
			<p>On window-style widgets, this text appears as the first sentence of the window. On bar-style widgets, this is the only text visible on the bar before it is expanded.</p>
		</th>
		<td>
			<textarea name="cookiecontrol_settings[titleText]" id="cookiecontrol_settings[titleText]" cols="100" rows="5"><?php echo $options['titleText'] ?></textarea>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[introText]">Introductory Text</label>
			<p>Some short, sharp copy to introduce the role of cookies on your site. On window-style widgets, this text is concatenated to the title and appears together. On bar-style widgets, this is the first text displayed in the widget when the information panel is visible.</p>
		</th>
		<td>
			<textarea name="cookiecontrol_settings[introText]" id="cookiecontrol_settings[introText]" cols="100" rows="5"><?php echo $options['introText'] ?></textarea>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[fullText]">Additional Text</label>
			<p>Describe in general terms what your cookies are used for.</p>
		</th>
		<td>
			<textarea name="cookiecontrol_settings[fullText]" id="cookiecontrol_settings[fullText]" cols="100" rows="5"><?php echo $options['fullText'] ?></textarea>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[privacyURL]">Privacy or cookie policy</label>
			<p>A privacy policy explaining how you manage personal data, and how cookies are used on your site is essential for legal compliance. Please provide the full URL to your privacy or cookie policy.</p>
			<p style="color: orange; font-weight: 700;">Please note this link is added at the end of your additional text.</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[privacyURL]" id="cookiecontrol_settings[privacyURL]" value="<?php echo $options['privacyURL'] ?>" size="50" />
		</td>
	</tr>
	</table></br>
	
	<hr />
	
	<!-- Techinal Functionality -->
	<h2>Additional Functionality</h2>
	<table class="form-table">
	
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[countries]">Countries to show Cookie Control</label>
			<p>Please enter a comma separated list of countries for which you wish the plugin to appear. If left blank Cookie Control will appear for all users from all countries. View the full <a target="_blank" href="http://www.iso.org/iso/country_codes/iso_3166_code_lists/country_names_and_code_elements.htm">list of countries.</a></p>
			<p>Please note this feature is available to paid versions only.</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[countries]" id="cookiecontrol_settings[countries]" value="<?php echo $options['countries'] ?>" size="50" />
		</td>
	</tr>
	
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[protected]">List of Protected Cookies</label>
			<p>Please enter a comma separated list of the cookies you do not want deleted.</p>
			<p>For example 'analytics', 'twitter', etc.</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[protected]" id="cookiecontrol_settings[countries]" value="<?php echo $options['protected'] ?>" size="50" />
		</td>
	</tr>
		
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[subdomains]">Delete cookies on subdomains too</label>
			<p>If set to true (the default), Cookie Control assumes it is deployed on a subdomain. Deleting cookies will attempt to delete them for the subdomain, but also try all super-domains.</p>
			<p>This options enables you to clear cookies from subdomains. It does NOT enable Cookie Control to work in subdomains. If this is what you require then you might be interested in our multi domain licence.</p>
		</th>
		<td>
			<input type="radio" class="first" name="cookiecontrol_settings[subdomains]" id="cookiecontrol_settings[subdomains]" value="true" <?php checked('true', $options['subdomains']); ?> /> Yes
			<input type="radio" name="cookiecontrol_settings[subdomains]" id="cookiecontrol_settings[subdomains]" value="false" <?php checked('false', $options['subdomains']); ?> /> No
		</td>
	</tr>
	
	<input type="hidden" name="cookiecontrol_settings[update]" value="UPDATED" />
	
	</table></br>
	
	<hr />
	
	<!-- Google Analytics -->
	<h2>Analytics</h2>
	<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="cookiecontrol_settings[analytics]">Analytics Tracking</label>
			<p>If you use Google Analytics, Universal Analytics, or any other Analytics tool, please copy and paste the snippet of code below. This will cause Cookie Control to interact with the Analytics tool, opting users in or out depending on their preference.</p>
			<p style="color: orange; font-weight: 700;">Please note, you do not need to include the &lt;script&gt; tags as part of your input.</p>
		</th>
	     <td>
	     	<textarea name="cookiecontrol_settings[analytics]" id="cookiecontrol_settings[analytics]" cols="100" rows="10"><?php echo $options['analytics'] ?></textarea>
		</td>
	</tr>
	</table><br>
		
	<hr />
	
	<!--Language Options-->
	<h2>Language Options</h2>
	<p>Additional Language settings for all of the text used in Cookie Control.</p>
	<table class="form-table">
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[ias]">Information and Settings Text</label>
			<p>Used to decorate buttons to expand the widget, providing more information. Defaults to "Information and Settings".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[ias]" id="cookiecontrol_settings[ias]" value="<?php echo $options['ias'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[on]">Enable Cookies Text</label>
			<p>This is the text that appears in buttons to enable cookies. It defaults to "Turn cookies on".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[on]" id="cookiecontrol_settings[on]" value="<?php echo $options['on'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[off]">Disable Cookies Text</label>
			<p>This is the text that appears in buttons to disable cookies. It defaults to "Turn cookies off".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[off]" id="cookiecontrol_settings[off]" value="<?php echo $options['off'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[bs]">Browser Settings Text</label>
			<p>This is the text that takes the user to a page (on Civic's website) describing how to configure their particular browser's cookie support for privacy. It defaults to "Browser settings".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[bs]" id="cookiecontrol_settings[bs]" value="<?php echo $options['bs'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[rm]">Read More Text</label>
			<p>This appears in buttons and controls prompting the user to read more text by expanding a hidden panel. It defaults to "Read more".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[rm]" id="cookiecontrol_settings[rm]" value="<?php echo $options['rm'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[rl]">Read Less Text</label>
			<p>This appears in buttons and controls allowing the user to contract panels to hide the full text of the widget. It defaults to "Read less".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[rl]" id="cookiecontrol_settings[rl]" value="<?php echo $options['rl'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[ab]">About This Tool Text</label>
			<p>Text used to take the user to the description of Civic Cookie Control on Civic's servers. Defaults to "About this tool".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[ab]" id="cookiecontrol_settings[ab]" value="<?php echo $options['ab'] ?>" size="50" />
		</td>
	</tr>
	<tr>
		<th scope="row">
			<label for="cookiecontrol_settings[c]">Close This Tool Text</label>
			<p>Text used for buttons that close the widget. Defaults to "I'm fine with this".</p>
		</th>
		<td>
			<input type="text" name="cookiecontrol_settings[c]" id="cookiecontrol_settings[c]" value="<?php echo $options['c'] ?>" size="50" />
		</td>
	</tr>
	</table></br>
	
	<hr />
	
	<!-- Submit -->
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Settings') ?>" />
		</form>
	
		<!-- The Reset Option -->
		<form method="post" action="options.php">
		<?php settings_fields('cookiecontrol_settings'); ?>
		<?php global $cookiecontrol_defaults; // use the defaults ?>
		<?php foreach((array)$cookiecontrol_defaults as $key => $value) : ?>
		<input type="hidden" name="cookiecontrol_settings[<?php echo $key; ?>]" value="<?php echo $value; ?>" />
		<?php endforeach; ?>
		<input type="hidden" name="cookiecontrol_settings[update]" value="RESET" />
		<input type="submit" class="button" value="<?php _e('Reset Settings') ?>" />
		</form>
		<!-- End Reset Option -->
	</p>	

	</div>
</div><!-- End of Plugin Option Page Container -->


<?php 
}

function cookiecontrol_settings_update_check() {
	global $cookiecontrol_settings;
	if(isset($cookiecontrol_settings['update'])) {
		echo '<div class="updated fade" id="message"><p>Cookie Control Settings <strong>'.$cookiecontrol_settings['update'].'</strong></p></div>';
		unset($cookiecontrol_settings['update']);
		update_option('cookiecontrol_settings', $cookiecontrol_settings);
	}
}

function cookiecontrol_settings_validate($input) {
	$input['text'] = sanitize_text_field(wp_filter_nohtml_kses($input['text']));
	$input['position'] = wp_filter_nohtml_kses($input['position']);
	$input['shape'] = wp_filter_nohtml_kses($input['shape']);
	$input['timeout'] = intval($input['timeout']);
	$input['countries'] = wp_filter_nohtml_kses($input['countries']);
	$input['analytics'] = strip_tags($input['analytics']); //wp_filter_nohtml_kses($input['analytics']);

	$input['ias'] = sanitize_text_field(wp_filter_nohtml_kses($input['ias']));
	$input['on'] = sanitize_text_field(wp_filter_nohtml_kses($input['on']));
	$input['off'] = sanitize_text_field(wp_filter_nohtml_kses($input['off']));
	$input['bs'] = sanitize_text_field(wp_filter_nohtml_kses($input['bs']));
	$input['rm'] = sanitize_text_field(wp_filter_nohtml_kses($input['rm']));
	$input['rl'] = sanitize_text_field(wp_filter_nohtml_kses($input['rl']));
	$input['ab'] = sanitize_text_field(wp_filter_nohtml_kses($input['ab']));
	$input['c'] = sanitize_text_field(wp_filter_nohtml_kses($input['c']));
	
	return $input;
}

add_action('wp_print_scripts', 'cookiecontrol_scripts');
function cookiecontrol_scripts() {
	if(!is_admin()) {
		wp_enqueue_script('cookiecontrol', WP_CONTENT_URL.'/plugins/cookie-control/js/cookieControl-6.2.min.js', array('jquery'), '', true);
	}
}

add_action('wp_footer', 'cookiecontrol_args', 1500);
function cookiecontrol_args() {
	global $cookiecontrol_settings; 
  	$cookiecontrol_timeout = $cookiecontrol_settings['timeout'] * 1000; // Convert seconds to microseconds
  	$privacy = ($cookiecontrol_settings['privacyURL'] != '')?sanitize_text_field($cookiecontrol_settings['privacyURL']):'';
	?>

<script type="text/javascript">
//<![CDATA[

cookieControl({

t: {
	title: '<p><?php echo sanitize_text_field($cookiecontrol_settings['titleText']); ?></p>',
    intro: '<p><?php echo sanitize_text_field($cookiecontrol_settings['introText']); ?></p>',
    full: '<p><?php echo sanitize_text_field($cookiecontrol_settings['fullText']); ?></p><p>Read more about our <a href="<?php echo $cookiecontrol_settings['privacyURL']; ?>" title="Read our privacy policy">privacy policy.</a></p>',
    
    ias: '<?php echo $cookiecontrol_settings['ias']; ?>',
    on: '<?php echo $cookiecontrol_settings['on']; ?>',
    off: '<?php echo $cookiecontrol_settings['off']; ?>',
    bs: '<?php echo $cookiecontrol_settings['bs']; ?>',
    rm: '<?php echo $cookiecontrol_settings['rm']; ?>',
    rl: '<?php echo $cookiecontrol_settings['rl']; ?>',
    ab: '<?php echo $cookiecontrol_settings['ab']; ?>',
    c: '<?php echo $cookiecontrol_settings['c']; ?>'
    },

position:CookieControl.POS_<?php echo $cookiecontrol_settings['position']; ?>,
style:CookieControl.STYLE_<?php echo $cookiecontrol_settings['shape']; ?>,
theme:CookieControl.THEME_<?php echo $cookiecontrol_settings['theme']; ?>,

startOpen: <?php echo $cookiecontrol_settings['popup']; ?>,
autoHide: <?php echo $cookiecontrol_timeout; ?>,
onlyHideIfConsented: <?php echo $cookiecontrol_settings['onlyHideIfConsented']; ?>,

subdomains: <?php echo $cookiecontrol_settings['subdomains']; ?>,
protectedCookies: [<?php echo $cookiecontrol_settings['protected']; ?>],

apiKey: '<?php echo $cookiecontrol_settings['apiKey']; ?>',
product: CookieControl.<?php echo $cookiecontrol_settings['product']; ?>,

consentModel: CookieControl.MODEL_<?php echo $cookiecontrol_settings['consentmodel']; ?>,
   
    onAccept:function(){ccAnalytics()},
    onReady:function(){},
    onCookiesAllowed:function(){ccAnalytics()},
    onCookiesNotAllowed:function(){},
    countries:'<?php echo $cookiecontrol_settings['countries']; ?>'

});
    

function ccAnalytics() {
	<?php echo $cookiecontrol_settings['analytics']; ?>
}

//]]>

</script>
<?php }
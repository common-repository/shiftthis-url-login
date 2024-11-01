<?php
/*
Plugin Name: ShiftThis | URL Login
Plugin URI: http://www.shiftthis.net/wordpress-url-login-plugin/
Description: Login and logout using your blog url with /login and /logout.
Author: ShiftThis.net
Version: 1.2
Author URI: http://www.shiftthis.net
*/
	sturl_check_config();
	
	if ( isset($_POST['sturl_submit_options']) ) 
		add_action('init', 'sturl_options_submit'); //Update Options 

	// Load Options
	$sturl_config = get_option('sturl_config');
	
include_once(ABSPATH.'wp-admin/admin-functions.php');	

function sturl_redirects() {
 	global $sturl_config;
	$home_path = get_home_path();
	$filename = $home_path.'.htaccess';
	$marker = "ST_URLLogin";
	
	if($sturl_config['login_redirect'] != "Custom"){
		$login_url = $sturl_config['login_redirect'];
	}else{
		$login_url = $sturl_config['login_custom'];
	}
	$login_text = $sturl_config['login_text'];
	$logout_text = $sturl_config['logout_text'];
	
	$insertion = array('Redirect 301 /'.$login_text.' '.$login_url, 'Redirect 301 /'.$logout_text.' '.get_option('siteurl').'/wp-login.php?action=logout');
	
	insert_with_markers( $filename, $marker, $insertion );

}
add_action('activate_st-hidden-login.php', 'sturl_redirects');

function sturl_add_pages(){
	add_options_page('URL Login', 'URL Login', 10, __FILE__, 'sturl_options_page');
}
add_action('admin_menu', 'sturl_add_pages');

function sturl_options_page() {

	// Make sure we have the freshest copy of the options
	$sturl_config = get_option('sturl_config');
	global $wpdb, $table_prefix;
?>
		<div class="wrap">
		  	<h2>URL Login Options</h2>
		  	<form method="post"  action="<?=$_SERVER['REQUEST_URI']?>&amp;updated=true">
		    	<input type="hidden" name="sturl_submit_options" value="true" />
		<table class="optiontable"> 
			<tr valign="top"> 
			<th scope="row"><label for="login_text">Login Text:</label></th> 
			<td><input type="text" name="login_text" id="login_text" value="<?php echo $sturl_config['login_text'];?>" /></td> 
			</tr>
			<tr valign="top"> 
			<th scope="row"><label for="login_redirect">Login Redirect to:</label></th> 
			<td><select name="login_redirect" id="login_redirect"> 
						<option value="<?php echo get_option('siteurl');?>/wp-login.php?redirect_to=<?php echo get_option('siteurl');?>" <?php if($sturl_config['login_redirect'] == get_option('siteurl').'/wp-login.php?redirect_to='.get_option('siteurl')){echo 'selected="selected"';} ?>">WordPress Address (<?php echo get_option('siteurl');?>)</option>
						<option value="<?php echo get_option('siteurl');?>/wp-login.php?redirect_to=<?php echo get_option('home');?>" <?php if($sturl_config['login_redirect'] == get_option('siteurl').'/wp-login.php?redirect_to='.get_option('home')){echo 'selected="selected"';} ?>">Blog Address (<?php echo get_option('home');?>)</option>
						<option value="<?php echo get_option('siteurl');?>/wp-admin/" <?php if($sturl_config['login_redirect'] == get_option('siteurl').'/wp-admin/'){echo 'selected="selected"';} ?>">WordPress Admin (<?php echo get_option('siteurl').'/wp-admin/';?>)</option>
						<option value="Custom" <?php if($sturl_config['login_redirect'] == "Custom"){echo 'selected="selected"';} ?>">Custom URL (Enter Below)</option>
					</select>	<br />
				<input type="text" name="login_custom" size="50" value="<?php echo $sturl_config['login_custom'];?>" />	</td> 
			</tr>
			<th scope="row"><label for="logout_text">Logout Text:</label></th> 
			<td><input type="text" name="logout_text" id="logout_text" value="<?php echo $sturl_config['logout_text'];?>" /></td> 
			</tr>
			
		</table>
				
			    <p class="submit">
			      	<input type="submit" name="Submit" value="Update Options &raquo;" />
			    </p>
			</form>
			
		<?

}
function sturl_check_config() {

	if ( !$option = get_option('sturl_config') ) {

		// Default Options
		$option['login_text'] = 'login';
		$option['login_redirect'] = get_option('siteurl').'/wp-admin/';
		$option['login_custom'] = '';
		$option['logout_text'] = 'logout';	

		update_option('sturl_config', $option);
		sturl_redirects();

	}


}
function sturl_options_submit() {


	if ( current_user_can('level_10') ) {

		//options page
		$option['login_text'] = $_POST['login_text'];
		$option['login_redirect'] = $_POST['login_redirect'];
		$option['login_custom'] = $_POST['login_custom'];
		$option['logout_text'] = $_POST['logout_text'];
				
		update_option('sturl_config', $option);
		sturl_redirects();

	}

}
?>
<?php
/*
Plugin Name: Twitter Leads
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Allows visitors to tweet from your Twitter account.
Version: 1.0
Author: Sean Coleman
Author URI: http://www.seancoleman.net
License: A "Slug" license name e.g. GPL2
*/
// Constants

// URL of the plugin directory
define('TWITTER_LEADS_PATH', get_option('siteurl') . '/wp-content/plugins/' . dirname(plugin_basename(__FILE__)) . '/');

// Create the option page for Twitter account information
add_action('admin_menu', 'twitter_leads_menu');
add_action('admin_init', 'register_twitter_leads_settings');

// Add the option page to the settings menu
function twitter_leads_menu() {
	add_options_page('Twitter Leads Options', 'Twitter Leads', 'manage_options', 'twitter-leads-menu', 'twitter_leads_settings_page');
}

// Register Twitter account settings
function register_twitter_leads_settings() {
	//register our settings
	register_setting( 'twitter-leads-settings', 'twitter_leads_twitter_username' );
	register_setting( 'twitter-leads-settings', 'twitter_leads_twitter_password' );
}

function twitter_leads_settings_page() {
?>
<div class="wrap">
<h2>Twitter Leads</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'twitter-leads-settings' ); ?>
    <?php// do_settings( 'twitter-leads-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
          <th scope="row">Twitter Username</th>
          <td><input type="text" name="twitter_leads_twitter_username" value="<?= get_option('twitter_leads_twitter_username'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Twitter Password</th>
        <td><input type="password" name="twitter_leads_twitter_password" value="<?php echo get_option('twitter_leads_twitter_password'); ?>" /></td>
        
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
    </p>

</form>
</div>
<?php }

class Twitter_Leads_Widget extends WP_Widget {
  function Twitter_Leads_Widget() {
    $widget_ops = array('classname' => 'widget_twitter_leads', 'description' => 'Form for public tweets');
    $control_ops = array('id_base' => 'twitter-leads-widget');
    $this->WP_Widget('twitter-leads-widget', 'Twitter Leads', $widget_ops, $control_ops);
  }
  
  function widget($args, $instance) {
    extract($args); ?>
    <form method="post" action="<?= TWITTER_LEADS_PATH ?>twitter-leads-post.php" id="twitter_leads_form" name="twitter_leads_form">
      <textarea name="twitter_leads_message" id="twitter_leads_message" ></textarea>
      <input name="twitter_leads_phone" id="twitter_leads_phone" />
      <input type="submit" value="Send message"/>
    </form>
    <?php
  }
}
function register_twitter_leads_widget() {
  register_widget('Twitter_Leads_Widget');
}
add_action('widgets_init', 'register_twitter_leads_widget');
?>
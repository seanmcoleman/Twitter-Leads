<?php

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
    <?php do_settings( 'twitter-leads-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Twitter Username</th>
        <td><input type="text" name="new_option_name" value="<?php echo get_option('twitter_leads_twitter_username'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Twitter Password</th>
        <td><input type="password" name="some_other_option" value="<?php echo get_option('twitter_leads_twitter_password'); ?>" /></td>
        
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
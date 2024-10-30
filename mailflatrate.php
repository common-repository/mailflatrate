<?php
/*
Plugin Name: mailflatrate
Description: mailflatrate for wordPress by Swiss Marketing Systems Germany GmbH. Adds various highly effective sign-up methods to your site.
Version: 1.7.2
Author: Swiss Marketing Systems Germany GmbH
Author URI: https://mailflatrate.com
Text Domain: mailflatrate
Domain Path: /languages
mailflatrate for WordPress
Copyright (C) 2012-2018, Swiss Marketing Systems Germany GmbH

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 

defined( 'ABSPATH' ) or exit;

function mailflatrate_plugin_activate() {

  update_option( 'mailflatrate-successfully-subscribeed',__('Thanks for your subscription. You will receive a confirmation email in minutes.','mailflatrate-for-wp'));
  update_option( 'mailflatrate-invalid-email-address', __('Your email is invalid. Please check it again.','mailflatrate-for-wp'));
  update_option( 'mailflatate_already_subscribed', __('This email adress is already subscribed.','mailflatrate-for-wp'));
  update_option( 'mailflatrate-agree_to_terms', __('Please agree with terms and conditions','mailflatrate-for-wp'));
  update_option( 'missing-email-address', __('Please provide the subscriber email address','mailflatrate-for-wp'));
  update_option( 'data-protection', __('Please provide the data protection','mailflatrate-for-wp'));
  /* activation code here */
}
register_activation_hook( __FILE__, 'mailflatrate_plugin_activate' );

function mailflatrate_admin_notice__success() {
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$status=0;
	if(strcmp($mailflatratePublicKey,'')!=0 && strcmp($mailflatratePrivateKey,'')!=0)
	{
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey,
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = 1, $perPage = 1);
		if(!isset($response->body['error']))
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
	}
	if($status==0)
	{
    ?>
    <div class="notice notice-error is-dismissible"> 
	<p><?php echo __('To start with Mailflatrate','mailflatrate-for-wp');?> <strong><a href='<?php echo admin_url('admin.php?page=mailflatrateOptions'); ?>'><?php echo __('please enter your Public and Private Key','mailflatrate-for-wp'); ?></a></strong></p>
</div>
    <?php
	}
}
add_action( 'admin_notices', 'mailflatrate_admin_notice__success' );

function mailflatrate_load_plugin() {

	global $mfr;

	define( 'MFR_VERSION', '1.0.0' );

	define( 'MFR_PLUGIN_DIR', dirname( __FILE__ ) . '/' );

	define( 'MFR_PLUGIN_URL', plugins_url( '/' , __FILE__ ) );

	define( 'MFR_PLUGIN_FILE', __FILE__ );
	load_plugin_textdomain( 'mailflatrate-for-wp', false, dirname(plugin_basename(__FILE__)).'/languages/' );
	if( is_admin() ) {
		add_action( 'admin_enqueue_scripts', 'load_mailflatrate_style' );
		add_action( 'admin_menu', 'register_mailflatrate_page');
		
	}
	require_once MFR_PLUGIN_DIR.'/vendor/autoload.php';
	return true;

}
function load_mailflatrate_style($hook) {
        // Load only on ?page=mypluginname
         wp_register_style( 'mailflatrate_wp_admin_css', MFR_PLUGIN_URL.'assets/css/style.css',array(),MFR_VERSION);
		wp_register_style( 'mailflatrate_wp_admin_color_picker_css', MFR_PLUGIN_URL.'assets/css/spectrum.css',array(),MFR_VERSION);
		 wp_register_script('mailflatrate_wp_admin_country_json',MFR_PLUGIN_URL.'assets/js/country.json',array(),MFR_VERSION);
		 wp_register_script('mailflatrate_wp_admin_json',MFR_PLUGIN_URL.'assets/js/states.json',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_js', MFR_PLUGIN_URL.'assets/js/script.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_js_import', MFR_PLUGIN_URL.'assets/js/import.js',array(),MFR_VERSION);
		 wp_register_style( 'mailflatrate_wp_admin_code_minor_css', MFR_PLUGIN_URL.'assets/codeminor/lib/codemirror.css',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_code_minor_js', MFR_PLUGIN_URL.'assets/codeminor/lib/codemirror.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_code_minor_xml', MFR_PLUGIN_URL.'assets/codeminor/mode/xml/xml.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_code_minor_mode', MFR_PLUGIN_URL.'assets/codeminor/mode/javascript/javascript.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_code_minor_mode_css_js', MFR_PLUGIN_URL.'assets/codeminor/mode/css/css.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_code_minor_mode_htmlmixed_js', MFR_PLUGIN_URL.'assets/codeminor/mode/htmlmixed/htmlmixed.js',array(),MFR_VERSION);
		 wp_register_script( 'mailflatrate_wp_admin_color_picker_js', MFR_PLUGIN_URL.'assets/js/spectrum.js',array(),MFR_VERSION);
		 wp_enqueue_style( 'mailflatrate_wp_admin_css' );
		wp_enqueue_style( 'mailflatrate_wp_admin_color_picker_css' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_color_picker_js' );
		 wp_enqueue_style( 'mailflatrate_wp_admin_code_minor_css' );
		 wp_enqueue_script('mailflatrate_wp_admin_country_json');
		 wp_enqueue_script('mailflatrate_wp_admin_js_import');
		 wp_enqueue_script('mailflatrate_wp_admin_json');
		 wp_enqueue_script( 'mailflatrate_wp_admin_js' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_code_minor_js' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_code_minor_xml' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_code_minor_mode' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_code_minor_mode_css_js' );
		 wp_enqueue_script( 'mailflatrate_wp_admin_code_minor_mode_htmlmixed_js' );
		 wp_localize_script( 'mailflatrate_wp_admin_js', 'ajax_object',
         array( 'ajax_url' => admin_url( 'admin-ajax.php'),
		 		'plugin_url'=> MFR_PLUGIN_URL ) );  
} 
function register_mailflatrate_page() {

	add_menu_page('Mailflatrate for WP', __('Mailflatrate for WP','mailflatrate-for-wp'), 'manage_options', 'mailflatrateOptions', 'mailflatrateOptionCallBackfunction_page',plugins_url( 'mailflatrate/assets/img/favicon.ico' ) );

    	add_submenu_page('mailflatrateOptions', 'Form', __('Form','mailflatrate-for-wp'), 'manage_options', 'mailflatrate-form','mailflatrateOptionFormfunction');
		add_submenu_page('mailflatrateOptions', 'Import', __('Import','mailflatrate-for-wp'), 'manage_options', 'mailflatrate-import','mailflatrateImportfunction');
		add_submenu_page('mailflatrateOptions', 'Export', __('Export','mailflatrate-for-wp'), 'manage_options', 'mailflatrate-export','mailflatrateExportfunction');
		add_submenu_page('mailflatrateOptions', 'Sync', __('Sync','mailflatrate-for-wp'), 'manage_options', 'mailflatrate-sync','mailflatrateSyncfunction');

		add_action( 'admin_init', 'mailflatrateOptionCallBackfunction' );

}

function mailflatrateOptionCallBackfunction() {

	//register our settings

	//register_setting( 'mailflatrate-plugin-setting-group', 'connection');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate_sync_status_text');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate-sync-list-export');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate-sync-sel_import_into');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate-sync-fieldEmail');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate-sync-fieldfirstname');
	register_setting('mailflatrate-plugin-setting-sync','mailflatrate-sync-fieldlastname');

	register_setting( 'mailflatrate-plugin-setting-group', 'mailflatrate_public_key' );

	register_setting( 'mailflatrate-plugin-setting-group', 'mailflatrate_private_key' );

	register_setting('mailflatrate-plugin-setting-form-code','mailflatrate_form_code');

	register_setting('mailflatrate-plugin-setting-form-code','mailflatrate-list');

	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-successfully-subscribeed');
	
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-successfully-subscribeed-color');
	 
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-agree_to_terms');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-agree_to_terms-color');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-invalid-email-address');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-invalid-email-address-color');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate-field-missing');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatate_already_subscribed');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatate_already_subscribed-color');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate_form_error');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate_form_unsubscribed');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate_form_not_subscribed');
	register_setting('mailflatrate-plugin-setting-form-code-messages','mailflatrate_form_no_lists_selected');
	register_setting('mailflatrate-plugin-setting-form-code-messages','missing-email-address-color');
	register_setting('mailflatrate-plugin-setting-form-code-messages','missing-email-address');
	register_setting('mailflatrate-plugin-setting-form-code-messages','data-protection-color');
	register_setting('mailflatrate-plugin-setting-form-code-messages','data-protection');
}
function mailflatrateSyncfunction()
{
	echo '<div class="wrap mfr-settings">';
	echo '<p class="breadcrumbs">
			<span class="prefix">'.__('You are here','mailflatarte-for-wp').': </span>
			<span class="current-crumb"><strong>'.__('Sync mailflatrate','mailflatrate-for-wp').'</strong></span>
		  </p>';
	echo '<div class="row">';
	echo '<div class="main-content col col-4">';
	echo '<img src="'.plugins_url( 'mailflatrate/assets/img/mfr-rocket-logo.png' ).'" alt="MFR Logo" class="img-responsive logo mfr-luc-logo">';
	echo '<div class="clear"></div>';
	echo '<h3>'.__('Mailflatrate Sync','mailflatrate-for-wp').'</h3>';
	$mailflatrate_sync = ( get_option('mailflatrate_sync_status_text') );
	$mailflatrate_sync = (strcmp($mailflatrate_sync,'')!=0)?$mailflatrate_sync:'off';
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$status='<span class="not_connected">'.__('Not connected','mailflatrate-for-wp').'</span>';
	if(strcmp($mailflatratePublicKey,'')!=0 && strcmp($mailflatratePrivateKey,'')!=0)
	{
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = 1, $perPage = 1);
		if(!isset($response->body['error']))
		{
			$status='<span class="connected">'.__('Connected','mailflatrate-for-wp').'</span>';
		}
		else
		{
			$status='<span class="not_connected">'.$response->body['error'].'</span>';
		}
	}?>
	<table class="data-grid data-grid-draggable updateMailflatrateSettings">
            <tbody>
                <tr>
                    <td><?=__('Update mailflatrate list whenever update customer automatically')?></td>
                    <td><label class="switch">
                    <?php echo $mailflatrate_sync; ?>
  <input type="checkbox" id="sync_status" name="sync_status" <?=(strcmp($mailflatrate_sync, 'on')==0)?'checked="checked"':''; ?> value="<?=$mailflatrate_sync ?>">
  <span class="slider round"></span>
</label></td>
                </tr>
            </tbody>
  </table>
  <button id="btn_import_called_sync" title="Sync customers" class="button button-primary"><?=__('Save'); ?></button>
  <?php 
  	$style= (strcmp($mailflatrate_sync, 'on')==0)?"style='display:block'":"";
  	echo '<form method="post" action="options.php" class="actionFormSync" '.$style.'>';
	settings_fields( 'mailflatrate-plugin-setting-sync' );
    do_settings_sections( 'mailflatrate-plugin-setting-sync' ); 
	$sync_mailflatrate_list=get_option('mailflatrate-sync-list-export');
	$mailflatrate_sync_sel_import_into=get_option('mailflatrate-sync-sel_import_into');
	$endpoint = new MailWizzApi_Endpoint_Lists();
	$response=$endpoint->getLists($pageNumber = -1, $perPage = 20000);
  ?>
    <input type="hidden" id="sync_status_text" name="mailflatrate_sync_status_text" value="<?=$mailflatrate_sync?>"/>
    <div class="mailflatrate-list">
<div class="mailflatrate-import-container">
	<div class="mailflatrate-list-select-sync">
   <h4 style="margin: 0"><label><?=__('Select Mailflatrate List'); ?></label></h4>
         <?php 
			if(isset($response->body['data']['records']))
				{
					if(count($response->body['data']['records']) > 0)
					{?>
                    <select id="mailflatrate-list-export" name="mailflatrate-sync-list-export">
                        <option value="0">Please select list</option>
                        <?php 
                        foreach($response->body['data']['records'] as $list)
                        {?>
                            <option <?=(strcmp($sync_mailflatrate_list,$list['general']['list_uid'])==0)?'selected="selected"':'' ?> value="<?=$list['general']['list_uid']; ?>"><?=$list['general']['name']; ?></option>
                        <?php }?>
    				</select>
                	<?php }
				} ?>
       </div>
       <?php 
	    $response = [];
	    if(strcmp($sync_mailflatrate_list,'')!=0)
		{
			$listfieldsObject = new MailWizzApi_Endpoint_ListFields();
			$responseObject=$listfieldsObject->getFields($sync_mailflatrate_list);
		}
		$checkSelect = 0;
		if(isset($responseObject->body['data']['records']))
		{
			if(count($responseObject->body['data']['records']) > 0)
			{
				$checkSelect = 1;
			}
		}
		?>
        <div class="clearfix"></div>
        <br/>
        <div class="customerFieldSelect" style="<?=($checkSelect==1)?'display:block':'';?>">
            <table class="form-table">
       			<thead>
                    <tr valign="top">
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__('Field name');?></strong></td>
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__( 'Mailflatrate Field');?></strong></td>
                    </tr>
                </thead>
                <tbody>
                	
                   
                    <tr valign="top">
                        <td  scope="row"><strong><?=__( 'Email *');?></strong></td>
                        <td  scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldEmail" name="mailflatrate-sync-fieldEmail" required><option value="0"><?=__( 'Select mailflatrate field');?></option>
                        <?php 
		foreach($responseObject->body['data']['records'] as $list)
		{?>
			<option <?=(strcmp(get_option('mailflatrate-sync-fieldEmail'),$list['tag'])==0)?"selected='selected'":""; ?> value="<?php echo $list['tag']; ?>"><?php echo $list['label']; ?></option>
		<?php }?>
                        </select><br>
                        <div class="errors emailError"></div>
                        </td>
                        
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'First Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldfirstname" name="mailflatrate-sync-fieldfirstname" required><option value="0"><?=__( 'Select mailflatrate field');?></option>
                        <?php 
		foreach($responseObject->body['data']['records'] as $list)
		{?>
			<option <?=(strcmp(get_option('mailflatrate-sync-fieldfirstname'),$list['tag'])==0)?"selected='selected'":""; ?> value="<?php echo $list['tag']; ?>"><?php echo $list['label']; ?></option>
		<?php }?>
                        </select><br>
                         <div class="errors firstnameError"></div></td>
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'Last Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldlastname" name="mailflatrate-sync-fieldlastname" required><option value="0"><?=__( 'Select mailflatrate field');?></option>
                        <?php 
		foreach($responseObject->body['data']['records'] as $list)
		{?>
			<option <?=(strcmp(get_option('mailflatrate-sync-fieldlastname'),$list['tag'])==0)?"selected='selected'":""; ?> value="<?php echo $list['tag']; ?>"><?php echo $list['label']; ?></option>
		<?php }?>
                        </select><br>
                         <div class="errors lastnameError"></div>
                         </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" id="btn_sync" name="btn_sync" class="button button-primary" value="Save"/>
                        </td>
                    </tr>
                </tbody>
                
    </table>
        </div>
        
</div>
        </div>
	<?php echo '</form>';
	echo '</div>';
	echo '</div>';
}
function mailflatrateExportfunction()
{
	echo '<div class="wrap mfr-settings">';
	echo '<p class="breadcrumbs">
			<span class="prefix">'.__('You are here','mailflatarte-for-wp').': </span>
			<span class="current-crumb"><strong>'.__('Export mailflatrate','mailflatrate-for-wp').'</strong></span>
		  </p>';
	echo '<div class="row">';
	echo '<div class="main-content col col-4">';
	echo '<img src="'.plugins_url( 'mailflatrate/assets/img/mfr-rocket-logo.png' ).'" alt="MFR Logo" class="img-responsive logo mfr-luc-logo">';
	
	echo '<div class="clear"></div>';
	echo '<form method="post" action="options.php"> ';
	settings_fields( 'mailflatrate-plugin-setting-group' );
    do_settings_sections( 'mailflatrate-plugin-setting-group' ); 
	echo '<h3>'.__('Mailflatrate Export','mailflatrate-for-wp').'</h3>';
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$status='<span class="not_connected">'.__('Not connected','mailflatrate-for-wp').'</span>';
	if(strcmp($mailflatratePublicKey,'')!=0 && strcmp($mailflatratePrivateKey,'')!=0)
	{
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = 1, $perPage = 1);
		if(!isset($response->body['error']))
		{
			$status='<span class="connected">'.__('Connected','mailflatrate-for-wp').'</span>';
		}
		else
		{
			$status='<span class="not_connected">'.$response->body['error'].'</span>';
		}
	}
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = -1, $perPage = 20000);
		?>
	<div class="mailflatrate-import-container">
    <table class="form-table">
        <tr valign="top">
        	<th scope="row"><?php echo __('Status','mailflatrate-for-wp'); ?></th>
        	<td><?=$status;?></td>
        </tr>
        <tr valign="top">
        	<th scope="row"><?=__('Mailflatrate list'); ?></th>
            <td>
            <?php 
			if(isset($response->body['data']['records']))
				{
					if(count($response->body['data']['records']) > 0)
					{?>
                    <select id="mailflatrate-list-export" name="mailflatrate-list-export">
                        <option value="0">Please select list</option>
                        <?php 
                        foreach($response->body['data']['records'] as $list)
                        {?>
                            <option value="<?=$list['general']['list_uid']; ?>"><?=$list['general']['name']; ?></option>
                        <?php }?>
    				</select>
                	<?php }
				} ?>
            </td>
        </tr>
       </table>
       <div class="customerFieldSelect grid">
       <table class="form-table">
       			<thead>
                    <tr valign="top">
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__('Field name');?></strong></td>
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__( 'Mailflatrate Field');?></strong></td>
                    </tr>
                </thead>
                <tbody>
                	<tr valign="top">
                    	<td scope="row"><strong><?=__('Export from');?></strong></td>
                        <td scope="row">
                        	<select id="sel_import_into" name="sel_import_into">
                            	<option value="wordpress_users" selected>Wordpress users</option>
                               <?php if ( class_exists( 'WooCommerce' ) ) {?>
                                <option value="woocommerce_customers">Woocommerce customers</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td  scope="row"><strong><?=__( 'Email *');?></strong></td>
                        <td  scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldEmail" name="fieldEmail" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                        <div class="errors emailError"></div>
                        </td>
                        
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'First Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldfirstname" name="fieldfirstname" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                         <div class="errors firstnameError"></div></td>
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'Last Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldlastname" name="fieldlastname" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                         <div class="errors lastnameError"></div>
                         </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" id="btn_export" name="btn_export" class="button button-primary" value="Export"/>
                        </td>
                    </tr>
                </tbody>
                
    </table>
    </div>
    </div>
    <div class="clearfix"></div>
 		<div class="progressBarData">
        	<div class="progressbar"><div class="progress"></div></div>
            <span class="progressMsg"></span>
        </div>
        
    <?php
	echo '</form>';
	echo '</div>';
	echo '</div>';
}
function mailflatrateImportfunction()
{
	echo '<div class="wrap mfr-settings">';
	echo '<p class="breadcrumbs">

			<span class="prefix">'.__('You are here','mailflatarte-for-wp').': </span>

			<span class="current-crumb"><strong>'.__('Import mailflatrate','mailflatrate-for-wp').'</strong></span>
		  </p>';
	echo '<div class="row">';

	echo '<div class="main-content col col-4">';
	echo '<img src="'.plugins_url( 'mailflatrate/assets/img/mfr-rocket-logo.png' ).'" alt="MFR Logo" class="img-responsive logo mfr-luc-logo">';
	
	echo '<div class="clear"></div>';
	echo '<form method="post" action="options.php"> ';
	settings_fields( 'mailflatrate-plugin-setting-group' );
    do_settings_sections( 'mailflatrate-plugin-setting-group' ); 
	echo '<h3>'.__('Mailflatrate Import','mailflatrate-for-wp').'</h3>';
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$status='<span class="not_connected">'.__('Not connected','mailflatrate-for-wp').'</span>';
	if(strcmp($mailflatratePublicKey,'')!=0 && strcmp($mailflatratePrivateKey,'')!=0)
	{
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = 1, $perPage = 1);
		if(!isset($response->body['error']))
		{
			$status='<span class="connected">'.__('Connected','mailflatrate-for-wp').'</span>';
		}
		else
		{
			$status='<span class="not_connected">'.$response->body['error'].'</span>';
		}
	}
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = -1, $perPage = 20000);
	?>
    <div class="mailflatrate-import-container">
    <table class="form-table">
        <tr valign="top">
        	<th scope="row"><?php echo __('Status','mailflatrate-for-wp'); ?></th>
        	<td><?=$status;?></td>
        </tr>
        <tr valign="top">
        	<th scope="row"><?=__('Mailflatrate list'); ?></th>
            <td>
            <?php 
			if(isset($response->body['data']['records']))
				{
					if(count($response->body['data']['records']) > 0)
					{?>
                    <select id="mailflatrate-list-import" name="mailflatrate-list-import">
                        <option value="0">Please select list</option>
                        <?php 
                        foreach($response->body['data']['records'] as $list)
                        {?>
                            <option value="<?=$list['general']['list_uid']; ?>"><?=$list['general']['name']; ?></option>
                        <?php }?>
    				</select>
                	<?php }
				} ?>
            </td>
        </tr>
       </table>
       <div class="customerFieldSelect grid">
       <table class="form-table">
       			<thead>
                    <tr valign="top">
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__('Field name');?></strong></td>
                        <td  scope="row" class="data-grid-multicheck-cell"><strong><?=__( 'Mailflatrate Field');?></strong></td>
                    </tr>
                </thead>
                <tbody>
                	<tr valign="top">
                    	<td scope="row"><strong><?=__('Import into');?></strong></td>
                        <td scope="row">
                        	<select id="sel_import_into" name="sel_import_into">
                            	<option value="wordpress_users" selected>Wordpress users</option>
                               <?php if ( class_exists( 'WooCommerce' ) ) {?>
                                <option value="woocommerce_customers">Woocommerce customers</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td  scope="row"><strong><?=__( 'Email *');?></strong></td>
                        <td  scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldEmail" name="fieldEmail" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                        <div class="errors emailError"></div>
                        </td>
                        
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'First Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldfirstname" name="fieldfirstname" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                         <div class="errors firstnameError"></div></td>
                    </tr>
                    <tr valign="top">
                        <td scope="row"><strong><?=__( 'Last Name *');?></strong></td>
                        <td scope="row"><select class="admin__control-select mailflatrate-fields" id="fieldlastname" name="fieldlastname" required><option value="0"><?=__( 'Select mailflatrate field');?></option></select><br>
                         <div class="errors lastnameError"></div>
                         </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" id="btn_import" name="btn_import" class="button button-primary" value="Import"/>
                        </td>
                    </tr>
                </tbody>
                
    </table>
    </div>
    </div>
    <div class="clearfix"></div>
 		<div class="progressBarData">
        	<div class="progressbar"><div class="progress"></div></div>
            <span class="progressMsg"></span>
        </div>
        
    <?php
	echo '</form>';
	echo '</div>';
	echo '</div>';	
}
function mailflatrateOptionCallBackfunction_page()
{	
	echo '<div class="wrap mfr-settings">';	
	echo '<p class="breadcrumbs">
			<span class="prefix">'.__('You are here','mailflatarte-for-wp').': </span>
			<span class="current-crumb"><strong>'.__('Mailflatrate for WordPress','mailflatrate-for-wp').'</strong></span>
		  </p>';
	echo '<div class="row">';
	echo '<div class="main-content col col-4">';
	echo '<img src="'.plugins_url( 'mailflatrate/assets/img/mfr-rocket-logo.png' ).'" alt="MFR Logo" class="img-responsive logo mfr-luc-logo">';
	echo '<h1 class="page-title">'.__('General Settings','mailflatarte-for-wp').'</h1>';
	echo '<div class="clear"></div>';
	echo '<form method="post" action="options.php"> ';
	settings_fields( 'mailflatrate-plugin-setting-group' );
    do_settings_sections( 'mailflatrate-plugin-setting-group' ); 
	echo '<h3>'.__('Mailflatrate API Settings','mailflatrate-for-wp').'</h3>';
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$status='<span class="not_connected">'.__('Not connected','mailflatrate-for-wp').'</span>';
	if(strcmp($mailflatratePublicKey,'')!=0 && strcmp($mailflatratePrivateKey,'')!=0)
	{
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		$response=$endpoint->getLists($pageNumber = 1, $perPage = 1);
		if(!isset($response->body['error']))
		{
			$status='<span class="connected">'.__('Connected','mailflatrate-for-wp').'</span>';
		}
		else
		{
			$status='<span class="not_connected">'.$response->body['error'].'</span>';
		}
	}
	?>
		<table class="form-table">
        <tr valign="top">
        <th scope="row"><?php echo __('Status','mailflatrate-for-wp'); ?></th>
        <td><?=$status;?></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php echo __('Public key','mailflatrate-for-wp'); ?></th>
        <td><input type="text" class="widefat" placeholder="Your Mailflatrate Public key" name="mailflatrate_public_key" value="<?php echo esc_attr( get_option('mailflatrate_public_key') ); ?>" /></td>

        </tr>

        

        <tr valign="top">

        <th scope="row"><?php echo __('Private key','mailflatrate-for-wp'); ?></th>

        <td><input type="text" class="widefat" placeholder="Your Mailflatrate Private key" name="mailflatrate_private_key" value="<?php echo esc_attr( get_option('mailflatrate_private_key') ); ?>" /></td>

        </tr>

    </table><?php

	submit_button();

	echo '</form>';

	echo '</div>';

	echo '</div>'; 

	echo '</div>';

}

function mailflatrateOptionFormfunction()

{

	$tabs = array(

    	'fields' => __('Fields', 'mailflatrate-for-wp'),

    	'messages' => __('Messages', 'mailflatrate-for-wp')

	);

	$tabs = apply_filters('mailflatrate_admin_edit_form_tabs', $tabs);

	$active_tab='fields';
	
	echo '<div class="wrap mfr-settings">';	

	echo '<p class="breadcrumbs">

			<span class="prefix">'.__('You are here','mailflatrate-for-wp').': </span>

			<span class="current-crumb"><strong>'.__('Mailflatrate for WordPress','mailflatrate-for-wp').'</strong></span>

		  </p>';
	
	echo '<div class="row">';

	echo '<div class="main-content col col-4">';
	
	echo '<img src="'.plugins_url( 'mailflatrate/assets/img/mfr-rocket-logo.png' ).'" alt="MFR Logo" class="img-responsive logo mfr-luc-logo">';
	
	echo '<h1 class="page-title">'.__('Form','mailflatrate-for-wp').'</h1>';
	echo '<div class="clear"></div>';
	echo '<div id="titlediv" class="small-margin">

           <div>

                        '.__('Use the shortcode','mailflatrate-for-wp').' <input type="text" onfocus="this.select();" readonly="readonly" value="[mailflatrate_form]" size="19">'.__('to display this form inside a post, page or text widget.','mailflatrate-for-wp').'                    </div>

                </div>';?>

					 <h2 class="nav-tab-wrapper" id="mailflatrate-tabs-nav">

                        <?php foreach ($tabs as $tab => $name) {

                            $class = ($active_tab === $tab) ? 'nav-tab-active' : '';

                            echo sprintf('<a class="nav-tab nav-tab-%s %s" href="#tab-%s">%s</a>', $tab, $class, $tab, $name);

                        } ?>

                    </h2>

                    <div class="mailflatrate-tabs">

                    

                        <?php 

						

						foreach ($tabs as $tab => $name) :



                            $class = ($active_tab === $tab) ? 'tab-active' : '';

                            echo sprintf('<div class="tab %s" id="tab-%s">', $class, $tab);

                            $tab_file = dirname(__FILE__) . '/tabs/form-' . $tab . '.php';

                            if (file_exists($tab_file)) {

								require_once($tab_file);

                            }

                            echo '</div>';

                        endforeach; // foreach tabs ?>

                    </div>

					<?php

	echo '</div>';

	echo '</div>';

	echo '</div>';

	

}



function mailflatrateOptionOtherfunction()

{

	

}
add_action( 'wp_ajax_exportMailflatrateListRecords', 'exportMailflatrateListRecords' );

add_action( 'wp_ajax_nopriv_exportMailflatrateListRecords', 'exportMailflatrateListRecords' );

function exportMailflatrateListRecords()
{
		$user_count_data = count_users();
		$totalCustomerCount=0;
		$mailflatratePublicKey=get_option('mailflatrate_public_key');
		$mailflatratePrivateKey=get_option('mailflatrate_private_key');
		$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey
		));
		$checkConfig=MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
		$listUid = $_POST['list_uid'];
		$pageNo = $_POST['pageno'];
		$emailField = $_POST['emailField'];
		$firstNameField = $_POST['firstNameField'];
		$lastNameField = $_POST['lastNameField'];
		$importInto = $_POST['importInto'];
		if(strcmp($importInto,'wordpress_users')==0)
		{
			$blogusers = get_users(['role__in' => ['subscriber'],'number'=>$pageNo,'offset'=>$pageNo]);
			$totalCustomerCount = (isset($user_count_data['avail_roles']['subscriber']))?$user_count_data['avail_roles']['subscriber']:0;
			foreach($blogusers as $user)
			{
				$queryArray=[$emailField=>$user->data->user_email,$firstNameField=>$user->data->user_nicename,$lastNameField=>$user->data->display_name,'DATENSCHUTZ'=>1];
				try {
                    $msg = '';
                    $existOrNot=$endpoint->emailSearch($listUid, $queryArray[$emailField]);
                    $existOrNot   = $existOrNot->body;
                if ($existOrNot->itemAt('status') == 'success') {
                    $data=$existOrNot->itemAt('data');
                    $subscribeId = $data['subscriber_uid'];
                    $response=$endpoint->update($listUid, $subscribeId, $queryArray);
                    $response   = $response->body;
                    if ($response->itemAt('status') == 'success') {
                            $msg='Customer export to mailflatrate server successfully!';
                    } else {
                        if (!is_array($response->itemAt('error'))) {
                            $msg=$response->itemAt('error');
                        } else {
                            foreach (($response->itemAt('error')) as $value) {
                                      $msg.=$value."<br>";
                            }
                        }
                    }
                } else {
                    $response   = $endpoint->create($listUid, $queryArray);
                    $response   = $response->body;
                    if ($response->itemAt('status') == 'success') {
                            $msg='Customer export to mailflatrate server successfully!';
                    } else {
                        if (!is_array($response->itemAt('error'))) {
                            $msg=$response->itemAt('error');
                        } else {
                            foreach (($response->itemAt('error')) as $value) {
                                      $msg.=$value."<br>";
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                 
            }
			
			}
		}
		else
		{
			$blogusers = get_users(['role__in' => ['customer'],'number'=>$pageNo,'offset'=>$pageNo]);
			$totalCustomerCount = (isset($user_count_data['avail_roles']['customer']))?$user_count_data['avail_roles']['customer']:0;
			
			
			foreach($blogusers as $user)
			{
				$queryArray=[$emailField=>$user->data->user_email,$firstNameField=>$user->data->user_nicename,$lastNameField=>$user->data->display_name,'DATENSCHUTZ'=>1];
				try {
                    $msg = '';
                    $existOrNot=$endpoint->emailSearch($listUid, $queryArray[$emailField]);
                    $existOrNot   = $existOrNot->body;
                if ($existOrNot->itemAt('status') == 'success') {
                    $data=$existOrNot->itemAt('data');
                    $subscribeId = $data['subscriber_uid'];
                    $response=$endpoint->update($listUid, $subscribeId, $queryArray);
                    $response   = $response->body;
                    if ($response->itemAt('status') == 'success') {
                            $msg='Customer export to mailflatrate server successfully!';
                    } else {
                        if (!is_array($response->itemAt('error'))) {
                            $msg=$response->itemAt('error');
                        } else {
                            foreach (($response->itemAt('error')) as $value) {
                                      $msg.=$value."<br>";
                            }
                        }
                    }
                } else {
                    $response   = $endpoint->create($listUid, $queryArray);
                    $response   = $response->body;
                    if ($response->itemAt('status') == 'success') {
                            $msg='Customer export to mailflatrate server successfully!';
                    } else {
                        if (!is_array($response->itemAt('error'))) {
                            $msg=$response->itemAt('error');
                        } else {
                            foreach (($response->itemAt('error')) as $value) {
                                      $msg.=$value."<br>";
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                 
            }
			}
		}
		if(isset($_POST['totalPages']))
		{
			$totalCustomerCount=$_POST['totalPages'];
		}
		if ((int)$pageNo  >= $totalCustomerCount) {
            $percentages=100;
        } else {
            $percentages = number_format((((int)$pageNo)*100)/$totalCustomerCount, 2);
        }
		 echo json_encode(['percentages'=>$percentages,'success'=>true,'error'=>false,'msg'=>$msg,'total_pages'=>$totalCustomerCount,'current_page'=>$pageNo,'next_page'=>(++$pageNo)]);
		 die;
}
add_action( 'wp_ajax_importMailflatrateListRecords', 'importMailflatrateListRecords' );

add_action( 'wp_ajax_nopriv_importMailflatrateListRecords', 'importMailflatrateListRecords' );

function importMailflatrateListRecords()
{
	$mailflatratePublicKey=get_option('mailflatrate_public_key');
	$mailflatratePrivateKey=get_option('mailflatrate_private_key');
	$config = new MailWizzApi_Config(array(
    		'apiUrl'        => 'https://app.mailflatrate.com/api/',
    		'publicKey'     => $mailflatratePublicKey,
    		'privateKey'    => $mailflatratePrivateKey,
		));
	$checkConfig=MailWizzApi_Base::setConfig($config);
	$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
	
		$listUid = $_POST['list_uid'];
		$pageNo = $_POST['pageno'];
		$emailField = $_POST['emailField'];
		$firstNameField = $_POST['firstNameField'];
		$lastNameField = $_POST['lastNameField'];
		$importInto = $_POST['importInto'];
		$response = $endpoint->getSubscribers($listUid,$pageNo);
		if (!isset($response->body['error'])) {
			if((int)$response->body['data']['current_page']  == $response->body['data']['count'])
			{
				$percentages=100;
			}
			else
			{
				$percentages = number_format((((int)$response->body['data']['current_page'])*100)/$response->body['data']['total_pages'],2);
			}
			foreach($response->body['data']['records'] as $record)
			{
				if(strcmp($importInto,'wordpress_users')==0)
				{
					$user = get_user_by('email',$record[$emailField]);
					if($user)
					{
						$userId = $user->ID;
						$userData = array('ID'=>$userId,'display_name'=>$record[$firstNameField].' '.$record[$lastNameField],'first_name'=>$record[$firstNameField],'last_name'=>$record[$lastNameField]);
						$user_id = wp_update_user($userData);
						if ( ! is_wp_error( $user_id ) ) {
							
						}
					}
					else
					{
						$userData = array('display_name'=>$record[$firstNameField].' '.$record[$lastNameField],'first_name'=>$record[$firstNameField],'last_name'=>$record[$lastNameField],'user_login'=>$record[$emailField],'user_email'=>$record[$emailField]);
						$user_id = wp_insert_user($userData);
						if ( ! is_wp_error( $user_id ) ) {
							
						}
					}
				}
				else
				{ 
					$user = get_user_by('email',$record[$emailField]);
					if(!$user)
					{
						$user_id = wc_create_new_customer($record[$emailField], $record[$emailField]);
						update_user_meta( $user_id, "billing_first_name", $record[$firstNameField] );
						update_user_meta( $user_id, "billing_last_name", $record[$lastNameField] );
						update_user_meta( $user_id, "display_name", $record[$firstNameField].' '.$record[$lastNameField] );
						update_user_meta( $user_id, "first_name", $record[$firstNameField] );
						update_user_meta( $user_id, "last_name", $record[$lastNameField] );
					}
					else
					{
						$userId = $user->ID;
						$userData = array('ID'=>$userId,'display_name'=>$record[$firstNameField].' '.$record[$lastNameField],'first_name'=>$record[$firstNameField],'last_name'=>$record[$lastNameField]);
						$user_id = wp_update_user($userData);
						if ( ! is_wp_error( $user_id ) ) {
							update_user_meta( $user_id, "billing_first_name", $record[$firstNameField] );
							update_user_meta( $user_id, "billing_last_name", $record[$lastNameField] );
						}
					}
				}
			}
		}
		echo json_encode(['percentages'=>$percentages,'success'=>true,'error'=>false,'records'=>$response->body['data']['records'],'count'=>$response->body['data']['count'],'total_pages'=>$response->body['data']['total_pages'],'current_page'=>$response->body['data']['current_page'],'next_page'=>$response->body['data']['current_page']]);
	die;
}

add_action( 'wp_ajax_getListData', 'getListData' );

add_action( 'wp_ajax_nopriv_getListData', 'getListData' );

function getListData()

{

	$mailflatratePublicKey=get_option('mailflatrate_public_key');

	$mailflatratePrivateKey=get_option('mailflatrate_private_key');

	$config = new MailWizzApi_Config(array(

    		'apiUrl'        => 'https://app.mailflatrate.com/api/',

    		'publicKey'     => $mailflatratePublicKey,

    		'privateKey'    => $mailflatratePrivateKey,


		));

		$checkConfig=MailWizzApi_Base::setConfig($config);

		$endpoint = new MailWizzApi_Endpoint_ListFields();

		$response=$endpoint->getFields($_POST['list_uid']);
		
		$arrayrecords=array();
		foreach($response->body['data']['records'] as $record)
		{
			
			$record['label']=__($record['label'],'mailflatrate-for-wp');
			array_push($arrayrecords,$record);
		}
		
		if(count($arrayrecords) > 0)
		{
			echo json_encode(array('data'=>$arrayrecords,'msg'=>'found')); 
		}

		else

		{

			echo json_encode(array('data'=>array(),'msg'=>'not found'));

		}

		die;

}

add_action( 'plugins_loaded', 'mailflatrate_load_plugin', 8 );

function mailflatrate_form(){
	if(! wp_script_is( 'jquery' ) ) { wp_enqueue_script( 'jquery' ); }	
		
	wp_register_script('mailflatrate_wp_admin_frontend',MFR_PLUGIN_URL.'assets/js/frontend.js',array(),MFR_VERSION);

	wp_register_style('mailflatrate_wp_admin_frontend_css',MFR_PLUGIN_URL.'assets/css/frontend.css',array(),MFR_VERSION);

	wp_enqueue_script( 'mailflatrate_wp_admin_frontend' );

	wp_enqueue_style( 'mailflatrate_wp_admin_frontend_css' );

	wp_localize_script( 'mailflatrate_wp_admin_frontend', 'ajax_object',

         array( 'ajax_url' => admin_url( 'admin-ajax.php'),

		 		'plugin_url'=> MFR_PLUGIN_URL ) );
	$html='';
	$html.='<div class="mailflatrate-form">';

	$html.='<div id="overlay"></div>';

	$html.='<div class="messagebox"></div>'; 

	$html.= '<form id="mailflatrate-form-submit">';
	
	$html.='<input type="hidden" id="mailflatrate-terms-agree-color" name="mailflatrate-terms-agree-color" value="'.get_option('mailflatrate-agree_to_terms-color').'">';
	
	$html.='<input type="hidden" id="mailflatrate-terms-agree" name="mailflatrate-terms-agree" value="'.__(get_option('mailflatrate-agree_to_terms'),'mailflatrate-for-wp').'">';
	
	$html.= get_option('mailflatrate_form_code');

	$html.= '</form>';

	$html.= '</div>';

	return $html;

}

add_shortcode( 'mailflatrate_form', 'mailflatrate_form' );

add_action( 'wp_ajax_mailflatrate-subscribe-form', 'mailflatrate_subscribe_form' );

add_action( 'wp_ajax_nopriv_mailflatrate-subscribe-form', 'mailflatrate_subscribe_form' );

function mailflatrate_subscribe_form()

{

	$mailflatratePublicKey=get_option('mailflatrate_public_key');

	$mailflatratePrivateKey=get_option('mailflatrate_private_key');

	$config = new MailWizzApi_Config(array(

    		'apiUrl'        => 'https://app.mailflatrate.com/api/',

    		'publicKey'     => $mailflatratePublicKey,

    		'privateKey'    => $mailflatratePrivateKey,


		));

	$checkConfig=MailWizzApi_Base::setConfig($config);

	$listUid    = get_option('mailflatrate-list');

	$endpoint   = new MailWizzApi_Endpoint_ListSubscribers();

	$queryArray=array();
	
	foreach($_POST as $key => $value)

	{

		if(strcmp($key,'action')!=0)

		{

			$queryArray[$key]=$value;

		}

	}

	$response   = $endpoint->create($listUid,$queryArray);

	$response   = $response->body;

	if ($response->itemAt('status') == 'success') {

        exit(MailWizzApi_Json::encode(array(

            'status'    => 'success',

            'message'   => __(get_option('mailflatrate-successfully-subscribeed'),'mailflatrate-for-wp'),
			
			'color' => get_option('mailflatrate-successfully-subscribeed-color')
			

        )));

    }

	else

	{
		if(!is_array($response->itemAt('error')))

		{

		if(strcmp($response->itemAt('error'),'The subscriber already exists in this list.')==0)

		{

			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => __(get_option('mailflatate_already_subscribed'),'mailflatrate-for-wp'),
				
				'color' => get_option('mailflatate_already_subscribed-color')
 
    		)));

		}
		else if(strcmp($response->itemAt('error'),'Please provide the subscriber email address.')==0)
		{
			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => __(get_option('missing-email-address'),'mailflatrate-for-wp'),
		 		
				'color' => get_option('missing-email-address-color')

    		)));
		}
		else if(strcmp($response->itemAt('error'),'Please provide a valid email address.')==0)

		{

			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => __(get_option('mailflatrate-invalid-email-address'),'mailflatrate-for-wp'),
		 		
				'color' => get_option('mailflatrate-invalid-email-address-color')

    		)));

		}
		else if((strpos($response->itemAt('error'), 'DATENSCHUTZ')))
		{
			
			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => __(get_option('data-protection'),'mailflatrate-for-wp'),
		 		
				'color' => get_option('data-protection-color')

    		)));
		}
		else

		{
			
			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => $response->itemAt('error')

    		)));

		}

		}

		else

		{
			
			$htmlerror='';

			foreach(($response->itemAt('error')) as $value)

			{
				if((strpos($value, 'DATENSCHUTZ')))
			{
			
			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => __(get_option('data-protection'),'mailflatrate-for-wp'),
		 		
				'color' => get_option('data-protection-color')

    		)));
			}
			else
			{
				$htmlerror.=$value."<br>";
			}
			}

			exit(MailWizzApi_Json::encode(array(

        		'status'    => 'error',

        		'message'   => $htmlerror

    		)));

		}

	}

	/*exit(MailWizzApi_Json::encode(array(

        'status'    => 'error',

        'message'   => $response->itemAt('error')

    )));*/

}
add_action( 'user_register', 'update_extra_profile_fields_register', 10, 1 );
add_action('edit_user_profile_update', 'update_extra_profile_fields');
 add_action('personal_options_update', 'update_extra_profile_fields');
 function update_extra_profile_fields_register($user_id) {
			
			$mailflatrate_sync = get_option('mailflatrate_sync_status_text');
			$mailflatrate_sync = (strcmp($mailflatrate_sync,'')!=0)?$mailflatrate_sync:'off';
			
			if(strcmp($mailflatrate_sync,'on')==0)
			{
				
			$mailflatratePublicKey=get_option('mailflatrate_public_key');
			$mailflatratePrivateKey=get_option('mailflatrate_private_key');
			
			$config = new MailWizzApi_Config(array(
					'apiUrl'        => 'https://app.mailflatrate.com/api/',
					'publicKey'     => $mailflatratePublicKey,
					'privateKey'    => $mailflatratePrivateKey
				));
			
			$checkConfig=MailWizzApi_Base::setConfig($config);
			$mailflatrateListUid=get_option('mailflatrate-sync-list-export');
			$mailflatrate_sync_email=get_option('mailflatrate-sync-fieldEmail');
			$mailflatrate_sync_firstname=get_option('mailflatrate-sync-fieldfirstname');
			$mailflatrate_sync_lastname=get_option('mailflatrate-sync-fieldlastname');
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
				$user = get_user_by('ID',$user_id);
			if($user)
			{
				$email = $_POST['user_email'];
				$firstname = isset($_POST['first_name'])?$_POST['first_name']:'';
				$lastname = isset($_POST['last_name'])?$_POST['last_name']:'';
				$queryArray=[$mailflatrate_sync_email=>$email,$mailflatrate_sync_firstname=>$firstname,$mailflatrate_sync_lastname=>$lastname,'DATENSCHUTZ'=>1]; 
				
				if (strcmp($mailflatrateListUid, '')!=0) {
					try {
                            $msg = '';
							
                            $existOrNot=$endpoint->emailSearch($mailflatrateListUid, $email);
                            $existOrNot   = $existOrNot->body;
                    if ($existOrNot->itemAt('status') == 'success') {
                        $data=$existOrNot->itemAt('data');
                        $subscribeId = $data['subscriber_uid'];
                        $response=$endpoint->update($mailflatrateListUid, $subscribeId, $queryArray);
                        $response   = $response->body;
                        if ($response->itemAt('status') == 'success') {
							
                        } else {
                            if (!is_array($response->itemAt('error'))) {
                                $msg=$response->itemAt('error');
                            } else {
                                foreach (($response->itemAt('error')) as $value) {
                                    $msg.=$value."<br>";
                                }
                            }
                             
                        }
                    } else {
                        $response   = $endpoint->create($mailflatrateListUid, $queryArray);
                        $response   = $response->body;
                        if ($response->itemAt('status') == 'success') {
                                
                        } else {
                            if (!is_array($response->itemAt('error'))) {
                                $msg=$response->itemAt('error');
                            } else {
                                foreach (($response->itemAt('error')) as $value) {
                                           $msg.=$value."<br>";
                                }
                            }
                            
                        }
                    }
                }
					catch (Exception $e) {
                     
               		} 
				}
				else
				{
					
				}
			
			}
			}
 }
 function update_extra_profile_fields($user_id) {
	
     if ( current_user_can('edit_user',$user_id) )
	 {
			$mailflatrate_sync = ( get_option('mailflatrate_sync_status_text') );
			$mailflatrate_sync = (strcmp($mailflatrate_sync,'')!=0)?$mailflatrate_sync:'off';
			if(strcmp($mailflatrate_sync,'on')==0)
			{
			$mailflatratePublicKey=get_option('mailflatrate_public_key');
			$mailflatratePrivateKey=get_option('mailflatrate_private_key');
			$config = new MailWizzApi_Config(array(
					'apiUrl'        => 'https://app.mailflatrate.com/api/',
					'publicKey'     => $mailflatratePublicKey,
					'privateKey'    => $mailflatratePrivateKey,
				));
		
			$checkConfig=MailWizzApi_Base::setConfig($config);
			$mailflatrateListUid=get_option('mailflatrate-sync-list-export');
			$mailflatrate_sync_email=get_option('mailflatrate-sync-fieldEmail');
			$mailflatrate_sync_firstname=get_option('mailflatrate-sync-fieldfirstname');
			$mailflatrate_sync_lastname=get_option('mailflatrate-sync-fieldlastname');
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
			$user = get_user_by('ID',$user_id);
			if($user)
			{
				$email = $_POST['email'];
				$firstname = $_POST['first_name'];
				$lastname = $_POST['last_name'];
				$queryArray=[$mailflatrate_sync_email=>$email,$mailflatrate_sync_firstname=>$firstname,$mailflatrate_sync_lastname=>$lastname,'DATENSCHUTZ'=>1]; 
				if (strcmp($mailflatrateListUid, '')!=0) {
					try {
                            $msg = '';
                            $existOrNot=$endpoint->emailSearch($mailflatrateListUid, $email);
                            $existOrNot   = $existOrNot->body;
                    if ($existOrNot->itemAt('status') == 'success') {
                        $data=$existOrNot->itemAt('data');
                        $subscribeId = $data['subscriber_uid'];
                        $response=$endpoint->update($mailflatrateListUid, $subscribeId, $queryArray);
                        $response   = $response->body;
                        if ($response->itemAt('status') == 'success') {
							
                        } else {
                            if (!is_array($response->itemAt('error'))) {
                                $msg=$response->itemAt('error');
                            } else {
                                foreach (($response->itemAt('error')) as $value) {
                                    $msg.=$value."<br>";
                                }
                            }
                             
                        }
                    } else {
                        $response   = $endpoint->create($mailflatrateListUid, $queryArray);
                        $response   = $response->body;
                        if ($response->itemAt('status') == 'success') {
                                 
                        } else {
                            if (!is_array($response->itemAt('error'))) {
                                $msg=$response->itemAt('error');
                            } else {
                                foreach (($response->itemAt('error')) as $value) {
                                           $msg.=$value."<br>";
                                }
                            }
                            
                        }
                    }
                }
					catch (Exception $e) {
                     
               		} 
				}
				else
				{
					
				}
			}
			}
	}     
 }
 ?>
<?php
/*
Plugin Name: CT Dokan Custom Functions
Plugin URI: https://dinislambds.com/
Description: Custom Dokan Functions plugin by <a href="//CreatifyTech.com/">Creatify Tech</a> for jeengin.com | Added more features with extra functionalities for Dokan multivendor plugin. Author
Version: 1.1
Author: Creatify Tech (Md Din Islam)
Author URI: https://CreatifyTech.com/
License: GPLv2 or later
Text Domain: ct-custom-functions
Domain Path: /languages/
*/



/**
 * "Where can we find you?" Extra field in the Registration form
*/

add_action( 'dokan_seller_registration_field_after', 'creatify_tech_whoru_dokan_reg_form_field' );

function creatify_tech_whoru_dokan_reg_form_field(){
    ?>
    <p class="form-row form-group form-row-wide">
        <label for="seller-whoru"><?php _e( 'Where can we find you?', 'dokan' ); ?></label>
        <input type="text" id="seller-whoru" name="seller_whoru" class="input-text form-control" maxlength="50" />
    </p>
    <?php
}


/**
 * Show Extra field on the Vendor store setting page
*/

add_filter( 'dokan_settings_form_bottom', 'creatify_tech_extra_fields_store_setting', 10, 2);

function creatify_tech_extra_fields_store_setting( $current_user, $profile_info ){
$seller_whoru= isset( $profile_info['seller_whoru'] ) ? $profile_info['seller_whoru'] : '';
?>
<div class="dokan-form-group">
        <label class="dokan-w3 dokan-control-label" for="seller_address">
            <?php _e( 'Where can we find you?', 'dokan' ); ?>
        </label>

        <div class="dokan-w6">
            <div class="dokan-form-group">
                <input type="text" placeholder="Tell us about you" class="dokan-form-control input-md valid" name="seller_whoru" maxlength="50" id="reg_seller_whoru" value="<?php echo $seller_whoru; ?>" />
            </div>
        </div>
</div>
    <?php
}


/**
 * Save the Extra field value in Vendor store setting page
*/

add_action( 'dokan_new_seller_created', 'creatify_tech_save_extra_fields', 15 );
add_action( 'dokan_store_profile_saved', 'creatify_tech_save_extra_fields', 15 );

function creatify_tech_save_extra_fields( $store_id ) {
    $dokan_settings = dokan_get_store_info($store_id);
    if ( isset( $_POST['seller_whoru'] ) ) {
        $dokan_settings['seller_whoru'] = $_POST['seller_whoru'];
    }
 update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}


/**
 * Adding field value in backend admin user profile area
*/ 

add_action( 'dokan_seller_meta_fields', 'creatify_tech_extra_fields_profile', 10 );
add_action( 'dokan_process_seller_meta_fields', 'creatify_tech_extra_fields_profile', 10 );
function creatify_tech_extra_fields_profile($user){
    
$store_settings        = dokan_get_store_info( $user->ID );

?>
     <tr>
        <th><?php esc_html_e( 'Where?', 'dokan-lite' ); ?></th>
        <td>
            <input type="text" name="seller_whoru" class="regular-text" value="<?php echo esc_attr( $store_settings['seller_whoru'] ); ?>">
        </td>
    </tr>
    
 <?php
}
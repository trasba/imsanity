<?php
/** 
 * ################################################################################
 * ADMIN/SETTINGS UI
 * ################################################################################
 */

function imsanity_create_menu() {

	//create new top-level menu
	add_options_page('Imsanity Plugin Settings', 'Imsanity', 'administrator', __FILE__, 'imsanity_settings_page');

	//call register settings function
	add_action( 'admin_init', 'imsanity_register_settings' );
}

function imsanity_register_settings() {
	//register our settings
	register_setting( 'imsanity-settings-group', 'imsanity_max_height' );
	register_setting( 'imsanity-settings-group', 'imsanity_max_width' );
	register_setting( 'imsanity-settings-group', 'imsanity_bmp_to_jpg' );
	register_setting( 'imsanity-settings-group', 'imsanity_quality' );
}

function imsanity_settings_page() {
?>
<style>
	#imsanity_header
	{
		border: solid 1px #c6c6c6;
		margin: 12px 2px 8px 2px;
		padding: 20px;
		background-color: #e1e1e1;
	}
	#imsanity_header h4
	{
		margin: 0px 0px 0px 0px;
	}
	#imsanity_header tr
	{
		vertical-align: top;
	}
	
	.imsanity_section_header
	{
		border: solid 1px #c6c6c6;
		margin: 12px 2px 8px 2px;
		padding: 20px;
		background-color: #e1e1e1;
	}
	
</style>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>Imsanity Settings</h2>

<div id="imsanity_header" style="float: left;">
	<a href="http://verysimple.com/products/imsanity/"><img alt="Imsanity" src="<?php echo plugins_url().'/imsanity/images/imsanity.png'; ?>" style="float: right; margin-left: 15px;"/></a>

	<h4>Imsanity automatically resizes insanely huge image uploads</h4>
	
	<p>The resolution of modern cameras is larger than necessary for typical web display.  
	In fact the average computer screen is not big enough to display a 3 megapixel camera-phone image at full resolution.
	WordPress does a good job of creating scaled-down copies which can be used, however the original images
	are permanently stored and the average contributor may not understand how to use the scaled images
	in their posts.  These images take up disk quota and, if used on a page, will use bandwidth and slow load times.</p>
	
	<p>Imsanity automaticaly reduces the size of images that are larger than the specified maximum and replaces the original
	with one of a more "sane" size.  Site contributors don't need to concern themselves with manually scaling images
	and can upload them directly from their camera or phone.</p>
	
	<p>This plugin is designed for sites where high-resolution images are not necessary and/or the site contributors
	do not want (or understand how) to deal with scaling their images.  This plugin should not be used on 
	sites for which original, high-resolution images must be stored.</p>
	
	<p>Beware - This is a destructive plugin!  Be sure to keep back-ups of your full-sized images.</p>
</div>

<br style="clear:both" />

<form method="post" action="options.php">

    <?php settings_fields( 'imsanity-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Maximum Image Width</th>
        <td><input type="text" style="width:40px;" name="imsanity_max_width" value="<?php echo get_option('imsanity_max_width',IMSANITY_DEFAULT_MAX_WIDTH); ?>" /> (Enter 0 to disable)</td>
        </tr>

        <tr valign="top">
        <th scope="row">Maximum Image Height</th>
        <td><input type="text" style="width:40px;" name="imsanity_max_height" value="<?php echo get_option('imsanity_max_height',IMSANITY_DEFAULT_MAX_HEIGHT); ?>" /> (Enter 0 to disable)</td>
        </tr>

        <tr valign="top">
        <th scope="row">JPG Image Quality</th>
        <td><select name="imsanity_quality">
        	<?php 
        	$q = get_option('imsanity_quality',IMSANITY_DEFAULT_QUALITY);
        	
        	for ($x = 10; $x <= 100; $x = $x + 10)
        	{
        		echo "<option". ($q == $x ? " selected='selected'" : "") .">$x</option>";
        	}
        	?>
        </select> (WordPress default is 90)</td>
        </tr>

        <tr valign="top">
        <th scope="row">Convert BMP To JPG</th>
        <td><select name="imsanity_bmp_to_jpg">
        	<option <?php if (get_option('imsanity_bmp_to_jpg',IMSANITY_DEFAULT_BMP_TO_JPG) == "1") {echo "selected='selected'";} ?> value="1">Yes</option>
        	<option <?php if (get_option('imsanity_bmp_to_jpg',IMSANITY_DEFAULT_BMP_TO_JPG) == "0") {echo "selected='selected'";} ?> value="0">No</option>
        </select></td>
        </tr>

        <tr valign="top">
        <th scope="row">Info</th>
        <td>
        	<div>Imsanity Version <?php echo IMSANITY_VERSION; ?></div>
        	<div>Imsanity designed and developed by <a href="http://verysimple.com/">Jason Hinkle</a></div>
        </td>
        </tr>

    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>

<?php 

}

?>
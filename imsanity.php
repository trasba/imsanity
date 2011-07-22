<?php
/**
 * @package Imsanity
 * @version 1.0.0
 */
/*
Plugin Name: Imsanity
Plugin URI: http://verysimple.com/products/imsanity/
Description: Imsanity stops insanely huge image uploads
Author: Jason Hinkle
Version: 1.0.0
Author URI: http://verysimple.com/
*/

define('IMSANITY_VERSION','1.0.0');
define('IMSANITY_DEFAULT_MAX_WIDTH',1024);
define('IMSANITY_DEFAULT_MAX_HEIGHT',1024);

/**
 * import supporting libraries
 */
include_once(plugin_dir_path(__FILE__).'settings.php');
include_once(plugin_dir_path(__FILE__).'libs/utils.php');

/**
 * Handler after a file has been uploaded.  If the file is an image, check the size
 * to see if it is too big and, if so, resize and overwrite the original
 * @param Array $params
 */
function imsanity_handle_upload($params) 
{
	$oldType = $params['type'];
	
	// debug logging...
	// file_put_contents ( "debug.txt" , print_r($params,1) . "\n" );
	
	if (in_array($oldType, array('image/png','image/gif','image/jpeg')))
	{
		$oldPath = $params['file'];
		
		$maxW = get_option('imsanity_max_width',IMSANITY_DEFAULT_MAX_WIDTH);
		$maxH = get_option('imsanity_max_height',IMSANITY_DEFAULT_MAX_HEIGHT);
		
		list($oldW, $oldH) = getimagesize( $oldPath );
		
		if (($oldW > $maxW && $maxW > 0) || ($oldH > $maxH && $maxH > 0))
		{
		
			list($newW, $newH) = wp_constrain_dimensions($oldW, $oldH, $maxW, $maxH);
			
			$newPath = image_resize( $oldPath, $newW, $newH);
			
			/** method 1 **/
			// remove original and replace with re-sized image
			// (this could be problematic for image types other than gif,png,jpg because wordpress will
			// convert all other types to jpg, which will make the original file extension incorrect)
			unlink($oldPath);
			rename($newPath, $oldPath);
			
			/** method 2 (TODO: more reliable, but not yet working) **/
			// remove original and use the new resized image as the post attachment 
			// (this leaves the post db record in an unknown state, though)
			// $pathParts = pathinfo($newPath);
			// $uploads = wp_upload_dir();
			// $params['type'] = 'image/' . $pathParts['extension'];
			// $params['file'] = $newPath;
			// $parmas['url'] = $uploads['url'] . '/' . $pathParts['basename'];
			// unlink($oldPath);
		}
		
	}
	
	return $params;
}

add_filter( 'wp_handle_upload', 'imsanity_handle_upload' );
add_action('admin_menu', 'imsanity_create_menu');

?>

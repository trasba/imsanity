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
Version: 1.0.2
Author URI: http://verysimple.com/
*/

define('IMSANITY_VERSION','1.0.2');
define('IMSANITY_DEFAULT_MAX_WIDTH',1024);
define('IMSANITY_DEFAULT_MAX_HEIGHT',1024);
define('IMSANITY_DEFAULT_BMP_TO_JPG',1);
define('IMSANITY_DEFAULT_QUALITY',90);

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
	/* debug logging... */
	// file_put_contents ( "debug.txt" , print_r($params,1) . "\n" );
	
	if ($params['type'] == 'image/bmp' && get_option('imsanity_bmp_to_jpg',IMSANITY_DEFAULT_BMP_TO_JPG))
	{
		$params = imsanity_bmp_to_jpg($params);
	}
	
	// make sure this is a type of image that we want to convert
	if ( (!is_wp_error($params)) && in_array($params['type'], array('image/png','image/gif','image/jpeg')))
	{
		$oldPath = $params['file'];
		
		$maxW = get_option('imsanity_max_width',IMSANITY_DEFAULT_MAX_WIDTH);
		$maxH = get_option('imsanity_max_height',IMSANITY_DEFAULT_MAX_HEIGHT);
		
		list($oldW, $oldH) = getimagesize( $oldPath );
		
		if (($oldW > $maxW && $maxW > 0) || ($oldH > $maxH && $maxH > 0))
		{
			$quality = get_option('imsanity_quality',IMSANITY_DEFAULT_QUALITY);
			
			list($newW, $newH) = wp_constrain_dimensions($oldW, $oldH, $maxW, $maxH);
			
			$resizeResult = image_resize( $oldPath, $newW, $newH, false, null, null, $quality);
			
			/* uncomment to debug error handling code: */
			// $resizeResult = new WP_Error('invalid_image', __('Could not read image size'), $oldPath);
			
			if (!is_wp_error($resizeResult))
			{
				$newPath = $resizeResult;

				// remove original and replace with re-sized image
				rename($newPath, $oldPath);
			}
			else
			{
				// resize didn't work, likely because the image processing libraries are missing
				unlink($oldPath);

				$params = wp_handle_upload_error( $oldPath , "Oh Snap! Imsanity was unable to resize this image "
					. "for the following reason: '" . $resizeResult->get_error_message() . "'
					.  If you continue to see this error message, you may need to either install missing server"
					. " components or disable the Imsanity plugin."
					. "  If you think you have discovered a bug, please report it on the Imsanity support forum." );
				
			}
		}
		
	}

	return $params;
}


/**
 * If the uploaded image is a bmp this function handles the details of converting
 * the bmp to a jpg, saves the new file and adjusts the params array as necessary
 * 
 * @param array $params
 */
function imsanity_bmp_to_jpg($params)
{

	// read in the bmp file and then save as a new jpg file.
	// if successful, remove the original bmp and alter the return
	// parameters to return the new jpg instead of the bmp
	
	include_once('libs/imagecreatefrombmp.php');
	
	$bmp = imagecreatefrombmp($params['file']);
	
	// we need to change the extension from .bmp to .jpg so we have to ensure it will be a unique filename
	$uploads = wp_upload_dir();
	$oldFileName = basename($params['file']);
	$newFileName = basename(str_ireplace(".bmp", ".jpg", $oldFileName));
	$newFileName = wp_unique_filename( $uploads['path'], $newFileName );
	
	$quality = get_option('imsanity_quality',IMSANITY_DEFAULT_QUALITY);
	
	// lazy way of saving the file with a unique name is just add .jpg to the end
	if (imagejpeg($bmp,$uploads['path'] . '/' . $newFileName, $quality))
	{
		// remove the original bmp
		unlink($params['file']);
		
		$params['file'] = $uploads['path'] . '/' . $newFileName;
		$params['url'] = $uploads['url'] . '/' . $newFileName;
		$params['type'] = 'image/jpeg';
	}
	else
	{
		unlink($params['file']);
		
		return wp_handle_upload_error( $oldPath, 
			"Oh Snap! Imsanity was Unable to process the BMP file.  "
			."If you continue to see this error you may need to disable the BMP-To-JPG "
			."feature in Imsanity settings.");
	}
	
	return $params;
}


add_filter( 'wp_handle_upload', 'imsanity_handle_upload' );
add_action('admin_menu', 'imsanity_create_menu');
// wp_update_attachment_metadata handler would allow updating the associated post

?>

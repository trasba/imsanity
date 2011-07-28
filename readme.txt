=== Plugin Name ===
Contributors: verysimple
Donate link: http://verysimple.com/products/imsanity/
Tags: imsanity, image, images, automatic scale, automatic resize, image resizer, image scaler
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: trunk

Imsanity automatically resizes insanely huge image uploads.  Do contributors keep uploading
huge photos?  Tired of manually scaling?  Imsanity does it automatically.

== Description ==

Imsanity automatically resizes insanely huge image uploads down to a more reasonable size.
The plugin is configurable with a max width and height.  Whenever a contributor uploads an
image that is larger than the configured size, Imsanity will scale it down to the max
size automatically and remove the original image.

This is the perfect plugin for blogs that do not require hi-resolution original images
to be stored and/or the contributors don't want (or understand how) to scale images
before uploading.

= Features =

* Automatically scales large image uploads to a more "sane" size
* Allows configuration of max width/height
* Once enabled, Imsanity requires no actions on the part of the user
* Uses WordPress built-in image scaling functions

== Installation ==

Automatic Installation:

1. Go to Admin - Plugins - Add New and search for "imsanity"
2. Click the Install Button
3. Click 'Activate'

Manual Installation:

1. Download imsanity.zip
2. Unzip and upload the 'imsanity' folder to your '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Imsanity girl will cut you
2. Imsanity settings page to configure max height/width

== Frequently Asked Questions ==

= What is Imsanity? =

Imsanity is a plugin that automatically resizes uploaded images that are larger than the configured max width/height

= 1. Will installing the Imsanity plugin alter existing images in my blog? =

No.  Imsanity only resizes images as they are uploaded so the only files that will be affected are those which you upload
after installing Imsanity.  It does not go through your blog and resize existing images (Although a bulk "cleanup" feature may
be a feature one day if enough people request it - Imsanity will never do this automatically though.)

= 2. Why am I getting an error saying that my "File is not an image" ? =

WordPress uses the GD library to handle the image manipulation.  GD can be installed and configured to support
various types of images.  If GD is not configured to handle a particular image type then you will get
this message when you try to upload it.  For more info see http://php.net/manual/en/image.installation.php

= 3. Why would I need this plugin? =

Photos taken on any modern camera and even most cellphones are too large for display full-size in a browser.
In the case of modern DSLR cameras, the image sizes are intended for high-quality printing and are ridiculously 
over-sized for use on a web page.
Imsanity allows you to set a sanity limit so that all uploaded images will be constrained 
to a reasonable size which is still more than large enough for the needs of a typical website.

= 4. Doesn't WordPress already automatically scale images? =

When an image is uploaded WordPress keeps the original and, depending on the size of the original,
will create up to 3 smaller sized copies of the file (Large, Medium, Thumbnail).  Unless you have
special photographic needs, the original usually sits there un-used taking up space.

WordPress expects you to embed the large, medium or thumbnail size images in your posts,
however it is easy enough to embed the "original" size image and visually re-size it 
in the browser.  This does not really change the file size of the original image, though and
can create a slow browsing experience for visitors.  It is not always easy to explain this 
subtle difference to site contributors.

= 5. Why did you spell Insanity wrong and why does Imsanity girl want to cut me? =

Imsanity is short for "Image Sanity Limit"  A sanity limit is a term for limiting something down to 
a size or value that is reasonable.  Imsanity girl cuts because you drive her insane by uploading 
unecessarily large images for no good reason.

= 6. Where do I go for support? =

Documentation is available on the plugin homepage at http://wordpress.org/tags/imsanity and questions may 
be posted on the support forum at http://wordpress.org/tags/imsanity

== Upgrade Notice ==

= 1.0.1 =
* added error handling & reporting when image_resize returns an error

== Changelog ==

= 1.0.1 =
* added error handling & reporting when image_resize returns an error

= 1.0.0 =
* original release.  fresh!
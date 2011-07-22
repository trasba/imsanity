=== Plugin Name ===
Contributors: verysimple
Donate link: http://verysimple.com/products/imsanity/
Tags: imsanity, image, images, automatic scale, automatic resize, image resizer, image scaler
Requires at least: 2.7
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

1. Go to Admin - Plugins - Add New
2. Search for Imsanity
3. Click the Install Button

Manual Installation:

1. Download imsanity.zip (or use the WordPress "Add New Plugin" feature)
2. Extract the ZIP and upload the 'imsanity' folder to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Imsanity girl will cut you
2. Imsanity settings page to configure max height/width

== Frequently Asked Questions ==

= What is Imsanity? =

Imsanity is a plugin that automatically resizes uploaded images that are larger than the configured max width/height

= Why would I need this plugin? =

A picture from a modern camera almost always needs to be scaled down to display properly in
a browser.  The average computer screen is not big enough to display a 3 megapixel camera-phone image at full resolution.
A 12 megapixel photograph is about 10 times larger than a standard computer monitor resolution.  Blog contributors
may not understand this and upload huge image files, even though they will be squashed and displayed
at a much smaller size.  Unless there is a need to archive high-res originals they are at usually just taking up disk
space.  If the original image file winds up on the page, they can slow page load times and use bandwidth.

Imsanity solves this issue by simply scaling all uploaded images down to a reasonable size for displaying in a 
browser.

= Doesn't WordPress already automatically scale images? =

When an image is uploaded WordPress automatically creates up to 3 smaller sized copies of the file.  In 
the media browser and gallery you can select "large" "medium" and "thumbnail" when inserting.   The original
image is saved which, unless you are using WordPress to archive the originals, this is simply using up disk space.

If a contributor doesn't select one of the smaller image sizes then they wind up putting the huge original 
image onto a page and then "resize" it by adjusting the display size (these show up in the image dialog as
percentages (50%, 60%, etc).  When you do this your visitors must download the huge file 
(sometimes several megabytes) even though it only shows up as a small image on the page.  If you have a lot
of these it can start to affect the performance of your site and create a poor user experience.

= Where do I go for support? =

Documentation and support is available on the plugin homepage at http://verysimple.com/products/imsanity/

== Upgrade Notice ==

= 1.0.0 =
* original release.  fresh!

== Changelog ==

= 1.0.0 =
* original release.  fresh!
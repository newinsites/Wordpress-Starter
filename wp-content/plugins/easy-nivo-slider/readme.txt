=== Easy Nivo Slider ===
Contributors: ecurtain
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QG7JF2QUHGF6A
Tags: slider, nivo, slideshow, custom post type, gallery, widget, shortcode, nextgen
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 1.6
License: GPLv2
Adds Nivo Slider to a post/page with no coding. Builds sliders from a post images, featured images in posts, or from NextGen galleries.
== Description ==
Easy Nivo Slider allows you to easily add the awesome Nivo Slider to any post, page, or sidebar without writing any code.  This plugin generates the slideshow for you, allowing many customizations including size, speed, type of animation, navigation behavior, etc.  Select which images are used in the slider - all images attached to a post/page, featured images from a category/custom post type/taxonomy/term, or images in a NexGen gallery.

Define up to three slider configurations, setting the slider size and navigation behavior. Then add as many sliders as you want using those configurations, customizing each one for image selection, animation, and speed.

A plugin for the visual editor makes adding shortcodes a snap.  Choose the options you want with a form and the plugin generates the shortcode for you.

Add sliders to your sidebar with widgets, which also allow images selection and slider behavior.

Easy Nivo Slider uses WordPress's thumbnail support to automatically create copies of images you add to your site, re-sized and cropped to fit the slider exactly.

Features:
* Generates a slider using the attached images from a post or page.
* Generates a slider using the featured images from posts.
* Generates a slider using images from a NextGen gallery.
* No coding required, not changes to the them files needed.
* Add slider to any post or page with the Visual Editor button 
* The shortcode system writes the shortcodes for you.
* Slider widgets to add sliders to the sidebar.
* Preview mode lets you see how the sliders and widget will appear.
* Customize behavior, navigation, and captions.
* Customize transition animation and speed.
* Images (optionally) link to the posts where they are featured
* Add as many sliders as you want to a page - each with its own settings.

== Installation ==
1. Upload the plugin to your blog.
2. Activate it.
3. Go to the Nivo Slider Settings page and set the sizes for the three sliders.
4. Add sliders to your posts or pages with the Nivo button in the visual editor, or to the sidebar with a widget.

Enjoy the show!

== Frequently Asked Questions ==

Q: Why are there three slider sizes?  Does that mean I can only have three sliders on my site?

You can have as many sliders as you like on your site.  You can even have multiple sliders in a single post, page, or in the sidebar.  

The slider sizes represent three *configurations* of sliders.  Each configuration specifies a slider size and behaviour.  You then add sliders to a page and indicate which of the three sizes to use.

Q: How does the resizing work?

Thanks to the awesome Filosofo Custom Image Sizes plugin, WordPress can generate scaled, cropped copies of images for you.

Q: The NextGen sliders aren't sizing correctly.

NextGen has its own way of working with images, and this plugin doesn't yet have the ability
to resize the images for the slider.  For now, NextGen sliders will be the actual size of the
images in the galleries.

== Screenshots ==
1. Sliders with different navigation options.
2. Sliders in the page body and sidebars.
3. Thumbnail navigation for sliders.  (Thumbnails are generated automatically)
4. Add a slider to any post or page with the Visual editor plugin
5. Current post images - create a slider from all the images attached to the current post or page.
6. Post type - Create a slider from your choice of custom post type, category/taxonomy, and term.
7. NextGen - Create a slider from your NextGen galleries.
8. Nivo provides 14 beautiful transitions to choose from 
9. Add slider widgets to your sidebar
10. Preview mode to test the look and feel of your slider
11. Slider size and navigation configuration.  Many options to choose from.

== Changelog ==

= 1.6.1
* Corrected a typo causing problems with plugin activation

= 1.6
* Added automatic sizing for "current post" sliders.
* Added thumbnail navigation for sliders.

= 1.5
* Added the Custom Image Sizes plugin by Filosofo to support resizing the sliders

= 1.4
* Added NextGen gallery support
* Added NextGen widget support (without scaling)
* Fixed duplicate image insertion for source=current-post
* Changed calls to wp_get_attachment_image and wp_get_attachment_link to use size arrays rather than named thumbails

= 1.3
* Added slider support for all images attached to the current post/page
* Added "jump to" navigation for slide numbers
* Added vertical offset field for slider controls 

= 1.2
* Restructured the plugin settings panel
* Added separate configurations for first, second, and widget slider

= 1.1 =
* Added preview panel
* Added widget support
* Added widget settings panel
* Added tinyMCE support


== Upgrade Notice ==

= 1.6 =
This upgrade adds autosizing for "current post images" sliders.
This upgrade also adds thumbnail navigation for sliders.  

= 1.5 =
This upgrade supports slider resizing for custom post type sliders.

= 1.4 =
This upgrade adds NextGen support, and corrects a few bugs.

= 1.3 =
This upgrade adds slider generation for all images attached to a single post.

= 1.2 =
This upgrade adds support for three differen slider configurations.

== Acknowledgements  ==

This plugin was developed around the Nivo Slider, "The world's most awesome jQuery slider" by dev7studios.  It's really an amazing piece of work.  Check out their site at http://nivo.dev7studios.com/   Plugin settings allow you to exclude the Nivo plugin if it's installed separately.

This plugin uses the very handy Custom Image Sizes plugin by Filosofo to support resizing the sliders.  The Custom Image Sizes plugin is automatically included, but settings allow you to exclude it if it's installed separately.

== Known Issues  ==

* This plugin doesn't handle resizing of NextGen galleries very well.  NextGen images are handled a little differently, and I'm working on a way to address this.

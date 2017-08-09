=== PCF Contact Form ===
Contributors: PCFDev
Tags: contact, form, pcf, database, data, base, save, submission, submissions
Requires at least: 4.0
Tested up to: 4.3.1
Stable tag: 1.2.1
License GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin by PC Futures that creates a contact form that can save submissions to a database, which can be viewed in the WordPress backend.


== Description ==

= Basic Instructions =

Once the plugin is installed, go to **`Contact Form`** on the WordPress Backend and configure all settings. If you want to enable saving form submissions to a database, go to **`Contact Form > SQL Options`** and check the box and fill out all information.

Form submissions can be viewed by going to **`Contact Forms > Form Submissions`**

To place the contact form, use the shortcode **`[pcf_contact_form]`**.

The contact form has some default styling, but it can be changed under **`Plugins > Editor`** by selecting **`PCF Contact Form`** and editing **`pcf-contact-form/css/pcfcf-style.css`**.

See the [documentation](http://www.pcfutures.co.uk/plugins/contact-form-documentation "Contact Form Documentation") for more detailed instructions.

== Installation ==

1. Upload 'pcf-contact-form-X.X.zip' to WordPress
1. Activate the plugin once installed.
1. Go to 'wp-admin', then 'Contact Form' and set desired options. All options under General Options are required.
1. Place shortcode (`[pcf_contact_form]`) where you want contact form to appear!

== Frequently Asked Questions ==

= Can I style the form? =

Yes! You can edit `pcf-contact-form/css/pcfcf-style.css`. See our [documentation](http://www.pcfutures.co.uk/plugins/contact-form-documentation#styling "Contact Form Styling Documentation") for more information.

== Screenshots ==

1. No screenshots at the moment.

== Changelog ==

= 1.3 =

* Updated plugin to use the built-in wpdb class, so that form submissions are saved within wordpress, not in an external database. This means minimal configuration is needed.

= 1.2.2 =

* Changed back to 1.2 because previous update had serious issues

= 1.2.1 =

* Enabled default options for SQL using wp-config.php

= 1.2 =

* Fixed an issue that stopped the subject containing any numbers or punctuation. Now accepts anything other than quotation marks.
* Fixed an issue that caused punctuation in the site title to be outputted as HTML entities in the form submission.

= 1.1 =

* Updated some files

= 1.0 =

* Released Plugin

== Upgrade Notice ==

= 1.3 =

* Major change to how the plugin works, update if you can.

= 1.2.2 =

* Changed the last update back because it had some serious issues.

= 1.2.1 =

* Made the set up of SQL much easier, upgrading will do no harm.

= 1.2 =

* Fixed a few bugs, updating is advised.

= 1.0 =

* N/A
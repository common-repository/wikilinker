=== Wikilinker ===
Contributors: dartiss
Tags: link, wikipedia
Requires at least: 4.6
Tested up to: 4.9
Requires PHP: 5.3
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple shortcode to quickly add links to Wikipedia.

== Description ==

This is a super simple plugin that allows you to quickly and easily add Wikipedia links to your post or page content. I've been using a slimmed down version of this on my own sites for years and thought it was time to make it generally available!

The quickest way to add a link is simply to wrap the `[wikilink]` shortcode around a word or series of words. It will then link to those words. For example...

`Chicago was also the codename for [wikilink]Windows 95[/wikilink].`

This will then add a link to the words "Windows 95", creating a quick and easy way to link to useful information for readers. Unfortunately, not all Wikipedia links are that simple. If the text doesn't link to the correct entry you can use the `alt` parameter to specify your own. For example...

`If you've seen the film, the [wikilink alt="Deadpool (Original Motion Picture Soundtrack)"]soundtrack to Deadpool[/wikilink] is worth considering.`

By default this plugin uses the English language version of Wikipedia but you can override this using the `lang` parameter. In future I'll add a settings screen so that the default can be specified there, once and for all! Other available parameters include `rel` and `target` and operate exactly the same as their HTML equivalents.

Here are all the parameters in use...

`[wikilink lang="fr" alt="Pop rock" rel="nofollow" target="_blank"]musique pop et rock[/wikilink]`

Technical specification...

* Designed for both single and multi-site installations
* PHP7 compatible
* Fully internationalized, ready for translations. **If you would like to add a translation to this plugin then please head to our [Translating WordPress](https://translate.wordpress.org/projects/wp-plugins/wikilinker "Translating WordPress") page**

Please visit the [Github page](https://github.com/dartiss/wikilinker "Github") for the latest code development, planned enhancements and known issues.

== Installation ==

Wikilinker can be found and installed via the Plugin menu within WordPress administration (Plugins -> Add New). Alternatively, it can be downloaded from WordPress.org and installed manually...

1. Upload the entire `wikilinker` folder to your `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress administration.

Voila! It's ready to go.

== Screenshots ==

1. The settings screen - defaults have been set. The drop-down help is also shown

== Changelog ==

[Learn more about my version numbering methodology](https://artiss.blog/2016/09/wordpress-plugin-versioning/ "WordPress Plugin Versioning")

= 1.0.3 =
* Maintenance: Lots of minor tweaks to the README
* Maintenance: Removed donation links but added a Github link in the meta

= 1.0.2 =
* Maintenance: Tweaks to the README and a whole new site of image assets
* Maintenance: Now using Yoda conditions throughout the code
* Maintenance: Shortcodes are now loaded whether in admin or the front-end as it gives no performance benefit
* Maintenance: Minimum level of WordPress for the plugin is now 4.6, which means various checks have been dropped from the code, including the inclusion of language files
* Maintenance: Updated links to my site

= 1.0.1 =
* Enhancement: After WP 4.6 you don't need to load the text domain. So I don't!

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0.2 =
* Various maintenance changes
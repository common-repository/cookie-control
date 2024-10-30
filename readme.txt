=== Cookie Control ===
Contributors: sjtuffin, sherred
Donate link: 
Tags: cookie, cookies, cookie legislation, eu cookie law
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables you to comply with the UK and EU law on cookies.

== Description ==

This Wordpress plugin simplifies the implementation and customisation process of Cookie Control by [Civic UK](http://civicuk.com/ "Civic UK").

With an elegant user-interface that doesn't hurt the look and feel of your site, Cookie Control is a mechanism for controlling user consent for the use of cookies on their computer.

There are several license types available, including:

**Free** - Configuration options for Icon type and location, Notification text, Multiple consent models and SSL Support.

**Single Domain** - All of the above, with additional layout interfaces (top and bottom bars), Geo-targeting, and Freedom to rebrand. 

**Multi Domain** - All of the above, with infinite number of subdomains allowed across 10 different domains.

To find out more about Cookie Control please visit [Civic's Cookie Control home page](http://civicuk.com/cookie-law/index "Civic's Cookie Control home page").


**Please Note**:

You will need to obtain an API KEY from [Civic UK](http://civicuk.com/cookie-law/pricing "Civic UK") in order to use this plugin.

Cookie Control is simply a mechanism to enable you to comply with UK and EU law on cookies. **You need to determine** which elements of your website are using cookies (this can be done via a [Cookie Audit](http://civicuk.com/cookie-law/deployment#audit "Cookie audit"), and ensure they are connected to Cookie Control.

== Installation ==

1. Obtain an API Key from [Civic UK](http://civicuk.com/cookie-law/pricing "Civic UK") for the site that you wish to deploy Cookie Control.*
1. Upload the entire `cookie-control` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Configure the plugin by selecting 'Cookie Control' on your admin menu.
1. All done. Good job!


* If you already have an API Key and are wanting to update your domain records with CIVIC, please visit [Civic UK](http://civicuk.com/cookie-law/pricing?configure=true "Civic UK")

== Frequently Asked Questions ==

= API Key Error =

If you are using the free version your API key relates to a specific host domain.

So www.mydomain.org might work, but mydomain.org (without the www) might not.

Be sure that you enter the correct host domain when registering for your API key.

The recommended way of avoiding this problem is to create a 301 redirect so all requests to mydomain.org get forwarded to www.mydomain.org

This may have [SEO benefits](http://www.mattcutts.com/blog/seo-advice-url-canonicalization/ "SEO benefits") too as it makes it very clear to search engines which is the canonical (one true) domain.

= Is installing and configuring the plugin enough for compliance? =

Only if the only cookies your site uses are the Google Analytics ones. 
If other plugins set cookies, it is possible that you will need to write additional JavaScript.
To determine what cookies your site uses do a a [Cookie Audit](http://civicuk.com/cookie-law/deployment#audit "Cookie audit"). You will need to do this in any case in order to have a compliant privacy policy.
It is your responsibility as a webmaster to know what cookies your site sets, what they do and when they expire. If you don't you may need to consult whoever put your site together.

= I'm getting an error message / Cookie Control isn't working? =

Support for Cookie Control is available via the forum: [https://groups.google.com/forum/#!forum/cookiecontrol](https://groups.google.com/forum/#!forum/cookiecontrol/ "https://groups.google.com/forum/#!forum/cookiecontrol")

You can also contact the plugin contributors directly:

Sherred: [@sherred](https://twitter.com/sherred/ "@sherred") // [Sherred's website](http://sherred.com/ "Sherred's Website") and send an email to the address you find there.
Sjtuffin: [@sjtuffin](https://twitter.com/sjtuffin/ "@sjtuffin")

== Changelog ==

= 2.2 =
* Now using version 6.2 of Cookie Control
* Option added to allow user's to set their preference for the close button. Normally, the widget will hide upon close, though this can now be set to stay open until the user provides (or explicitly denies) consent.
* Text area added so users can add their preferred Analytics tools, rather than be restricted to Google Analytics.

= 2.0 =
* Now using version 6.1 of Cookie Control
* Choose your user interface. In addition to Cookie Control's classic, corner pop-up, you can now choose a bar that displays at the top of your screen or a bar that displays at the foot of your screen.
* Stateful buttons. The last version of Cookie Control introduced slider "on/off" buttons. User feedback showed that these could be better. So we've introduced stateful buttons. The result is a cleaner user interface that makes opting in the natural user behaviour.
* Geolocation. We've been relying on the excellent service provided by GeoPlugin to provide location awareness for Cookie Control - enabling you to specify which countries it displays in. To avoid wearing out our welcome with that service we've brought geolocation in-house. This is now a more integrated part of Cookie Control and SSL is available for those who need it.
* Policy awareness. Cookie Control will now check for a policy version. If your cookies policy has changed, Cookie Control will reset itself, enabling users to be prompted to accept Cookies once more.
* Easier to edit text. You can now define all of Cookie Control's button labels, alert messages etc using initialisation parameters. This makes it a lot easier to change the default language of Cookie Control.
* No more Base64. In earlier versions of Cookie Control we used Base64 encoding for images. This meant no image assets to deal with, but it also made it complicated to customise Cookie Control. In Cookie Control 6 we serve a single image sprite file from CIVIC's servers. There's a very good chance that most visitors to your site will have this cached already, so it won't affect performance.
* Auto-delete cookies. Webmasters can now enable auto-delete of cookies. This is the cheap and cheerful way of removing first-party cookies if you're using the Implied Consent or Explicit Consent deployment models, when a user opts out of cookies. 
* API key. CIVIC now require an API key in order to validate use of the Cookie Control service.
* Bug fixes and improvements. Various fixes and code optimisation to make Cookie Control easier to work with.

= 1.5 =
* Updated to use version 5 of Civic UK Cookie Control which brings new customisable options
* Fixed ccAddAnalytics typo in settings page which meant the pop up was showing even after consent
* Changed ccAddAnalytics functions to use Google Asynchronous Syntax
* Removed backlink to Civic UK. Added request in settings to put in site privacy policy page. So plugin conforms to WP plugin guidelines
* General update to settings made and docs to make it easier to use the plugin

= 1.4 =
* Using version 4.1 of Cookie Control
* Added Google Analytics tracking code field and javascript handling code
* Added Plugin intro text and explanation of what it does and doesn't do
* Improved settings page layout
* Clarify and added settings explanations
* Fixed hiding behind Twenty Eleven banner image

= 1.3 =
* include folder updated

= 1.2 =
* Version number fix

= 1.1 =
* Small typo fix

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 1.4 =
Bug fix. Improved and added more settings. Easier to deal with Google Analytics cookies.
=== ShiftThis | URL Login ===
Contributors: shiftthis
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal%40shiftthis%2enet&item_name=WordPress%20Plugin%20Development%20Donation&no_shipping=0&return=http%3a%2f%2fwww%2eshiftthis%2enet%2f&no_note=1&tax=0&currency_code=CAD&lc=CA&bn=PP%2dDonationsBF&charset=UTF%2d8&notify_url=http%3a%2f%2fwww%2eshiftthis%2enet%2f
Tags: login, logout, url, htaccess
Requires at least: 2.0.2
Tested up to: 2.1.3
Stable tag: 1.2

Simple login/logout redirection using custom urls instead of physical page links.

== Description ==

For WordPress sites needing an hidden login without using a page link. Simply type your desired login URL such as www.mywebsite.com/login or www.mywebsite.com/logout to access the login or logout pages. The login value, login redirect page and the logout value are all fully editable within the options page. This plugin makes use of your .htaccess file using 301 redirects. Your .htaccess file will need to be writable for automated use.

== Installation ==


1. Upload 'st-url-login.php' to the 'wp-content\plugins' directory
2. Activate the plugin titled 'ShiftThis | Swift SMTP' through the 'Plugins' menu in WordPress
3. Access the **Options** Tab in your Admin Panel and select the **URL Login** SubMenu Item.

== URL Login Options ==

* **Login Text** - Set to the text you would like to use to redirect to login page (Default is "login".)  This will set the login URL to http://www.mywebsite.com/login
* **Login Redirect to** - Choice of your Website home, Blog home or directly to WordPress Admin.  You can also set a custom url to overide the default choices.
* **Logout Text** - Set to the text you would like to use to redirect to logout page.

== Example Code ==

Example of .htaccess code added:

`# BEGIN ST_URLLogin
Redirect 301 /login http://www.mywebsite.com/wp-admin/
Redirect 301 /logout http://www.mywebsite.com/wp-login.php?action=logout
# END ST_URLLogin`


== Frequently Asked Questions ==

= I get a Server Error message after installing or updating the Plugins Options =

Something went wrong with the .htaccess file, you will need to either delete the .htaccess file and recreate it, or open the .htaccess file and remove everything between # BEGIN ST\_URLLogin and # END ST\_URLLogin

= Where can I ask support questions for this plugin? =

[support.ShiftThis.net](http://support.shiftthis.net)

== Screenshots ==
1. The URL Login Options Page.

## === SeaSP Community Edition ===
Contributors: bluetriangle
Donate link: https://www.patreon.com/bluetriangle
Tags: csp, content security policy, security, http headers
Requires at least: 5.1
Tested up to: 5.6
Requires PHP: 7.0
Stable tag: 1.4.2
License: GPLv3 
License URI: https://choosealicense.com/licenses/gpl-3.0/
 
## == Important Notice ==

(IMPORTANT IF INSTALLING FROM GITHUB REPO) Rename the folder from SeaSP-Community-Edition to sea-sp-community-edition 

## == Description ==

SeaSP-Community Edition WordPress plugin is an automated **Content Security Policy Manager**. SeaSP allows you to create, configure, and deploy a Content Security Policy for your site.

The WordPress SeaSP-Community Edition plugin catalogs the domains your site is using. Categorize and filter out unwanted domains. Add a layer of WordPress security site from magecart and other cross-scripting hacks to keep your WordPress site safe.

SeaSP installs a strict non-blocking CSP to collect violation data and provide a violation report. Violation data flows into the WordPress database as a PHP option within the plugin options schema. Violations can be approved by domains and categorized by directives (CSS, fonts, images, JS, etc.). You can also approve base domains and subdomains. The SeaSP UI helps users by explaining what each directive does, and how to use them to create a CSP.

After configuring the domain and directive settings switch the CSP to blocking mode. Once the CSP goes into blocking mode, the site's protected from any unrecognized code. SeaSP-Community Edition helps secure your site.


## == Installation ==

1. Download and unzip the contents into the plugins folder of your WordPress instance.
2. (IMPORTANT IF INSTALLING FROM GITHUB REPO) Rename the folder from SeaSP-Community-Edition to sea-sp-community-edition 
3. In the Admin Dashboard of WordPress click on the Plugins menu item on the left side.
4. Find SeaSP - Community Edition in the list of plugins and click activate. 
5. After activation there will be a new admin menu item with a white triangle that says SeaSP
6. Watch the walk through video [here](https://youtu.be/XdJNh6LEKJw) for more directions. 

## == Frequently Asked Questions ==

### What  is a Content Security Policy? =
 
A Content Security Policy (CSP) is a browser security standard that controls the domains, subdomains, and types of resources a browser can load on a given web page. CSPs go into a special Content Security Policy header, or it can go on a web page using a meta tag. CSPs are compatible with all modern desktop and mobile browsers, including Chrome, Firefox, Internet Explorer, Edge, and Safari. CSPs detect and prevent certain types of attacks including form jacking and cross-site scripting, browser hijacking and ad injection, as well as unauthorized piggyback tags. 

SeaSP is an extra layer of security that protects your WordPress site from spammers by blocking unauthorized scripts.

### What's next after my WordPress installation?

Once the plugins installed a strict non-blocking CSP is on your site. Visit each page of your site to collect CSP violations for individual pages. The Current Violations page of the plugin collects domains that violate CSP directives.

Review domains and click the toggle to approve the domain and include it in the CSP. Check for misspellings of common domains like adobee.com instead of adobe.com. This is a common way hackers inject content into your site.

To allow subdomains to serve content, click the include subdomains toggle. To learn more about the violated directives click the blue Directive button.

After this process, you might still see CSP violations for inline scripts, inline styles, blobs, or data. To allow this type of content navigate to the Directive Settings page and toggle the appropriate options (connect src, media src, child src, object src, frame ancestors, unsafe inline, etc.) Each option has a tooltip explaining what the directive allows in your CSP.

User our CSP reports to see what content is loading on your site. 

### Is there a tutorial? =

A walk though of this plugin can be found [here](https://youtu.be/XdJNh6LEKJw)

### How does the plugin collect CSP violations? =
The plugin installs a small javascript in the head of your site that defines a variable named _BTT_CSP_FREE_ERROR the violations are then collected in this variable made into a json string and send to the back end of the plugin via ajax using a nonce. These errors are then parsed for the domains and the directives they have violated. This data is then stored as a php object in a plugin option. This data never leaves your site.  

## == Screenshots ==

1. Current Violations page is where you review all the domains that have violated your CSP to add them to the policy for the given directive 
2. Directive Settings page is where you set source settings for each directive of your policy 

## == Changelog ==
 
# = 1.0 =
* Users can collect CSP violation data and approve violating domains to add them to their CSP
* All CSP terminology has been defined with tool tips 
* Users can set source settings for each of the directives of the CSP 

# = 1.1 =
* fixed a bug where we misnamed a folder and cause bootstrap and other UI files to break
* added a navigation menu to the top of the plugin for ease of use 
* after activation the plugin now directs to the landing page for more instructions 

# = 1.2 =
* Fixed broken images
* Cleaned up UI - spacing issues
* Edited text in the top for clearer instructions on how to use the plugin

# = 1.3 =
* Fixed problem with saving CSP data on a multi-site wordpress install
* fixed incorrect version label on SeaSP plugin pages 

# = 1.4 =
* We completely changed the way we save data to the word press database so that our solution is more stable
* instead of using the options table provided by Wordpress we add the following tables
*   seasp_violation_log - holds all the csp violations
*   seasp_directive_settings - holds all the csp directive settings 
*   seasp_allowed_plugins - this is for future support of object-src 
*   seasp_csp - this holds the actual CSP for versioning purposes 
*   seasp_directives - this is a definitions table for all the directives
*   seasp_directive_options - this is a definitions table for all directive options 
*   seasp_site_settings - this is a general settings table for things like post load delay 
*   seasp_sand_box_urls - this is for future support of the sand box directive 
* Multi-site Wordpress instances are now fully supported with the new database schema
* Added the ability to change the post load delay to capture more errors after page load 
* Added the ability to turn on and off error collection independent of placing the CSP in blocking mode

# = 1.4.1 =
* This update is a hotfix for a problem observed on a Safari Browser where directives did not fall back on default-src directive for https: setting
* To remedy this when ever a directive setting is changed https is automatically selected for you 

# = 1.4.2 =
* This update is to clarify copy and images on the WordPress.org SeaSP Plugin page.

## == Upgrade Notice ==
* When you install this version you will need to rebuild your CSP

## == Usage ==

Once installed a strict non-blocking CSP is implemented on your site visit each page of your site to collect CSP violations for each of those pages.
Visit the Current Violations page of the plugin to review domains that have violated a directive in the CSP.
Review each of the domains carefully and check for misspellings of common domains like adobee.com instead of adobe.com as this is a common way hackers inject content into your site.
If you feel confident that the domain belongs on your site and it should be serving the file type stated, click the toggle to approve the domain and include it in the CSP.
If you want to allow subdomains of that domain to be able to serve that type of content, click the include subdomains toggle. 
To learn more about the directive that was violated click the blue Directive button.
After this process you might still see CSP violations regarding inline scripts, inline styles, blobs, or data.
To allow these this type of content in the community version you must navigate to the Directive Settings page, find the offending directive and toggle the appropriate option.
For convenience, each option has a tool tip explaining what it allows in your CSP.

## == Walk Through ==
A walk through video can be found on You Tube [here](https://youtu.be/XdJNh6LEKJw)

https://youtu.be/XdJNh6LEKJw

## == Contributing ==
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
This project has been tested on WordPress up to version 5.6 on both single and multi-site instances.
The project can be found on [github](https://bluetrianglemarketing.github.io/SeaSP-Community-Edition/)
This project is sponsored by [Blue Triangle](www.bluetriangle.com)

## Third Party Libraries 
We use [Bootstrap](https://getbootstrap.com/) for the UI of our plugin to make the interface clean and simple.
Bootstraps license can be found [here](https://github.com/twbs/bootstrap/blob/main/LICENSE)

We use [bootstrap toggle](https://www.bootstraptoggle.com/) because simple check boxes can be confusing and we wanted our CSP mangers UI to feel easy. This code was developed for The New York Times by [Min Hur](https://github.com/minhur) and is licensed under [MIT](https://opensource.org/licenses/MIT)

## == License ==
[GNU](https://choosealicense.com/licenses/gpl-3.0/)

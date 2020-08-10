=== SeaSP Community Edition ===
Contributors: Julian Wilkison-Duran, Trish Brumett, Art By - Rachel Grant, and Dorthy Sysling
Donate link: https://www.patreon.com/bluetriangle
Tags: csp, content security policy, security, http headers
Requires at least: 5.1
Tested up to: 5.4
Requires PHP: 7.2
Stable tag: 4.3
License: GPLv3 
License URI: https://choosealicense.com/licenses/gpl-3.0/
 
== Description ==
# Sea SP-Community Edition  
Sea SP-Community Edition is an automated Content Security Policy manger that first installs a strict non-blocking CSP to collect violation data. 
Once violation data is collected it is stored in the WordPress database as a php object in the plugin options schema.
Sea SP-Community Edition then allows you to look through each of the violations and approve domains for each directive that has been violated.
One can choose to either approve the base domain or subdomains or both.
Other features include the ability to set sources of content for each directive of the CSP such as only allowing HTTP or HTTPS domains, or Allowing inline scripts only for style sources.
The UI gives the user tips on what each directive does and how it should be used to protect their site. 
Once domain and directive settings are done being configured the CSP can then be turned to blocking mode to protect the site 

== Installation ==

1. Download and unzip the contents into the plugins folder of your WordPress instance.
2. In the Admin Dashboard of WordPress click on the Plugins menu item on teh left side.
3. Find Blue Triangle Free CSP in the list of plugins and click activate. 

== Frequently Asked Questions ==
= What data does SeaSP collect? =
 
SeaSP collects content security policy violations from the console 

= Where is this data stored? =

The CSP violations them selves are not stored only the violating domains the directives they violated. Those are stored as a php object in the plugin options schema.

= Is there a tutorial? =
A walk though of this plugin can be found [here](https://youtu.be/XdJNh6LEKJw)

== Screenshots ==
1. SeaSP Dashboard contains blogs and webinars to keep up to date with teh latest Blue Triangle CSP news and updates 
2. General settings page is where you preview and activate a blocking CSP
3. Current Violations page is where you review all the domains that have violated your CSP to add them to the policy for the given directive 
4. Directive Settings page is where you set source settings for each directive of your policy 

== Changelog ==
 
= 1.0 =
* Users can collect CSP violation data and approve violating domains to add them to their CSP
* All CSP terminology has been defined with tool tips 
* Users can set source settings for each of the directives of the CSP 

== Usage ==

Once installed a strict non-blocking CSP is implemented on your site visit each page of your site to collect CSP violations for each of those pages.
Visit the Current Violations page of the plugin to review domains that have violated a directive in the CSP.
Review each of the domains carefully and check for misspellings of common domains like adobee.com instead of adobe.com as this is a common way hackers inject content into your site.
If you feel confident that the domain belongs on your site and it should be serving the file type stated click the toggle to approve the domain and include it in the CSP.
If you want to allow subdomains of that domain to be able to serve that type of content click the include subdomains toggle. 
To learn more about the directive that was violated click the blue Directive button.
After this process you might still see CSP violations regarding inline scripts, inline styles, blobs, or data.
To allow these ths type of content in the community version you must navigate to the Directive Settings page, find the offending directive and toggle the appropriate option.
For convenience, each option has a tool tip explaining what it allows in your CSP.

== Walk Through ==
A walk through video can be found on You Tube [here](https://youtu.be/XdJNh6LEKJw)

== Contributing ==
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
This project has been tested on WordPress up to version 5.4 on both single and multi site instances.
The project can be found on [github](https://bluetrianglemarketing.github.io/SeaSP-Community-Edition/)
This project is sponsored by [Blue Triangle](www.bluetriangle.com)


== License ==
[GNU](https://choosealicense.com/licenses/gpl-3.0/)
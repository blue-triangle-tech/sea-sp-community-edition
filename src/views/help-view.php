<div class="row">
    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <img class="card-img" alt="Blue Triangle Logo" src="<?=$pluginDirectory?>img/seaSPIcon.png">
            <div class="card-img-overlay" style="top: 80px;left: 50px;background-color: rgb(45 33 33 / 46%);width: 215px;height: 160px;">
                <h6 class="card-title">SeaSP - Community Edition</h6>
                <p class="card-text">Automated CSP Manger</p>
                <p class="card-text">Version 1.0 <br>Powered By: <a href="https://www.bluetriangle.com" class="text-warning">Blue Triangle</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card bg-dark text-white">
            <img src="<?=$pluginDirectory?>img/seaSPBanner.png" class="card-img" alt="Upgrade your Arrr'senal to protect your booty! Upgrade Your SeaSP today!" style="height: 275px;">
            <div class="card-img-overlay" style="
            top: 180px;
            color: #ffffff;
            background-color: rgb(45 33 33 / 46%);
            ">
                <h5 class="card-title">SeaSP protects your hard earned riches.</h5>
                <h4 class="card-text">Upgrade your Arrr'senal to protect your booty!<a href="https://www.bluetriangle.com/blue-triangles-csp-wordpress-plugin-seasp/" class="btn btn-warning">Upgrade Your SeaSP today!</a></h4>
            </div>
        </div>
    </div>
</div>

<h3>Walk Through</h3>
<iframe width="560" height="315" src="https://www.youtube.com/embed/XdJNh6LEKJw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<h3>Sea SP-Community Edition </h3>

<p>Sea SP-Community Edition is an automated CSP manger that first installs a strict non-blocking CSP to collect violation data. <br>
Once violation data is collected it is stored in the WordPress database as a php object in the plugin options schema.<br>
Sea SP-Community Edition then allows you to look through each of the violations and approve domains for each directive that has been violated.<br>
One can choose to either approve the base domain or subdomains or both.<br>
Other features include the ability to set sources of content for each directive of the CSP such as only allowing HTTP or HTTPS domains, or Allowing inline scripts only for style sources.<br>
The UI gives the user tips on what each directive does and how it should be used to protect their site. <br>
Once domain and directive settings are done being configured the CSP can then be turned to blocking mode to protect the site <br>
</p>
<h3>Installation</h3>
<ul>
<li>Download and unzip the contents into the plugins folder of your WordPress instance.</li>
<li>In the Admin Dashboard of WordPress click on the Plugins menu item on teh left side.</li>
<li>Find Blue Triangle Free CSP in the list of plugins and click activate.</li>
</ul>
<h3> Usage</h3>
<p>Once installed a strict non-blocking CSP is implemented on your site visit each page of your site to collect CSP violations for each of those pages.<br>
Visit the Current Violations page of the plugin to review domains that have violated a directive in the CSP.<br>
Review each of the domains carefully and check for misspellings of common domains like adobee.com instead of adobe.com as this is a common way hackers inject content into your site.<br>
If you feel confident that the domain belongs on your site and it should be serving the file type stated click the toggle to approve the domain and include it in the CSP.<br>
If you want to allow subdomains of that domain to be able to serve that type of content click the include subdomains toggle. <br>
To learn more about the directive that was violated click the blue Directive button.<br>
After this process you might still see CSP violations regarding inline scripts, inline styles, blobs, or data.<br>
To allow these ths type of content in the community version you must navigate to the Directive Settings page, find the offending directive and toggle the appropriate option.<br>
For convenience, each option has a tool tip explaining what it allows in your CSP.<br>
Once domain and directive settings are done being configured the CSP can then be turned to blocking mode to protect the site <br>
</p>

<h3>Contributing</h3>
<p>Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.</p>
<p>The project can be found on github <a href="https://bluetrianglemarketing.github.io/SeaSP-Community-Edition/">SeaSP-Community-Edition</a>

<h3>License</h3>
<p><a href="https://choosealicense.com/licenses/gpl-3.0/">GNU General Public License v3.0</a></p>


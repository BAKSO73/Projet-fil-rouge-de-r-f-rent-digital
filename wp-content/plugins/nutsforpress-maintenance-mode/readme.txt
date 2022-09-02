=== NutsForPress Maintenance Mode ===

Contributors: Christian Gatti
Tags: NutsForPress,Maintenance Mode,Maintenance,Mode
Donate link: https://www.paypal.com/paypalme/ChristianGatti
Requires at least: 5.3
Tested up to: 6.0
Requires PHP: 7.x
Stable tag: 1.1
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

NutsForPress Maintenance Mode a simple and lightweight plugin that allows to activate a maintenance mode and redirect not logged users to a defined page.


== Description ==

*Maintenance Mode* is the sixth of several NutsForPress plugins providing some essential features that WordPress does not offer itself or offers only partially.  

*Maintenance Mode* allows you to:

* set up a "Maintenance Mode" state and redirect all website visitors to a landing page that you can define
* restrict access to REST API too, if you want to safely hide all the contents, even the textual ones provided by REST API
* hide and redirect to the defined landing page the sitemap page too (the default WordPress sitemap page or the sitemap provided by [NutsForPress Indexing and SEO](https://wordpress.org/plugins/nutsforpress-indexing-and-seo/))
* prevent everyone from login while Maintenance Mode is switched on, except for some Administrators that you explicitly authorize by flagging a checkbox into their profiles
* when the plugin is activated, the involved Administrator is automatically authorized to keep on working and login
* if you remove all the authorization flags from all the Administrators, all of them can keep on login and working
* all the logged in users and all the logged in Administrators that are not explicitly authorized, are instantly logged out when Maintenance Mode is switched on

Maintenance Mode is full compliant with WPML (you don't need to translate any option value)

Take a look at the others [NutsForPress Plugins](https://wordpress.org/plugins/search/nutsforpress/)

**Whatever is worth doing at all is worth doing well**


== Installation ==

= Installation From Plugin Repository =

* Into your WordPress plugin section, press "Add New"
* Use "NutsForPress" as search term
* Click on *Install Now* on *NutsForPress Maintenance Mode* into result page, then click on *Activate*
* Setup "NutsForPress Maintenance Mode" options by clicking on the link you find under the "NutsForPress" menu
* Enjoy!

= Manual Installation =

* Download *NutsForPress Maintenance Mode* from https://wordpress.org/plugins/nutsforpress
* Into your WordPress plugin section, press "Add New" then press "Load Plugin"
* Choose nutsforpress-maintenance-mode.zip file from your local download folder
* Press "Install Now"
* Activate *NutsForPress Maintenance Mode*
* Setup "NutsForPress Maintenance Mode" options by clicking on the link you find under the "NutsForPress" menu
* Enjoy!


== Changelog ==

= 1.1 =
* Now you can define wich Administrator can log in while Maintenance Mode is switched on (all others Administrators are prevented from login, like avery other user with lower roles)
* Every logged in user which is not allowed to login when Maintenace Mode is switched on, now is logged off automatically 

= 1.0 =
* First full working release


== Translations ==

* English: default language
* Italian: entirely translated


== Credits ==

* Very many thanks to [DkRemoto](https://www.dkremoto.it/) and [SviluppoEuropa](https://www.sviluppoeuropa.it/)!
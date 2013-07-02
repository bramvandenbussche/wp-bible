=== WP-Bible ===
Contributors: matejn
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=donate%40nastran%2enet&item_name=WP%2dBible%20plugin&page_style=Primary&no_shipping=1&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: Bible, biblia, bijbel, Scripture, Christian, post, comments, formatting, biblija, sveto pismo 
Requires at least: 2.2
Tested up to: 3.5.2
Stable tag: 1.8

Plugin finds Bible references in your posts and changes them for the actual Bible text from any of 38 different translations in 14 languages.

== Description ==

WP-Bible searches your posts and pages for any reference to a Bible passage and converts the reference to an actual biblical text - which can be any of the 38 translations (in 14 different languages) that you can see at [BIBLIJA.net](http://www.biblija.net/biblija.cgi?set=5&lang=en "BIBLIJA.net"). Or, you can select that plugin only makes links to the biblical text.  

No special tagging of biblical references is needed, the plugin recognizes different (up to 12) names for the same book in the Bible (for example: you can type Matthew 5:1-11 or Mat 5:1-11 or Mt 5:1-11 or you can even use other standards for marking biblical references like Mat 5,1-11.15-17;6,1-3. All this will do.
Plugin then changes the reference for a link and when you click the link a small layer is shown above containing the biblical text. No opening other windows, no popups. 

== Installation ==

= Installation =

You must download wp-bible.zip and unzip the content to `/wp-content/plugins/` directory. Then you must activate the plugin in the `Plugins menu` of your blog's Administration panel. 

The default bible version is `World English Bible - WEB`, if you want to change that, go to `Options | WP-Bible` and choose a version you want.

Using another plugin that does a similar thing is not advised. 

= Usage =

When your plugin is activated just type the usual biblical references and the plugin will find them.

Usually they look like:

*   Mat 5:1-11
*   Mat 5:1-11.14.20
*   Mat 5:1-11.14-16;6,1-3 and similar
   
You can use many different book names, let's see just an example for Gospel of Matthew: Mt, Mat, Matt, Matej, Matevž, Matthew, Matteüs, Matteus, Matthäus, Mateo.
As you can see not only English names are supported.
Please let me know if you'd like to add other book names that the plugin doesn't recognize.


== Screenshots ==

1. This screenshot shows the text with a reference to one biblical passage (Mt 5:1-11) and you can see it being linked.
2. When you move your mouse above the link, a layer with biblical text is displayed.
3. This is the Administration interface

== Frequently Asked Questions ==

= Which Bible translations are included? =

You can choose the bible text from any of the following versions:
 
1. English: American Standard Version (1901) - ASV
1. English: Contemporary English Version (1999) - CEV
1. English: Contemporary English Version (UK) - CEV-UK
1. English: Good News Bible (1992) - GNB
1. English: Good News Bible (UK) - GNB-UK
1. English: King James Version (1611) - KJV
1. English: World English Bible - WEB
1. Arabic: Today's Arabic Version CL NT - TAV
1. Bask: Elizen Arteko Biblia (2004) - EAB
1. Biblia Cornilescu (1921; 2002) - RCB
1. Catalan: Bíblia Catalana Interconfessional - BCI
1. Croatian: Hrvatska Biblija (KS) - HKS
1. Dutch: De Nieuwe Bijbelvertaling (2004/2007) - NBV
1. Dutch: De Nieuwe Bijbelvertaling (2004/2007) - PDA - NBV-PDA
1. Dutch: De Nieuwe Bijbelvertaling Tanacheditie (2006) - NBV-T
1. Dutch: Groot Nieuws Bijbel (1996) - GNB96
1. Dutch: NBG-vertaling 1951 - NBG51
1. Dutch: Statenvertaling editie 1977 - SV77
1. Dutch: Statenvertaling Jongbloed-editie - SV
1. Dutch: Willibrordvertaling (1995) - WV95
1. French: Louis Segond (1910) - SEG
1. German: Luther (1545) - L45
1. Greek: Westcott-Hort Greek New Testament (1885) - GNTWH
1. Latin: Biblia Sacra Vulgata (IV./V. sec.) - VUL
1. Latin: Vulgata Clementina (1592) - VLC
1. Russian: Synodal Version (1876) - RUS
1. Slovenian: Chráskov prevod (1914) - CHR
1. Slovenian: Dalmatinova Biblija (1584) - DAL
1. Slovenian: Ekumenski prevod (1974) - EKU
1. Slovenian: Japljeva Biblija (1784-1802) - JAP
1. Slovenian: Jubilejni prevod NZ (1984) - JUB
1. Slovenian: Slovenski standardni prevod (1997) - SSP
1. Slovenian: SSP - osnovna izdaja (2001) - SSP3
1. Slovenian: Wolfova Biblija (1856-59) - WLF
1. Spanish: Biblia Dios Habla Hoy - DHHE
1. Spanish: Biblia Dios Habla Hoy - DHH
1. Spanish: Biblia Reina Valera - revisión de 1995 - RVR95E
1. Spanish: Biblia Reina Valera - revisión de 1995 (Texto) - RVR95
1. Statenvertaling 1637, SV1637
1. Deux-Aesbijbel (1562), DA1562
1. Herziene Statenvertaling (2010), HSV
1. Friese Bijbel 1943 (Wumkes-Folkertsma), FB43
1. Nije Fryske Bibeloersetting (1978), NFB
1. Biebel (in t Grunnegers) (2008), GRB
1. Biestkensbijbel (1560), BIE1560
1. Liesveltbijbel (1542), LIE1542
1. Lutherse vertaling (1648), LUT1648
1. Leuvense bijbel (1548), LEU1548
1. Vorstermanbijbel (1528/1531), VOR1531
1. Delftse bijbel (1477), DEL1477
1. Lithuanian, LIT

 
== Changelog ==
*	1.8: added 13 new bible translations (read FAQ) and fixed some bible verses detection problems
*	1.7.11: tested for 3.5.2
*   1.7.10: fixed some CSS issues in IE7, IE8 and webkit browsers (Safari & Chrome) - look at http://wordpress.org/support/topic/248735?replies=5
			added option to open link in new window
			extended the syntax of bible reference to include a dot following the book name, for example: 1 Cor. 13,1-12
*   1.7.9: tested for Wordpress 2.9
*   1.7.8: added support for Wordpress 2.5 & 2.7
*   1.7.7: fixed a potentially vulnerable POST request processing.   
*   1.7.6: fixed a bug regarding a RSS feed validation.   
*   1.7.5: added the possibility to display bible text inline instead of in a layer above the post.   
*   1.7.4: plugin no more relies on the presence of wp_head tag in the header of the theme and correctly displays formatting even if no wp_head is present   
*   1.7.3: fixed a bug displaying only the first of two or more exactly same references that were used in the same post   
*   1.7.2: added option to make only a hyperlink to biblical text (instead of displaying the biblical text in a layer above the post/page) and fixed a bug where the layer didn't get displayed above some of the elements of the page 
*   1.7.1: fixed a bug that prevented linking references like John 5:6-6:3 
*   1.7: added i18n of the admin interface (previously only in English), users invited to translate POT file for their locale and send it to me 
*   1.6: added support for 38 different bible versions in 14 languages (previous versions supported only Slovenian).
*   1.5: changed the registration of the plugin
*   1.4: no more adding bible text in RSS feed, only linking
*   1.3: added dashboard tab for plugin which checks for plugin updates
*   1.2: formatting now in a separate CSS file.
*   1.1: plugin now get the actual bible text from BIBLIJA.net and shows it in the posts/pages.
*   1.0: first public version which only linked the passages to BIBLIJA.net

Versions in between were minor changes and bug fixes.

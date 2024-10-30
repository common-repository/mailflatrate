=== mailflatrate ===
Contributors: smsmfr
Donate link: 
Tags: mailflatrate, email, marketing, newsletter, subscribe, widget, mailflatrate form
Requires at least: 4.1
Tested up to: 5.5.1
Stable tag: 4.3.3
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 5.2.4

mailflatrate for wordPress, the #1 mailflatrate plugin.

== Description ==

Dieses Plugin hilft dir, deine Abonnenten Listen zu erweitern und zu verwalten. Du kannst mit dem Plugin von mailflatrate ansprechende Opt-in-Formulare erstellen oder ein bereits bestehendes Formular auf deiner Webseite integrieren und mit deinem mailflatrate Konto verknupfen.

-        Verbinde dich in Sekundenschnelle mit deinem mailflatrate Konto.
-        Ansprechende und benutzerfreundliche Anmeldeformulare: Du hast die volle Kontrolle uber die Formularfelder und kannst alle Informationen automatisch an dein mailflatrate Konto
senden lassen.

Mit mailflatrate erreichst du deine Kunden - zu jeder Zeit und von uberall! Als Newsletter
Dienstleister ist es uns wichtig, dass du so effizient wie moglich deine Ziele erreichst. Versende 30 Tage kostenlos unbegrenzt viele Emails an deine Kontakte und lasse sie an deinem Unternehmen teilhaben. mailflatrate ist der bevorzugte Newsletter-Service fur Tausende von Unternehmen.
Dieses Plugin ermoglicht eine sichere Verbindung zwischen deiner WordPress-Seite und deinem mailflatrate Konto.

Falls du mailflatrate bisher noch nicht nutzt, erstelle jetzt einen kostenlosen Account in nur 30 Sekunden.

== Installation ==

#### Installing the plugin
1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for **Mailflatrate** and click "*Install now*"
1. Alternatively, download the plugin and upload the contents of `mailflatrate.zip` to your plugins directory, which usually is `/wp-content/plugins/`.
1. Activate the plugin
1. Set [your API key](https://www.app.mailflatrate.com/customer/account/index?type=api) in the plugin settings.

#### Configuring Sign-Up Form(s)
1. Go to *Mailflatrate > Forms*
2. Select at least one list to subscribe people to.
3. *(Optional)* Add more fields to your form.
4. Embed a sign-up form in pages or posts using the `[mailflatrate]` shortcode.

== Frequently Asked Questions ==

#### How to display a form in posts or pages?
Use the `[mailflatrate]` shortcode.

#### Where can I find my API key to connect to Mailflatrate?
[You can find your API key here after register in your mailflatrate account](https://www.app.mailflatrate.com/customer/account/index?type=api)

#### How user data will send to mailflatrate account list?
your data will be send by mailflatrate api keys using curl method.

#### The form shows a success message but subscribers are not added to my list(s)?
If the form shows a success message, there is no doubt that the sign-up request succeeded. Mailflatrate could have a slight delay sending the confirmation email though, please just be patient.

#### How can I style the sign-up form?
You can use custom CSS to style the sign-up form if you do not like the themes that come with the plugin. The following selectors can be used to target the various form elements.

`
.mailflatrate-form { ... } /* the form element */
.mailflatrate-form p { ... } /* form paragraphs */
.mailflatrate-form label { ... } /* labels */
.mailflatrate-form input { ... } /* input fields */
.mailflatrate-form input[type="checkbox"] { ... } /* checkboxes */
.mailflatrate-form input[type="submit"] { ... } /* submit button */
`

You can add your custom CSS to your theme stylesheet.

#### I'm getting an "HTTP Error" when trying to connect to Mailflatrate

If you're getting an `HTTP Error` after entering your API key, please contact your webhost and ask them if they have PHP CURL installed and updated to the latest version (7.58.x). Make sure requests to `https://www.app.mailflatrate.com/api/` are allowed as well.

#### My question is not listed

Please feel free to contact mailflatrate support[https://www.app.mailflatrate.com/customer/support-tickets/index] from your mailflatrate account.

== Other Notes ==

#### Support

Hier kannst du den
mailflatrate Support kontaktieren: 
[https://www.app.mailflatrate.com/customer/support-tickets/index]
Hier findest du
unseren Datenschutz:
[https://www.mailflatrate.com/datenschutz/]
Und unser
Impressum: [https://www.mailflatrate.com/impressum/]

== Screenshots ==
1. Connect plugin to mailflatrate server using api keys.
2. Create own form using html editor or click on field button
3. Save custom html form.
4. you can set messages for success and error both.
5. user can submit email and it will automatically add mailflatrate list.
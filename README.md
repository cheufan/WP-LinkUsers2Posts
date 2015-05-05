http://cheufan.github.io/WP-LinkUsers2Posts/

# WP-LinkUsers2Posts
A very simple Wordpress plugin to associate many users with posts.

## Installation
Like all other wordpress plugin's :
Create a folder and  named it **"wp-linkusers2posts"**, put all files into this folder. Go to **Admin zone**-> **Plugins** and click on **Activate plugin**.

## How to use
To use it, you just have to write a shortcode on article or page.
[lu2p_form] display a button to register or unregister.
[lu2p_users] display list of associate users.
e.g
* [lu2p_form] : display form to register/unregister the current post/page.
* [lu2p_form url="http://www.example.com/your-post"] : display form to register/unregister the post/page specify by url.
* [lu2p_form max_date="2015/05/20"] : display form till max_date.
* [lu2p_users] display list of associate users. (no options availables)

## Compatibility
I have test only with WP 4.1

## I18n
I wrote this plugin in english and translate it in french with gettext.

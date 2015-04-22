# WP-LinkUsers2Posts
A very simple Wordpress plugin to associate many users with posts.

## Installation
Like all other wordpress plugin's :
Create a folder and  named it **"wp-linkusers2posts"**, put all files into this folder. Go to **Admin zone**-> **Plugins** and click on **Activate plugin**.

## How to use
To use it, you just have to write a shortcode on article or page.
[lu2p_form] display a button to register or unregister.
[lu2p_list] display list of asssociate users.
e.g
* [lu2p_form] : display form to register/unregister for the current post/page.
* [lu2p_form url="http://www.example.com/your-post"] : display form to register/unregister for the post/page specify by url.
* [lu2p_form max_date="11/05/2015] : display form while max_date isn't past. 
* [lu2p_users] display list of asssociate users. (no options availables)

## Compatibility
I have only test with WP 4.1

## I18n
This plugin is write in english and translate in french with gettext.

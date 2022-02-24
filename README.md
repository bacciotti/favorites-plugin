# LOG Favorites Plugin
**Description:** Mark a post as a favorite and shows the favorites list on Widget or Shortcode.  
**Version:** 1.0.0  
**Author:** Lucas Bacciotti Moreira  
**Author URI:** https://profiles.wordpress.org/baciotti/  

### System details
- PHP: 7.4.27 
- XAMPP: 7.4.27
- Wordpress: 5.9.1
- Composer
- Git & GitHub

### Used Libs/Plugins
- https://github.com/WP-API/Basic-Auth.
- PHPCS - CodeSniffer.
- WPCS - WordPress Code Standards.
- PHPCBF - CodeBeautifier.
- PHPUnit 9.0.0 (need improvements)

### How does this plugin work?
- You can mark a post (only posts!) as favorite (bookmark) with the custom field on the sidebar on posts edit page.
- In addition, you can use a Shortcode and/or a Widget to show a list of Favorited (bookmarked) posts on Frontend.
- The favorite (bookmarked) posts have a filled star after its contents.

### Future work | To-Do
- Finish REST API calls.
- Improve autoload class.
- Improve testing.

### Contribute | Support
Please, contact the author.

### FAQ
- **Why the project dont have WP PHPUnit lib?**  
A: Because it would take a long time preparing the enviornment, once I am using Windows and WP-CLI/WP Testing Tools needs bash (Linux).
- **Can I install the plugin with Composer?**  
A: Yes, just insert in your `composer.json file`. 

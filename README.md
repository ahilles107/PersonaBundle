Introduction
============

This Bundle enables integration of the BrowserID authentication system. 
It provides a Symfony2 authentication provider so that users can login to a Symfony2 application via BrowserID.

Installation
============

  1. Install bundle:

    The recommended way to install Newscoop PHP-SDK is [throughcomposer](http://getcomposer.org). Just create a `composer.json` file and run the `php composer.phar install` command to install it:

    {
        "require": {
            "ahs/browserid-bundle": "*"
        }
    }

  2. Add this bundle to your application's kernel:

          // app/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new AHS\BrowserIDBundle\AHSBrowserIDBundle(),
                  // ...
              );
          }  

  3. Configure your new firewal:

          # application/config/security.yml
          firewalls:
              browserid_secured:
                  pattern:    ^/
                  browserid:      true
                  logout: true
                  anonymous: true
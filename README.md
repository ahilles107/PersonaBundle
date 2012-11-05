Introduction
============

This Bundle enables integration of the BrowserID authentication system. 
It provides a Symfony2 authentication provider so that users can login to a Symfony2 application via BrowserID.

Installation
============

  1. Add this bundle to your ``vendor/`` dir:

      * Using git submodules.

            $ git submodule add git://github.com/flywithmonkey/BrowserIDBundle vendor/bundles/AHS/BrowserIDBundle

  2. Add the FOS namespace to your autoloader:

          // app/autoload.php
          $loader->registerNamespaces(array(
                'AHS' => __DIR__.'/../vendor/bundles',
                // your other namespaces
          ));

  3. Add this bundle to your application's kernel:

          // app/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new AHS\BrowserIDBundle\AHSBrowserIDBundle(),
                  // ...
              );
          }  

  4. Configure your new firewal:

          # application/config/security.yml
          firewalls:
            browserid_secured:
              pattern:    ^/
              browserid:      true
              logout: true
              anonymous: true
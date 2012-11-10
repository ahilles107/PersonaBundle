Introduction
============

This Bundle enables integration of the Persona authentication system. 
It provides a Symfony2 authentication provider so that users can login to a Symfony2 application via Persona.

Installation
============

  1. Install bundle:

  The recommended way to install Persona Bundle is [through composer](http://getcomposer.org). Just create a `composer.json` file and run the `php composer.phar install` command to install it:

          {
              "require": {
                  "ahs/persona-bundle": "*"
              }
          }

  2. Add this bundle to your application's kernel:

          // app/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new AHS\PersonaBundle\AHSPersonaBundle(),
                  // ...
              );
          }  

  3. Configure your new firewal:

          # application/config/security.yml
          firewalls:
              persona_secured:
                  pattern:    ^/
                  persona:      true
                  logout: true
                  anonymous: true

## TODO

* Provide sample controller
* Provide twig helper for login/logout buttons
* Create provider for FOSUserBundle
* Promote Mozilla Persona!
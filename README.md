Introduction
============

This Bundle enables integration of the BrowserID authentication system. 
It provides a Symfony2 authentication provider so that users can login 
to a Symfony2 application via BrowserID.

Installation
============

  1. Add this bundle to your ``vendor/`` dir:

      * Using git submodules.

            $ git submodule add git://github.com/flywithmonkey/BrowserIDBundle vendor/bundles/FWM/BrowserIDBundle

  2. Add the FOS namespace to your autoloader:

          // app/autoload.php
          $loader->registerNamespaces(array(
                'FWM' => __DIR__.'/../vendor/bundles',
                // your other namespaces
          ));

  3. Add this bundle to your application's kernel:

          // app/ApplicationKernel.php
          public function registerBundles()
          {
              return array(
                  // ...
                  new FWM\BrowserIDBundle\FWMBrowserIDBundle(),
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

Include the login button in your templates
------------------------------------------

In this example we will use Flexpi.com api. Register and add app here - http://flexpi.com/register
Just add the following code in one of your templates:

    <head>
      <script src="http://flexpi.com/api/beta/flexpi.min.js"></script>
      // add jquery 
      <script type="text/javascript">
        flex.connect({
          app_id : 'YourAppId'
        }, function(){
          flex.social.browserid.init();
          $('.loginPage #browserid').click(function(){
            flex.social.browserid.login(function(result, data, assertion) {
              if(result === true) {
                // Send hidden form, or ajax request to page behind "browserid_secured" firewall
                // Request must have 'browserid-assertion' post parameter with 'assertion' as value
              }
            });
            return false;
          })
        });
      </script>

      <body>
        ...
        <a href="#" id="browserid" title="Sign-in with BrowserID"> 
          <img alt="Sign-in with BrowserID" src="https://browserid.org/i/sign_in_blue.png"> with BrowserID
        </a>

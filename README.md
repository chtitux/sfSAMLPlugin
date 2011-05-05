README
================================
sfSAMLPlugin is a symfony plugin that allow you to interface SAML with sfDoctrineGuardPlugin.

sfSAMLPlugin uses simpleSAMLPhp ( http://simplesamlphp.org/ ) for dealing with the Identity Provider (IdP).
With sfSAMLPlugin, you symfony application is a Service Provider (SP).


Installation
================================

If you want to install sfSAMLPlugin, follow these steps :

1. get the source there : https://github.com/chtitux/sfSAMLPlugin , decompress it in the plugins/ directory
2. Install sfDoctrineGuardPlugin (just download it and put it in the plugins/ directoy in your symfony application)
3. Download SimpleSAMLphp and decompress it in the ```lib/vendor/``` directory
4. Add these lines in the ```config/ProjectConfiguration.php``` : 

    ```php
    <?php
    // ...
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');

    $this->enablePlugins('sfSAMLPlugin');
    // Load simpleSAMLphp
    require_once dirname(FILE).'/../lib/vendor/simplesamlphp/lib/_autoload.php';
    ```

5. In the ```apps/frontend/config/settings.yml``` , enable at least the modules sfGuardAuth and sfSAMLAuth. You can enable all the modules of sfDoctrineGuardPlugin like that : 

    ```yaml
    all:
      .settings:
    [...]
        # Enable modules
        enabled_modules:        [default, sfGuardAuth, sfSAMLAuth, sfGuardGroup, sfGuardUser, sfGuardPermission]
    ```

6. In your lib/vendor/simplesamlphp/config/config.php Change the config name to "symfony" like that : 

    ```php
       <?php
       // ...
       'session.phpsession.cookiename'  => "symfony", 
    ```

7. Configure your IdP in ```simplesamlphp/metadata/saml20-idp-remote.php```
8. simpleSAMLphp must be visible from the web (the user will be redirected to it). You have to add the following line in your Apache config : 

    ```apache
    Alias /simplesaml /home/data/www/login/lib/vendor/simplesamlphp/www
    ```

9. You can test it with the default routes : 
```/saml/login``` for login, ```/saml/logout``` for logout
10. You can add the default login/logout routes at the end of ```apps/frontend/config/settings.yml``` 

    ```yaml
      .actions:
        login_module:    sfGuardAuth
        login_action:    signin
    ```

And it should work !
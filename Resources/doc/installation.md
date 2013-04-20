Installation
============

1) Installing the bundle
------------------------

Use composer to install this bundle (using the master version)
```
php composer.phar require vincet/admin-configuration-bundle
```

2) Register the bundle
----------------------

In app/appKernel.php add the following line to register the bundle:
```php
[...]
            new VinceT\BaseBundle\VinceTBaseBundle(),
            new VinceT\AdminBundle\VinceTAdminBundle('SonataAdminBundle'),
            new VinceT\BootstrapFormBundle\VinceTBootstrapFormBundle(),
            new Trsteel\CkeditorBundle\TrsteelCkeditorBundle(),
            new VinceT\AdminConfigurationBundle\VinceTAdminConfigurationBundle(),
[...]
```

3) Configure
------------

In app/config/routing.yml add:
```yml
vince_t_admin_configuration:
    resource: "@VinceTAdminConfigurationBundle/Resources/config/routing.yml"
    prefix:   /admin

```

4) Install assets
-----------------

```
php app/console assets:install --symlink
```

The bundle is now installed and you can begin to [**use it**][1].

[1]: https://github.com/vincenttouzet/AdminConfigurationBundle/blob/master/Resources/doc/getting_started.md

VinceTAdminConfigurationBundle
==============================

This bundle add an admin interface to manage custom configuration values that can be used in your frontend application.

A configuration value is store in a group and a group rely to a section. It's easy to get a configuration value by its path :
```
section_name:group_name:value_name
```

To retrieve a value from a controller:
```
$this->container->get('admin.configuration.manager')->get('section_name:group_name:value_name');
```

To retrieve a value from a twig template:
```
{{ admin_configuration_get('section_name:group_name:value_name') }}
```

See how to [**install**][1] and [**use**][2] this bundle.

[1]: Resources/doc/installation.md 
[2]: Resources/doc/getting_started.md
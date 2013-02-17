How to use this bundle :
========================


Configurations values are organized into sections and groups. A section have many groups and a group contains many values.

A value require a Type. At least you must create a section, a group and a type. You can install some types with the following command:
```
php app/console vincet:admin-configuration:install-types
```

You can also [**add a custom type**][1].

Once you have defined at least a section, a group and a type you can add values and then use the administration panel (http://www.example.com/admin/configuration) to change it.

The value can be retrieved with its path `section_name:group_name:value_name`.

To retrieve a value from a controller:
```
$this->container->get('admin.configuration.manager')->get('section_name:group_name:value_name');
```

To retrieve a value from a twig template:
```
{{ admin_configuration_get('section_name:group_name:value_name') }}
```


[1]: https://github.com/vincenttouzet/AdminConfigurationBundle/blob/master/Resources/doc/create_type.md
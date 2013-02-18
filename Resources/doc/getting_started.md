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

Translation
-----------

You can translate the form labels and helps into the VinceTAdminConfigurationBundle catalog.

e.g in src/Acme/DemoBundle/Resources/translations/VinceTAdminConfigurationBundle.fr.yml:
```yml
"My Label": "My translated label"
"My Help": "My translated help"
```

Advanced usage
--------------

It's possible to set the form options on 2 levels :
* On the Type
* On the Value

The options must be a valid json object representing the options array.

For example, if you want to set the years used in a DateTime form type you must set the options like this:
```
{
"years":[2012, 2013]
}
```

An other way to alter the form options is to use a event listener. When creating a form an event is dispatch with the value path and the form options.

Just create the event listener:
```php
<?php

namespace Acme\DemoBundle\EventListener;


class AdminConfigurationListener
{
    public function createOptions($event)
    {
        if ( $event->getPath() === 'general:general:datetime_value' ) {
            $options = $event->getFormOptions();
            $options['years'] = range(1901, date('Y'));
            $event->setFormOptions($options);
        }
    }
}
```

and register this listener in services.yml:
```yml
services:
    kernel.listener.vincet_test_admin_configuration_listener:
        class: Acme\DemoBundle\EventListener\AdminConfigurationListener
        tags:
            - { name: kernel.event_listener, event: admin.configuration.form.options.create, method: createOptions }
```


[1]: https://github.com/vincenttouzet/AdminConfigurationBundle/blob/master/Resources/doc/create_type.md
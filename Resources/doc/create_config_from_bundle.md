Create configurations from bundle
=================================

You can create configuration sections, groups, types and values from your bundle. It can be done in only 3 steps.

1) Create your configuration builder
------------------------------------

```php
<?php

namespace VinceT\DemoBundle\Configuration;

use VinceT\AdminConfigurationBundle\Configuration\AdminConfigurationBuilder;

class DemoConfiguration
{
    public function build(AdminConfigurationBuilder $builder)
    {
        // add a section
        // you can add a third parameter to set the section position
        $builder->addSection('my_section', 'My section');
        // add a group to this section
        // 4th parameter for group position
        $builder->addGroup('my_section', 'my_group', 'My group');
        // create a type based on the text
        // 4th parameter for form options (as array)
        $builder->addType('my_type', 'My type', 'text');
        // create a value
        // 8th parameter for form options
        // 9th parameter for position
        $builder->addValue(
            'my_section', 
            'my_group', 
            'my_value', 
            'my_type',
            'My value',
            'The default value',
            'Help for this field'
        );
    }
}

```

2) Register as a service
------------------------

```yml
services:
    admin.configuration.demo:
        class: VinceT\DemoBundle\Configuration\DemoConfiguration
        tags:
            - { name: admin.configuration }
```

3) Execute the command to generate those entities
-------------------------------------------------

```
php app/console vincet:admin-configuration:update
```
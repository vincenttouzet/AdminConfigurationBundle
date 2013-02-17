Add a custom form type
======================

When you create a configuration type via the administration panel you have to define a form type. You also have to create a custom type for this configuration type that extends the `admin_configuration_configvalue` form type.

For example the Boolean type generated with the `vincet:admin-configuration:install-types` command use the checkbox form type.

An `admin_configuration_configvalue_checkbox` form type is defined...
```php

namespace VinceT\AdminConfigurationBundle\Form\Type;

[...]
use VinceT\AdminConfigurationBundle\Form\DataTransformer\StringToBooleanTransformer;

class ConfigValueCheckboxType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->get('value')->addModelTransformer(new StringToBooleanTransformer('1'));
    }

    public function getParent()
    {
        return 'admin_configuration_configvalue';
    }

    public function getName()
    {
        return 'admin_configuration_configvalue_checkbox';
    }
}
```

... and use a DataTransformer to transform a string (the config value) to a boolean (use in the checkbox form type)
```php

namespace VinceT\AdminConfigurationBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class StringToBooleanTransformer implements DataTransformerInterface
{
    private $trueValue;

    public function __construct($trueValue)
    {
        $this->trueValue = $trueValue;
    }

    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return true;
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return false;
        }

        if (!is_bool($value)) {
            throw new UnexpectedTypeException($value, 'Boolean');
        }

        return true === $value ? $this->trueValue : null;
    }

}

```


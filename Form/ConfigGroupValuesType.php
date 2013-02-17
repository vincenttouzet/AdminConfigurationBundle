<?php

namespace VinceT\AdminConfigurationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfigGroupValuesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['data'] as $configValue) {
            $builder->add(
                $configValue->getPath(),
                'admin_configuration_configvalue_'.$configValue->getConfigType()->getFormType(),
                array(
                    'label' => $configValue->getVLabel(),
                    'data' => $configValue,
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'help' => $configValue->getHelp(),
                    'required' => false,
                )
            );
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    public function getName()
    {
        return 'vincet_adminconfigurationbundle_configgroup_values_type';
    }
}

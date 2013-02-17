<?php
/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */

namespace VinceT\AdminConfigurationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ConfigValueType
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueType extends AbstractType
{

    /**
     * [buildForm description]
     *
     * @param FormBuilderInterface $builder [description]
     * @param array                $options [description]
     *
     * @return [type]
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $configValue = $options['data'];
        $builder
            ->add(
                'value',
                $configValue->getConfigType()->getFormType(),
                array(
                    'label' => $configValue->getVLabel(),
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'required' => false,
                )
            );
    }

    /**
     * [setDefaultOptions description]
     *
     * @param OptionsResolverInterface $resolver [description]
     *
     * @return null
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'VinceT\AdminConfigurationBundle\Entity\ConfigValue',
                'help' => null,
            )
        );
    }

    /**
     * [getName description]
     *
     * @return string
     */
    public function getName()
    {
        return 'admin_configuration_configvalue';
    }
}
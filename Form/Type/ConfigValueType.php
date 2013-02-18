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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use VinceT\AdminConfigurationBundle\Event\AdminConfigurationFormCreateOptionsEvent;
use VinceT\AdminConfigurationBundle\Event\AdminConfigurationEvents;

/**
 * ConfigValueType
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueType extends AbstractType implements ContainerAwareInterface
{
    protected $container = null;

    /**
     * [__construct description]
     *
     * @param ContainerInterface $container [description]
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @return null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

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
        $formOptions = array();
        if ( $configValue->getConfigType()->getOptions()
            && $typeOptions = json_decode($configValue->getConfigType()->getOptions())
        ) {
            $typeOptions = get_object_vars($typeOptions);
            $formOptions = array_merge($formOptions, $typeOptions);
        }
        if ( $configValue->getOptions()
            && $valueOptions = json_decode($configValue->getOptions())
        ) {
            $valueOptions = get_object_vars($valueOptions);
            $formOptions = array_merge($formOptions, $valueOptions);
        }
        $defaultFormOptions = array(
            'label' => $this->container->get('translator')->trans($configValue->getVLabel(), array(), 'VinceTAdminConfigurationBundle'),
            'label_attr' => array(
                'class' => 'control-label'
            ),
            'required' => false,
        );
        $formOptions = array_merge($formOptions, $defaultFormOptions);


        $dispatcher = $this->container->get('event_dispatcher');

        $event = new AdminConfigurationFormCreateOptionsEvent($configValue->getPath(), $formOptions);
        $dispatcher->dispatch(AdminConfigurationEvents::ADMIN_CONFIGURATION_FORM_OPTIONS_CREATE, $event);

        $formOptions = $event->getFormOptions();

        $builder
            ->add(
                'value',
                $configValue->getConfigType()->getFormType(),
                $formOptions
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
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

namespace VinceT\AdminConfigurationBundle\Form\Type\Bootstrap;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ConfigValueBootstrapColorPickerType
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueBootstrapColorPickerType extends AbstractType
{
    /**
     * [getName description]
     *
     * @return string
     */
    public function getParent()
    {
        return 'admin_configuration_configvalue_text';
    }

    /**
     * [getName description]
     *
     * @return string
     */
    public function getName()
    {
        return 'admin_configuration_configvalue_bootstrap_colorpicker';
    }
}
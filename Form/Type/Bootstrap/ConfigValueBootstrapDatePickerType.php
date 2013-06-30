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

/**
 * ConfigValueBootstrapDatePickerType
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueBootstrapDatePickerType extends AbstractType
{
    /**
     * [getName description]
     *
     * @return string
     */
    public function getParent()
    {
        return 'admin_configuration_configvalue_datetime';
    }

    /**
     * [getName description]
     *
     * @return string
     */
    public function getName()
    {
        return 'admin_configuration_configvalue_bootstrap_datepicker';
    }
}

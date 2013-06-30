<?php
/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminConfigurationBundle\Configuration;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Pool
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class Pool implements ContainerAwareInterface
{
    private $_configurations = array();

    protected $container = null;

    /**
     * __construct
     *
     * @param ContainerInterface $container A ContainerInterface instance
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
     * Add a configuration
     *
     * @param [type] $id         [description]
     * @param [type] $attributes [description]
     *
     * @return VinceT\AdminConfigurationBundle\Configuration\Pool
     */
    public function add($id, $attributes)
    {
        $this->_configurationIds[$id] = $attributes;

        return $this;
    }

    /**
     * Gets Configurations
     *
     * @return array
     */
    public function getConfigurations()
    {
        return $this->_configurations;
    }

    /**
     * Sets Configurations
     *
     * @param array $configurations Configurations
     *
     * @return VinceT\AdminConfigurationBundle\Configuration\Pool
     */
    public function setConfigurations(array $configurations)
    {
        $this->_configurations = $configurations;

        return $this;
    }

}

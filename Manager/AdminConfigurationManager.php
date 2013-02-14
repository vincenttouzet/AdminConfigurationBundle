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

namespace VinceT\AdminConfigurationBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use VinceT\AdminConfigurationBundle\Exception\AdminConfigurationException;

/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class AdminConfigurationManager implements ContainerAwareInterface
{
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
     * Gets a value from a path configuration
     *     <section_name>:<group_name>:<value_name>
     *
     * @param string $path [description]
     *
     * @return string|null
     */
    public function get($path)
    {
        return $this->container->get('admin.configuration.configvalue_manager')->get($path);
    }

    /**
     * Set the value of config value
     *
     * @param string $path  [description]
     * @param string $value [description]
     *
     * @return null
     */
    public function set($path, $value)
    {
        $this->container->get('admin.configuration.configvalue_manager')->set($path, $value);
    }

    /**
     * Check if a name is valid
     *
     * @param string $name [description]
     *
     * @return Boolean
     */
    public function nameIsValid($name)
    {
        return preg_match('/^[a-z_]*$/', $name);
    }

    /**
     * [checkName description]
     *
     * @param [type] $name [description]
     *
     * @return [type]
     */
    public function checkName($name)
    {
        if ( !$this->nameIsValid($name) ) {
            $message = $this->container->get('translator')->trans(
                'A name must only contains lowercase (a-z) and underscores (_).', 
                array(), 
                'VinceTAdminConfigurationBundle'
            );
            throw new AdminConfigurationException($message, 1);
        }
    }

}

<?php
/**
 * This file is part of VinceTAdminBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminConfigurationBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * VinceTAdminExtension
 *
 * @category VinceT
 * @package  VinceTAdminBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class AdminConfigurationExtension extends \Twig_Extension implements ContainerAwareInterface
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
     * Gets functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'admin_configuration_get' => new \Twig_Function_Method($this, 'getValue'),
        );
    }

    /**
     * Get a configuration value
     *
     * @param string $path Path to the configuration value
     *
     * @return string
     */
    public function getValue($path)
    {
        return $this->container->get('admin.configuration.manager')->get($path);
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'admin_configuration';
    }

}

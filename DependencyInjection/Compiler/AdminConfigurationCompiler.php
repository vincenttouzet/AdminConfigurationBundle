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

namespace VinceT\AdminConfigurationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * AdminConfigurationCompiler
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class AdminConfigurationCompiler implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param ContainerBuilder $container Container builder
     *
     * @return null
     */
    public function process(ContainerBuilder $container)
    {
        $pool = $container->getDefinition('admin.configuration.pool');
        // get tagged services
        $configurations = array();
        foreach ($container->findTaggedServiceIds('admin.configuration') as $id => $attributes) {
            $configurations[$id] = $attributes;
        }
        $pool->addMethodCall('setConfigurations', array($configurations));
    }
} 
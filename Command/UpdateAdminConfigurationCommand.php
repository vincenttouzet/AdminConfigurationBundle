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

namespace VinceT\AdminConfigurationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * UpdateAdminConfigurationCommand
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class UpdateAdminConfigurationCommand extends ContainerAwareCommand
{
    /**
     * configure command
     *
     * @return null
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('vincet:admin-configuration:update')
            ->setDescription('Update admin configuration')
            ->setHelp(
<<<EOF
The <info>vincet:admin-configuration:update</info> command update admin configuration.
EOF
            );
    }

    /**
     * execute command
     *
     * @param InputInterface  $input  InputInterface instance
     * @param OutputInterface $output OutputInterface instance
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $configBuilder = $container->get('admin.configuration.configbuilder');
        $pool = $container->get('admin.configuration.pool');
        foreach ($pool->getConfigurations() as $id => $attributes) {
            $config = $container->get($id);
            $config->build($configBuilder);
        }
    }

}
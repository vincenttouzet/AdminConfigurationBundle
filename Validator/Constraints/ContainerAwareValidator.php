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

namespace VinceT\AdminConfigurationBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Name Validator
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
abstract class ContainerAwareValidator extends ConstraintValidator implements ContainerAwareInterface
{
    protected $container = null;

    /**
     * Set the service container
     *
     * @param ContainerInterface $container The service container
     *
     * @return null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}

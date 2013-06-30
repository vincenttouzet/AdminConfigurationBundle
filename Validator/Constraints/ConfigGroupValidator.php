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

/**
 * Name Validator
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigGroupValidator extends ContainerAwareValidator
{
    /**
     * Validate the group
     *
     * @param string     $group      [description]
     * @param Constraint $constraint [description]
     *
     * @return null
     */
    public function validate($group, Constraint $constraint)
    {
        $check = $this->container->get('admin.configuration.configgroup_manager')->getRepository()->findOneBySectionAndGroupName($group->getConfigSection()->getName(), $group->getName());
        if ( $check && $check->getId() != $group->getId()) {
            $message = $this->container->get('translator')->trans(
                $constraint->message,
                array(
                    '%group%' => $group->getName(),
                    '%section%' => $group->getConfigSection()->getName()
                ),
                'VinceTAdminConfigurationBundle'
            );
            $this->context->addViolation($message);
        }
    }
}

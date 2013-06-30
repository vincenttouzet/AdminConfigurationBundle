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
class ConfigValueValidator extends ContainerAwareValidator
{
    /**
     * Validate the value
     *
     * @param string     $value      [description]
     * @param Constraint $constraint [description]
     *
     * @return null
     */
    public function validate($value, Constraint $constraint)
    {
        $check = $this->container->get('admin.configuration.configvalue_manager')->getRepository()->findOneBySectionGroupAndValueName(
            $value->getConfigGroup()->getConfigSection()->getName(),
            $value->getConfigGroup()->getName(),
            $value->getName()
        );
        if ( $check && $check->getId() != $value->getId()) {
            $message = $this->container->get('translator')->trans(
                $constraint->message,
                array(
                    '%value%' => $value->getName(),
                    '%group%' => $value->getConfigGroup()->getName(),
                    '%section%' => $value->getConfigGroup()->getConfigSection()->getName()
                ),
                'VinceTAdminConfigurationBundle'
            );
            $this->context->addViolation($message);
        }
    }
}

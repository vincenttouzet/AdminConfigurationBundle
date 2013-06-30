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
class IsValidNameValidator extends ContainerAwareValidator
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
        if ( !preg_match('/^[a-z0-9_]+$/', $value) ) {
            $message = $this->container->get('translator')->trans($constraint->message, array('%string%' => $value), 'VinceTAdminConfigurationBundle');
            $this->context->addViolation($message);
        }
    }
}

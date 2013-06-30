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
class ConfigSectionValidator extends ContainerAwareValidator
{
    /**
     * Validate the section
     *
     * @param string     $section      [description]
     * @param Constraint $constraint [description]
     *
     * @return null
     */
    public function validate($section, Constraint $constraint)
    {
        $check = $this->container->get('admin.configuration.configsection_manager')->getRepository()->findOneByName($section->getName());
        if ( $check && $check->getId() !== $section->getId() ) {
            $message = $this->container->get('translator')->trans(
                $constraint->message,
                array(
                    '%section%' => $section->getName()
                ),
                'VinceTAdminConfigurationBundle'
            );
            $this->context->addViolation($message);
        }
    }
}

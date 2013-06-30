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
 * Name constraint
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 * @Annotation
 */
class ConfigGroup extends Constraint
{
    public $message = 'A group "%group%" already exist in section "%section%".';

    /**
     * [getTargets description]
     *
     * @return [type]
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * validatedBy
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'vince_t_admin_configgroup_validator';
    }
}

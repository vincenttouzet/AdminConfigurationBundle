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

use VinceT\BaseBundle\Manager\BaseManager;
use VinceT\AdminConfigurationBundle\Exception\AdminConfigurationException;

/**
 * ConfigGroupManager
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigGroupManager extends BaseManager
{
    /**
     * [preCreate description]
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $object [description]
     *
     * @return [type]
     */
    public function preCreate($object)
    {
        $this->_checkName($object);
    }

    /**
     * [preUpdate description]
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $object [description]
     *
     * @return [type]
     */
    public function preUpdate($object)
    {
        $this->_checkName($object);
    }

    /**
     * Check if the section with the same name exists
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $group [description]
     *
     * @return null
     */
    private function _checkName($group)
    {
        $this->container->get('admin.configuration.manager')->checkName($group->getName());
        $check = $this->getRepository()->findOneBySectionAndGroupName($group->getConfigSection()->getName(), $group->getName());
        if ( $check && $check->getId() != $group->getId()) {
            $message = $this->container->get('translator')->trans(
                'A group "%group%" already exist in section "%section%".', 
                array(
                    '%group%' => $group->getName(),
                    '%section%' => $group->getConfigSection()->getName()
                ), 
                'VinceTAdminConfigurationBundle'
            );
            throw new AdminConfigurationException($message, 1);
        }
    }
}
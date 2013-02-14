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
 * ConfigSectionManager
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigSectionManager extends BaseManager
{
    /**
     * [preCreate description]
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigSection $object [description]
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
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigSection $object [description]
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
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigSection $section [description]
     *
     * @return null
     */
    private function _checkName($section)
    {
        $this->container->get('admin.configuration.manager')->checkName($section->getName());
        $check = $this->getRepository()->findOneByName($section->getName());
        if ( $check && $check->getId() !== $section->getId() ) {
            $message = $this->container->get('translator')->trans(
                'The section "%section%" already exist.', 
                array(
                    '%section%' => $section->getName()
                ), 
                'VinceTAdminConfigurationBundle'
            );
            throw new AdminConfigurationException($message, 1);
        }
    }
}
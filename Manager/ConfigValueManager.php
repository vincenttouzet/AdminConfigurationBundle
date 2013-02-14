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
 * ConfigValueManager
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueManager extends BaseManager
{

    /**
     * Gets a value from a path configuration
     *     <section_name>:<group_name>:<value_name>
     *
     * @param string $path [description]
     *
     * @return string|null
     */
    public function get($path)
    {
        $configValue = $this->getRepository()->findOneByPath($path);
        if ( $configValue ) {
            return $configValue->getValue();
        }
        return null;
    }

    /**
     * Set the value of config value
     *
     * @param string $path  [description]
     * @param string $value [description]
     *
     * @return null
     */
    public function set($path, $value)
    {
        $configValue = $this->getRepository()->findOneByPath($path);
        if ( $configValue ) {
            $configValue->setValue($value);
            $this->update($configValue);
        }
    }
    
    /**
     * [preCreate description]
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigValue $object [description]
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
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigValue $object [description]
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
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigValue $value [description]
     *
     * @return null
     */
    private function _checkName($value)
    {
        $this->container->get('admin.configuration.manager')->checkName($value->getName());
        $check = $this->getRepository()->findOneBySectionGroupAndValueName(
            $value->getConfigGroup()->getConfigSection()->getName(), 
            $value->getConfigGroup()->getName(),
            $value->getName()
        );
        if ( $check && $check->getId() != $value->getId()) {
            $message = $this->container->get('translator')->trans(
                'A value "%value%" already exist in group "%group%" under section "%section%".', 
                array(
                    '%value%' => $value->getName(),
                    '%group%' => $value->getConfigGroup()->getName(),
                    '%section%' => $value->getConfigGroup()->getConfigSection()->getName()
                ), 
                'VinceTAdminConfigurationBundle'
            );
            throw new AdminConfigurationException($message, 1);
        }
    }
}
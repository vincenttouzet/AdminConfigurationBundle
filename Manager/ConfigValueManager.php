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
}

<?php
/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */

namespace VinceT\AdminConfigurationBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event thrown when the admin menu is created
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class AdminConfigurationFormCreateOptionsEvent extends Event
{
    protected $formOptions;
    protected $path;

    /**
     * __construct
     *
     * @param string $path        [description]
     * @param array  $formOptions [description]
     */
    public function __construct($path, array $formOptions)
    {
        $this->path = $path;
        $this->formOptions = $formOptions;
    }

    /**
     * Gets Path
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }    

    /**
     * Gets the formOptions
     *
     * @return array
     */
    public function getFormOptions()
    {
        return $this->formOptions;
    }
    
    /**
     * Sets FormOptions
     * 
     * @param array $formOptions FormOptions
     * 
     * @return VinceT\AdminConfigurationBundle\Event\AdminConfigurationFormCreateOptionsEvent
     */
    public function setFormOptions($formOptions)
    {
        $this->formOptions = $formOptions;
        return $this;
    }
    
}
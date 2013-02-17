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

namespace VinceT\AdminConfigurationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ConfigType
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 * @ORM\Table(name="admin_configuration_type")
 * @ORM\Entity(repositoryClass="VinceT\AdminConfigurationBundle\Repository\ConfigTypeRepository")
 */
class ConfigType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tlabel", type="string", length=255)
     */
    private $tlabel;

    /**
     * @var string
     *
     * @ORM\Column(name="formType", type="string", length=255)
     */
    private $formType;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="text", nullable=true)
     */
    private $options;

    /**
     * @ORM\OneToMany(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigValue", mappedBy="configType")
     */
    protected $configValues;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tlabel
     *
     * @param string $tlabel Label
     * 
     * @return ConfigType
     */
    public function setTlabel($tlabel)
    {
        $this->tlabel = $tlabel;
    
        return $this;
    }

    /**
     * Get tlabel
     *
     * @return string 
     */
    public function getTlabel()
    {
        return $this->tlabel;
    }

    /**
     * Set formType
     *
     * @param string $formType FormType name
     * 
     * @return ConfigType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    
        return $this;
    }

    /**
     * Get formType
     *
     * @return string 
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * Gets Options
     * 
     * @return [type]
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Sets Options
     * 
     * @param [type] $options Options
     * 
     * @return [type]
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
    

    /**
     * Add configValues
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigValue $configValue ConfigValue
     * 
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigGroup
     */
    public function addConfigValue(\VinceT\AdminConfigurationBundle\Entity\ConfigValue $configValue)
    {
        $this->configValues[] = $configValue;
    
        return $this;
    }

    /**
     * Remove configValues
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigValue $configValue ConfigValue
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigGroup
     */
    public function removeConfigValue(\VinceT\AdminConfigurationBundle\Entity\ConfigValue $configValue)
    {
        $this->configValues->removeElement($configValue);
    }

    /**
     * Get configValues
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getConfigValues()
    {
        return $this->configValues;
    }

    /**
     * [__toString description]
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTlabel();
    }
}

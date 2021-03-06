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
use VinceT\AdminConfigurationBundle\Validator\Constraints as AdminConfigurationAssert;

/**
 * ConfigValue
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 *
 * @ORM\Table(name="admin_configuration_value")
 * @ORM\Entity(repositoryClass="VinceT\AdminConfigurationBundle\Repository\ConfigValueRepository")
 * @AdminConfigurationAssert\ConfigValue
 */
class ConfigValue
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
     * @ORM\ManyToOne(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigGroup", inversedBy="configValues")
     * @ORM\JoinColumn(name="group_id", nullable=false)
     */
    protected $configGroup;

    /**
     * @ORM\ManyToOne(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigType", inversedBy="configValues")
     * @ORM\JoinColumn(name="type_id", nullable=false)
     */
    protected $configType;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @AdminConfigurationAssert\IsValidName
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="vlabel", type="string", length=255)
     */
    private $vlabel;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value = null;

    /**
     * @var string
     *
     * @ORM\Column(name="help", type="string", nullable=true)
     */
    private $help;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="text", nullable=true)
     */
    private $options;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->position = 0;
    }

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
     * Set configGroup
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup ConfigGroup
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigValue
     */
    public function setConfigGroup(\VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup)
    {
        $this->configGroup = $configGroup;

        return $this;
    }

    /**
     * Get configGroup
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigGroup
     */
    public function getConfigGroup()
    {
        return $this->configGroup;
    }

    /**
     * Set configType
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigType $configType ConfigType
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigValue
     */
    public function setConfigType(\VinceT\AdminConfigurationBundle\Entity\ConfigType $configType)
    {
        $this->configType = $configType;

        return $this;
    }

    /**
     * Get configType
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigType
     */
    public function getConfigType()
    {
        return $this->configType;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return ConfigValue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set vlabel
     *
     * @param string $vlabel Label
     *
     * @return ConfigValue
     */
    public function setVlabel($vlabel)
    {
        $this->vlabel = $vlabel;

        return $this;
    }

    /**
     * Get vlabel
     *
     * @return string
     */
    public function getVlabel()
    {
        return $this->vlabel;
    }

    /**
     * Set value
     *
     * @param string $value Value
     *
     * @return ConfigValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Gets Help
     *
     * @return [type]
     */
    public function getHelp()
    {
        return $this->help;
    }

    /**
     * Sets Help
     *
     * @param [type] $help Help
     *
     * @return [type]
     */
    public function setHelp($help)
    {
        $this->help = $help;

        return $this;
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
     * Set position
     *
     * @param integer $position Position
     *
     * @return ConfigValue
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Return the path for this ConfigValue
     *
     * @return string
     */
    public function getPath()
    {
        $sname = '';
        $gname = '';
        $vname = $this->getName();
        if ( $this->getConfigGroup() ) {
            if ( $this->getConfigGroup()->getConfigSection() ) {
                $sname = $this->getConfigGroup()->getConfigSection()->getName();
            }
            $gname = $this->getConfigGroup()->getName();
        }

        return sprintf(
            '%s:%s:%s',
            $sname,
            $gname,
            $vname
        );
    }

    /**
     * [__toString description]
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPath();
    }
}

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
 * ConfigGroup
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 * @ORM\Table(name="admin_configuration_group")
 * @ORM\Entity(repositoryClass="VinceT\AdminConfigurationBundle\Repository\ConfigGroupRepository")
 * @AdminConfigurationAssert\ConfigGroup
 */
class ConfigGroup
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
     * @ORM\ManyToOne(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigSection", inversedBy="configGroups")
     * @ORM\JoinColumn(name="section_id", nullable=false)
     */
    protected $configSection;

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
     * @ORM\Column(name="glabel", type="string", length=255)
     */
    private $glabel;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigValue", mappedBy="configGroup")
     */
    protected $configValues;

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
     * Set configSection
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigSection $configSection ConfigSection
     *
     * @return Association
     */
    public function setConfigSection(\VinceT\AdminConfigurationBundle\Entity\ConfigSection $configSection)
    {
        $this->configSection = $configSection;

        return $this;
    }

    /**
     * Get configSection
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigSection
     */
    public function getConfigSection()
    {
        return $this->configSection;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return ConfigGroup
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
     * Set glabel
     *
     * @param string $glabel Label
     *
     * @return ConfigGroup
     */
    public function setGlabel($glabel)
    {
        $this->glabel = $glabel;

        return $this;
    }

    /**
     * Get glabel
     *
     * @return string
     */
    public function getGlabel()
    {
        return $this->glabel;
    }

    /**
     * Set position
     *
     * @param integer $position Position
     *
     * @return ConfigGroup
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
        $slabel = '';
        if ( $this->getConfigSection() ) {
            $slabel = $this->getConfigSection()->getSlabel();
        }
        $glabel = $this->getGlabel();

        return sprintf(
            '%s > %s',
            $slabel,
            $glabel
        );
    }
}

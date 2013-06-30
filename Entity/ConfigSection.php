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
 * ConfigSection
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 * @ORM\Table(name="admin_configuration_section")
 * @ORM\Entity(repositoryClass="VinceT\AdminConfigurationBundle\Repository\ConfigSectionRepository")
 * @AdminConfigurationAssert\ConfigSection
 */
class ConfigSection
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
     * @ORM\Column(name="name", type="string", length=255)
     * @AdminConfigurationAssert\IsValidName
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slabel", type="string", length=255)
     */
    private $slabel;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="VinceT\AdminConfigurationBundle\Entity\ConfigGroup", mappedBy="configSection")
     */
    protected $configGroups;

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
     * Set name
     *
     * @param string $name Name
     *
     * @return ConfigSection
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
     * Set slabel
     *
     * @param string $slabel Label
     *
     * @return ConfigSection
     */
    public function setSlabel($slabel)
    {
        $this->slabel = $slabel;

        return $this;
    }

    /**
     * Get slabel
     *
     * @return string
     */
    public function getSlabel()
    {
        return $this->slabel;
    }

    /**
     * Set position
     *
     * @param integer $position Position
     *
     * @return ConfigSection
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
     * Add configGroups
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup ConfigGroup
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigSection
     */
    public function addConfigGroup(\VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup)
    {
        $this->configGroups[] = $configGroup;

        return $this;
    }

    /**
     * Remove configGroups
     *
     * @param VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup ConfigGroup
     *
     * @return VinceT\AdminConfigurationBundle\Entity\ConfigSection
     */
    public function removeConfigGroup(\VinceT\AdminConfigurationBundle\Entity\ConfigGroup $configGroup)
    {
        $this->configGroups->removeElement($configGroup);
    }

    /**
     * Get configGroups
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getConfigGroups()
    {
        return $this->configGroups;
    }

    /**
     * [__toString description]
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getSlabel());
    }
}

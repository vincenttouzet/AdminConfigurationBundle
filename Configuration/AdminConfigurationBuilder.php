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

namespace VinceT\AdminConfigurationBundle\Configuration;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use VinceT\AdminConfigurationBundle\Entity\ConfigSection;
use VinceT\AdminConfigurationBundle\Entity\ConfigGroup;
use VinceT\AdminConfigurationBundle\Entity\ConfigType;
use VinceT\AdminConfigurationBundle\Entity\ConfigValue;

/**
 * AdminConfigurationBuilder
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminBundle
 */
class AdminConfigurationBuilder implements ContainerAwareInterface
{
    protected $container = null;

    /**
     * __construct
     *
     * @param ContainerInterface $container A ContainerInterface instance
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @return null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Add a ConfigSection
     * If a ConfigSection with the same name exists then it does nothing
     *
     * @param string  $name     Name
     * @param string  $label    Label
     * @param integer $position Position
     *
     * @return boolean
     */
    public function addSection($name, $label, $position=0)
    {
        $sectionManager = $this->container->get('admin.configuration.configsection_manager');
        $section = $sectionManager->getRepository()->findOneByName($name);
        if (!$section) {
            $section = new ConfigSection();
            $section->setName($name);
            $section->setSLabel($label);
            $section->setPosition($position);
            $sectionManager->create($section);

            return true;
        }

        return false;
    }

    /**
     * Add a ConfigGroup
     * If a ConfigGroup with this name and within this section already exist then it does nothing
     *
     * @param string  $sectionName Section name
     * @param string  $name        Group name
     * @param string  $label       Group label
     * @param integer $position    Group position
     *
     * @return boolean
     */
    public function addGroup($sectionName, $name, $label, $position=0)
    {
        $groupManager = $this->container->get('admin.configuration.configgroup_manager');
        $sectionManager = $this->container->get('admin.configuration.configsection_manager');
        $group = $groupManager->getRepository()->findOneBySectionAndGroupName($sectionName, $name);
        $section = $sectionManager->getRepository()->findOneByName($sectionName);
        if (!$section) {
            throw new AdminConfigurationBuilderException(sprintf('The section "%s" does not exist.', $sectionName));
        }
        if (!$group && $section) {
            $group = new ConfigGroup();
            $group->setConfigSection($section);
            $group->setName($name);
            $group->setGLabel($label);
            $group->setPosition($position);
            $groupManager->create($group);

            return true;
        }

        return false;
    }

    /**
     * Add a ConfigType
     * If a ConfigType with this identifier already exists then it does nothing
     *
     * @param string $identifier Type identifier
     * @param string $label      Type label
     * @param string $formType   Form type
     * @param array  $options    Form options
     *
     * @return boolean
     */
    public function addType($identifier, $label, $formType, $options = array())
    {
        $typeManager = $this->container->get('admin.configuration.configtype_manager');
        $type = $typeManager->getRepository()->findOneByIdentifier($identifier);
        if (!$type) {
            $type = new ConfigType();
            $type->setIdentifier($identifier);
            $type->setTLabel($label);
            $type->setFormType($formType);
            if ( is_array($options) && count($options) ) {
                $type->setOptions(json_encode($options));
            }
            $typeManager->create($type);

            return true;
        }

        return false;
    }

    /**
     * [addValue description]
     *
     * @param string  $sectionName Section name
     * @param string  $groupName   Group name
     * @param string  $name        Value name
     * @param string  $type        Type identifier
     * @param string  $label       Value label
     * @param string  $value       Default value
     * @param string  $help        Value help
     * @param array   $formOptions Form options
     * @param integer $position    Value position
     *
     * @return boolean
     */
    public function addValue($sectionName, $groupName, $name, $type, $label, $value='', $help='', $formOptions=array(), $position=0)
    {
        $groupManager = $this->container->get('admin.configuration.configgroup_manager');
        $valueManager = $this->container->get('admin.configuration.configvalue_manager');
        $typeManager = $this->container->get('admin.configuration.configtype_manager');
        $group = $groupManager->getRepository()->findOneBySectionAndGroupName($sectionName, $groupName);
        $type = $typeManager->getRepository()->findOneByIdentifier($type);
        $value = $valueManager->getRepository()->findOneBySectionGroupAndValueName($sectionName, $groupName, $name);
        if (!$group) {
            throw new AdminConfigurationBuilderException(sprintf('The group "%s" under the section "%s" does not exist.', $groupName, $sectionName));
        }
        if (!$type) {
            throw new AdminConfigurationBuilderException(sprintf('The type "%s" does not exist.', $type));
        }
        if (!$value && $group && $type) {
            $value = new ConfigValue();
            $value->setConfigGroup($group);
            $value->setConfigType($type);
            $value->setName($name);
            $value->setVLabel($label);
            $value->setHelp($help);
            if ( is_array($formOptions) && count($formOptions) ) {
                $value->setOptions(json_encode($formOptions));
            }
            $value->setPosition($position);
            $valueManager->create($value);

            return true;
        }

        return false;
    }
}

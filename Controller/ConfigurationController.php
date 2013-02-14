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

namespace VinceT\AdminConfigurationBundle\Controller;

use VinceT\AdminBundle\Controller\AdminController as BaseController;
use VinceT\AdminConfigurationBundle\Entity\ConfigGroup;
use Symfony\Component\HttpFoundation\Response;
use VinceT\AdminConfigurationBundle\Form\ConfigGroupValuesType;

/**
 * Configuration controller
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigurationController extends BaseController
{
    /**
     * [indexAction description]
     *
     * @return [type]
     */
    public function indexAction()
    {
        $configSectionManager = $this->container->get('admin.configuration.configsection_manager');
        $sections = $configSectionManager->getRepository()->findAllWithConfigGroups();
        $group = null;
        if ( count($sections) ) {
            $groups = $sections[0]->getConfigGroups();
            if ( count($groups) ) {
                $group = $groups[0];
            }
        }
        return $this->renderTemplate($group);
    }

    /**
     * [groupAction description]
     *
     * @param ConfigGroup $group [description]
     * 
     * @return [type]
     */
    public function groupAction(ConfigGroup $group)
    {
        return $this->renderTemplate($group);
    }

    /**
     * save configuration
     *
     * @param ConfigGroup $group [description]
     *
     * @return [type]
     */
    public function saveAction(ConfigGroup $group)
    {
        $form = $this->createConfigGroupForm($group);
        $form->bind($this->getRequest());
        $configurationManager = $this->container->get('admin.configuration.manager');
        foreach ($form as $input) {
            $configurationManager->set($input->getName(), $input->getData());
        }
        $message = $this->container->get('translator')->trans(
            'The configuration has been successfully saved.', 
            array(), 
            'VinceTAdminConfigurationBundle'
        );
        $this->get('session')->setFlash('sonata_flash_success', $message);
        return $this->redirect(
            $this->generateUrl(
                'vince_t_admin_configuration_group', 
                array(
                    'id' => $group->getId(),
                    'sname' => $group->getConfigSection()->getName(),
                    'gname' => $group->getName()
                )
            )
        );
    }

    /**
     * Render the main template
     *
     * @param ConfigGroup $group [description]
     *
     * @return [type]
     */
    protected function renderTemplate(ConfigGroup $group)
    {
        $adminPool = $this->container->get('sonata.admin.pool');
        return $this->render(
            'VinceTAdminConfigurationBundle:Configuration:index.html.twig',
            array(
                'configuration_menu' => $this->createMenu(),
                'group' => $group,
                'form' => $this->createConfigGroupForm($group)->createView(),
                'admin_section' => $adminPool->getAdminByAdminCode('admin.configuration.admin.configsection'),
                'admin_group' => $adminPool->getAdminByAdminCode('admin.configuration.admin.configgroup'),
                'admin_value' => $adminPool->getAdminByAdminCode('admin.configuration.admin.configvalue'),
                'admin_type' => $adminPool->getAdminByAdminCode('admin.configuration.admin.configtype'),
            )
        );
    }

    /**
     * Create the form for all values in group
     *
     * @param ConfigGroup $group [description]
     *
     * @return [type]
     */
    protected function createConfigGroupForm(ConfigGroup $group)
    {
        $formBuilder = $this->createFormBuilder();
        $values = $this->container->get('admin.configuration.configvalue_manager')->getRepository()->findByConfigGroupId($group->getId());
        foreach ($values as $configValue) {
            $formBuilder->add(
                $configValue->getPath(),
                $configValue->getConfigType()->getFormType(),
                array(
                    'label' => $configValue->getVLabel(),
                    'data' => $configValue->getValue(),
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'sonata_field_description' => $configValue->getHelp(),
                    'required' => false
                )
            );
        }
        return $formBuilder->getForm();
    }

    /**
     * [createMenu description]
     *
     * @return \Knp\Menu\MenuItem
     */
    protected function createMenu()
    {
        $menuFactory = $this->container->get('vince_t.admin.menu.factory');

        $menu = $menuFactory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-list');
        $menu->setCurrentUri($this->getRequest()->getBaseUrl().$this->getRequest()->getPathInfo());

        $configSectionManager = $this->container->get('admin.configuration.configsection_manager');
        $sections = $configSectionManager->getRepository()->findAllWithConfigGroups();
        $i = 0;
        foreach ($sections as $section) {
            if ( $i > 0 ) {
                $menu->addDivider();
            }
            $sLabel = $section->getSLabel();
            $menu->addNavHeader($sLabel);
            $groups = $this->container->get('admin.configuration.configgroup_manager')->getRepository()->findByConfigGroupId($section->getId());
            foreach ($groups as $group) {
                $gLabel = '    '.$group->getGLabel();
                $menu->addChild(
                    $gLabel, 
                    array(
                        'route' => 'vince_t_admin_configuration_group',
                        'routeParameters' => array(
                            'sname' => $section->getName(),
                            'id' => $group->getId(),
                            'gname' => $group->getName(),
                        ),
                    )
                );
            }
            $i++;
        }
        return $menu;
    }
}

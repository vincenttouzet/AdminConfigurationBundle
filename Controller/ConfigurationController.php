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
            $groups = $this->container->get('admin.configuration.configgroup_manager')->getRepository()->findByConfigGroupId($sections[0]->getId());
            if ( count($groups) ) {
                $group = $groups[0];
            }
        }
        return $this->renderTemplate($group);
    }

    /**
     * [groupAction description]
     *
     * @param string $gname [description]
     * 
     * @return [type]
     */
    public function groupAction($gname)
    {
        $group = $this->get('admin.configuration.configgroup_manager')->getRepository()->findOneByName($gname);
        if ( !$group ) {
            $message = $this->get('translator')->trans('The group with name "%name%" does not exist.', array('%name%'=>$gname), 'VinceTAdminConfigurationBundle');
            throw $this->createNotFoundException($message);
        }
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
        $configValueManager = $this->container->get('admin.configuration.configvalue_manager');
        foreach ($form as $sub) {
            $configValue = $sub->getData();
            $configValueManager->update($configValue);
        }
        $message = $this->container->get('translator')->trans(
            'The configuration has been successfully saved.', 
            array(), 
            'VinceTAdminConfigurationBundle'
        );
        $this->get('session')->getFlashBag()->add('sonata_flash_success', $message);
        return $this->redirect(
            $this->generateUrl(
                'vince_t_admin_configuration_group', 
                array(
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
    protected function renderTemplate(ConfigGroup $group = null)
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
    protected function createConfigGroupForm(ConfigGroup $group = null)
    {
        $formBuilder = $this->createFormBuilder();
        if ( $group ) {
            $values = $this->container->get('admin.configuration.configvalue_manager')->getRepository()->findByConfigGroupId($group->getId());
            foreach ($values as $configValue) {
                $sub = $this->container->get('form.factory')->createNamedBuilder(
                    str_replace(':', '___', $configValue->getPath()),
                    'admin_configuration_configvalue_'.$configValue->getConfigType()->getFormType(), 
                    $configValue
                );
                $formBuilder->add($sub);
            }
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
                            //'id' => $group->getId(),
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

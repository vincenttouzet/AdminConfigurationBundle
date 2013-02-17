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

namespace VinceT\AdminConfigurationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin as BaseAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * ConfigTypeAdmin
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigTypeAdmin extends BaseAdmin
{
    /**
     * [configureFormFields description]
     *
     * @param FormMapper $formMapper [description]
     *
     * @return [type]
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tlabel')
            ->add('formType')
            ->add('options');
    }

    /**
     * [configureDatagridFilters description]
     *
     * @param DatagridMapper $datagridMapper [description]
     *
     * @return [type]
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('tlabel')
            ->add('formType');
    }

    /**
     * [configureListFields description]
     *
     * @param ListMapper $listMapper [description]
     *
     * @return [type]
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('tlabel')
            ->add('formType')
            ->add(
                '_action', 
                'actions', 
                array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                )
            );
    }

    /**
     * [configureShowFields description]
     *
     * @param ShowMapper $showMapper [description]
     *
     * @return [type]
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('tlabel')
            ->add('formType');
    }
}
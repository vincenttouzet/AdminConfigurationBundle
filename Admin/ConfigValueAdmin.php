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
 * ConfigValueAdmin
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigValueAdmin extends BaseAdmin
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
            ->add('configGroup', 'sonata_type_model')
            ->add('configType', 'sonata_type_model')
            ->add('name')
            ->add('vlabel')
            ->add('value')
            ->add('help')
            ->add('position')
            ->setHelps(array('name'=>'form.help_name'));
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
            ->add('configGroup')
            ->add('configType')
            ->add('name')
            ->add('vlabel')
            ->add('value')
            ->add('position');
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
            ->add('configGroup', 'sonata_type_model')
            ->add('configType', 'sonata_type_model')
            ->add('name')
            ->add('vlabel')
            ->add('value')
            ->add('position')
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
            ->add('configGroup', 'sonata_type_model')
            ->add('configType', 'sonata_type_model')
            ->add('name')
            ->add('vlabel')
            ->add('value')
            ->add('help')
            ->add('position');
    }
}
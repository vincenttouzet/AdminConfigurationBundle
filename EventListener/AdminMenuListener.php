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

namespace VinceT\AdminConfigurationBundle\EventListener;

/**
 * AdminMenuListener
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class AdminMenuListener
{
    /**
     * [createMenu description]
     *
     * @param VinceT\AdminBundle\Event\MenuCreateEvent $event Event dispatched when admin menu is created
     *
     * @return null
     */
    public function createMenu($event)
    {
        $menu = $event->getMenu();

        $menu['AdminConfiguration']->addChild(
            'Configuration',
            array(
                'route'=>'vince_t_admin_configuration_homepage',
                'translationDomain' => 'VinceTAdminConfigurationBundle'
            )
        );
        $menu['AdminConfiguration']['Configuration']->moveToFirstPosition();

    }
}

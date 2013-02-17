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

namespace VinceT\AdminConfigurationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ConfigSectionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class ConfigSectionRepository extends EntityRepository
{
    /**
     * Find all section with their groups
     *
     * @return array
     */
    public function findAllWithConfigGroups()
    {
        $query = $this->createQueryBuilder('s')
            ->select('s', 'g')
            ->innerJoin('s.configGroups', 'g')
            ->orderBy('s.position', 'ASC')
            ->getQuery();
        $result = $query->getResult();
        return $result;
    }
}

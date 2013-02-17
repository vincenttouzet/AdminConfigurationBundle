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

namespace VinceT\AdminConfigurationBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * This file is part of VinceTAdminConfigurationBundle for Symfony2
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class StringToDateTimeTransformer implements DataTransformerInterface
{

    /**
     * Transforms a string into a DateTime.
     *
     * @param string $value String value.
     *
     * @return DateTime DateTime value.
     *
     * @throws UnexpectedTypeException if the given value is not a string
     */
    public function transform($value)
    {
        return new \DateTime($value);
    }

    /**
     * Transforms a DateTime into a string.
     *
     * @param DateTime $value DateTime value.
     *
     * @return string String value.
     *
     * @throws UnexpectedTypeException if the given value is not a DateTime
     */
    public function reverseTransform($value)
    {
        return $value->format('c');
    }

}

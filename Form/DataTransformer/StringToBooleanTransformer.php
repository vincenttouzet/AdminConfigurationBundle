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
class StringToBooleanTransformer implements DataTransformerInterface
{
    /**
     * The value emitted upon transform if the input is true
     * @var string
     */
    private $trueValue;

    /**
     * Sets the value emitted upon transform if the input is true.
     *
     * @param string $trueValue
     */
    public function __construct($trueValue)
    {
        $this->trueValue = $trueValue;
    }

    /**
     * Transforms a string into a Boolean.
     *
     * @param string $value String value.
     *
     * @return Boolean Boolean value.
     *
     * @throws UnexpectedTypeException if the given value is not a string
     */
    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return true;
    }

    /**
     * Transforms a Boolean into a string.
     *
     * @param Boolean $value Boolean value.
     *
     * @return string String value.
     *
     * @throws UnexpectedTypeException if the given value is not a Boolean
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return false;
        }

        if (!is_bool($value)) {
            throw new UnexpectedTypeException($value, 'Boolean');
        }

        return true === $value ? $this->trueValue : null;
    }

}

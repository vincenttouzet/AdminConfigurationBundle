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
 * StringToArrayTransformer
 *
 * @category VinceT
 * @package  VinceTAdminConfigurationBundle
 * @author   Vincent Touzet <vincent.touzet@gmail.com>
 * @license  MIT License view the LICENSE file that was distributed with this source code.
 * @link     https://github.com/vincenttouzet/AdminConfigurationBundle
 */
class StringToArrayTransformer implements DataTransformerInterface
{
    /**
     * The value emitted upon transform if the input is true
     * @var string
     */
    private $separator;

    /**
     * Sets the value emitted upon transform if the input is true.
     *
     * @param string $separator Separator for the array
     */
    public function __construct($separator = ',')
    {
        $this->separator = $separator;
    }

    /**
     * Transforms a string into an array.
     *
     * @param string $value String value.
     *
     * @return array array value.
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

        return explode($this->separator, $value);
    }

    /**
     * Transforms an array into a string.
     *
     * @param array $value array value.
     *
     * @return string String value.
     *
     * @throws UnexpectedTypeException if the given value is not an array
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return false;
        }

        if (!is_array($value)) {
            throw new UnexpectedTypeException($value, 'array');
        }

        return implode($this->separator, $value);
    }

}

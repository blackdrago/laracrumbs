<?php
/**
 * Contains the InputService class.
 *
 * @package Laracrumbs\Services
 */
namespace Laracrumbs\Services;

/**
 * InputService contains business logic for handling input from end-users.
 */
class InputService
{
    /**
     * Given an array of input from a request, cleanup the value and remove any keys
     * that have empty or invalid values.
     *
     * @param  array $input
     * @return array
     */
    public static function cleanInput($input)
    {
        foreach ($input as $field => $value) {
            if (empty($value) && ($value !== 0 && $value !== false)) {
                unset($input[$field]);
            }
        }
        return $input;
    }
}

<?php
/**
 * Contains the UtilityService class.
 *
 * @package Laracrumbs\Services
 */
namespace Laracrumbs\Services;

/**
 * Contains business logic related to various utility functions.
 */
class UtilityService
{
    /**
     * Check if the given mapped function exits.
     *
     * @param  string  $funcName
     * @return boolean
     */
    public static function mappedFunctionExists($funcName)
    {
        if (str_contains($funcName, '::')) {
            $className = substr($funcName, 0, strpos($funcName, ':'));
            $methodName = substr($funcName, strrpos($funcName, ':')+1);
            return class_exists($className) && method_exists($className, $methodName);
        }
        return function_exits($funcName);
    }

    /**
     * Given a string, return the translated value. 
     *
     * NOTE: The translation shortcut name (e.g., 'laracrumbs',) can be changed via
     * configuration setting.
     *
     * @param  string $strKey
     * @return string
     */
    public static function translate($strKey)
    {
        if (!is_null(config('laracrumbs.translation_key'))) {
            $fullKey = config('laracrumbs.translation_key') . "::{$strKey}";
            if (self::checkTranslationKey($fullKey)) {
                return trans($fullKey);
            }
        }
        if (self::checkTranslationKey($strKey)) {
            return trans($strKey);
        }
        return $strKey;
    }

    /**
     * Given a translation key, check if it corresponds to an actual value.
     *
     * @param  string  $key
     * @return boolean
     */
    protected static function checkTranslationKey($key)
    {
        return trans($key) !== $key;
    }
}

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

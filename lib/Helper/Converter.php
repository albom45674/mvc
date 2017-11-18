<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Helper;

/**
 * Helper converter class.
 */
class Converter extends \Base 
{
    /**
     * Convert string with underlines to camel case
     *
     * @param string $str String to convert
     * @param bool $isFirstCapital Make first letter capital or not
     *
     * @return string
     */
    public static function toCamelCase($str, $isFirstCapital = false)
    {
        $parts = explode('_', $str);

        foreach ($parts as $key => $part) {
            $parts[$key] = ucFirst($part);
        }

        $str = implode('', $parts);

        if (!$isFirstCapital) {
            // It's more nice to make it in foreach above, but this way is faster and simplier
            $str = lcFirst($str);
        }

        return $str;
    }

    /**
     * Convert string from camel case format to the one with underlines
     *
     * @param string $str String to convert
     *
     * @return string
     */
    public static function fromCamelCase($str)
    {
        $parts = preg_split('/(?=[A-Z])/', $str);

        foreach ($parts as $key => $part) {
            $parts[$key] = lcFirst($part);
        }

        $str = implode('_', $parts);

        return $str;
    }
}

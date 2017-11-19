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
final class Converter extends \Base\Helper 
{
    /**
     * Convert string with underlines to camel case
     *
     * @param string $str String to convert
     * @param bool $isFirstCapital Make first letter capital or not
     *
     * @return string
     */
    public function toCamelCase($str, $isFirstCapital = false)
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
    public function fromCamelCase($str)
    {
        $parts = preg_split('/(?=[A-Z])/', $str);

        $parts = array_filter($parts);

        foreach ($parts as $key => $part) {
            $parts[$key] = lcFirst($part);
        }

        $str = implode('_', $parts);

        return $str;
    }

    /**
     * Correct query params array
     * (simply prepend colon to the names)
     *
     * @param array $params Query params
     *
     * @return array
     */
    public function correctQueryParams(array $params = array())
    {
        $result = array();

        foreach ($params as $name => $value) {

            if (':' !== substr($name, 0, 1)) {
                $name = ':' . $name;
            }

            $result[$name] = $value;
        }

        return $result;
    }
}

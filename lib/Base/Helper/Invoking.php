<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Base\Helper;

/**
 * Abstract callable helper class (singltone) 
 */
abstract class Invoking extends \Base\Helper
{
    /**
     * This magic method must be implemented for callable helpers
     */
    abstract public function __invoke();

    /**
     * Get singletone object and call it
     *
     * @return mixed 
     */
    public static function getObject()
    {
        $object = parent::getObject();

        return $object();
    }   
}

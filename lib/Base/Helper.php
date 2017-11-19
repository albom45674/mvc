<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Base;

/**
 * Abstract heler class (singltone) 
 */
abstract class Helper extends \Base
{
    /**
     * Singltone objects storage 
     */
    private static $objects = array();

    /**
     * Disable some magic for the singletones
     */
    private function __clone() {}
    private function __sleep() {}
    private function __wakeup() {}

    /**
     * Constructor. For the internal usage only.
     *
     * @return void
     */
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * Get singletone object
     *
     * @return \Helper\Abstract
     */
    public static function getObject()
    {
        $class = get_called_class();

        if (empty(self::$objects[$class])) {
            self::$objects[$class] = new $class;
        }

        return self::$objects[$class];
    }   
}

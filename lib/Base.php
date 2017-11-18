<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

/**
 * Base class. Everything should extend it.
 */
abstract class Base 
{

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        echo 'CONSTRUCT:' . get_class($this) . PHP_EOL;
    }
}

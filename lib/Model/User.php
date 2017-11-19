<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Model;

/**
 * User model class 
 */
class User extends \Base\Model
{
    protected $table = 'users';

    protected $key = 'login';

}

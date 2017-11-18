<?php

class Base {

    public function __construct()
    {
        echo 'CONSTRUCT:' . get_class($this) . PHP_EOL;
    }
}

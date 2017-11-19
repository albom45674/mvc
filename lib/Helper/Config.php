<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Helper;

/**
 * Helper for configuration file.
 */
class Config extends \Base\Helper\Invoking
{
    /**
     * Config file name
     */
    const CONFIG_FILE = 'etc/config.xml';

    /**
     * Configuration data from etc/config.xml
     */
    private $data = null;

    /**
     * Parse configuration file
     *
     * @return void
     */
    private function parse()
    {
        if (!empty($this->data)) {
            return;
        }

        $fileName = MVC_DIR . '/' . static::CONFIG_FILE;

        if (file_exists($fileName) && is_readable($fileName)) {

            $this->data = simplexml_load_file($fileName);
        }
    }

    /**
     * Config data getter
     *
     * @return SimpleXMLElement
     */
    public function __invoke()
    {
        $this->parse();

        return $this->data;
    }
}

<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Base;

/**
 * Abstract model class 
 */
abstract class Model extends \Base
{
    /**
     * Table name
     */
    protected $table = '';

    /**
     * Primary key
     */
    protected $key = '';

    /**
     * Fields in the table / model properties
     */
    protected $fields = array();

    /**
     * Model data
     */
    protected $values = array();

    /**
     * Constructor
     *
     * @param string $value If present then load model from DB
     *
     * @return \Base\Model
     */
    public function __construct($value = null)
    {
        $query = 'SHOW FIELDS FROM ' . $this->table;

        $this->fields = \Helper\Db::getObject()
            ->setFetchStyle(\PDO::FETCH_COLUMN)
            ->fetchAll($query);

        return $this;
    }

    /**
     * Load model data from DB
     *
     * @param string $value Primary key value
     *
     * @return void
     */
    public function load($value)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->key . ' = :value';

        $params = array(
            'value' => $value,
        );

        $this->values = \Helper\Db::getObject()
            ->setFetchStyle(\PDO::FETCH_ASSOC)
            ->fetch($query, $params);

        return $this;
    }

    /**
     * Save model data to DB
     *
     * @return void
     */
    public function save()
    {
        $list = array();

        foreach ($this->fields as $field) {
            $list[] = $field . ' = :' . $field;
        }

        $query = 'REPLACE INTO ' . $this->table . ' SET ' . implode(', ', $list);

        $params = $this->get(); 

        \Helper\Db::getObject()->execute($query, $params);

        return $this;
    }

    /**
     * Common getter
     *
     * @param $field Field name. If omitted returns all fields and values
     *
     * @return mixed
     */
    public function get($field = null)
    {
        if ($field === null) {

            $value = $this->values;

        } elseif (in_array($field, $this->fields)) {

            $value = $this->values[$field];

        } else {

            $value = null;
        }

        return $value;
    }

    /**
     * Common setter
     *
     * @param mixed $field Field name or list name-value
     * @param string $value Field value
     *
     * @return \Base\Model 
     */
    public function set($field, $value = null)
    {
        if (is_array($field)) {

            foreach ($field as $name => $value) {
                $this->set($name, $value);
            }

        } elseif (in_array($field, $this->fields)) {

            $this->values[$field] = $value;
        }

        return $this;
    }

    /**
     * Some magic for getters and setters
     *
     * @param sting $name
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments = array())
    {
        $prefix = substr($name, 0, 3);

        $field = substr($name, 3, strlen($name) - 3);
        $field = \Helper\Converter::getObject()->fromCamelCase($field);

        if ('get' == $prefix) {

            $result = $this->get($field);

        } elseif ('set' == $prefix && isset($arguments[0])) {

            $result = $this->set($field, $arguments[0]);

        } else {

            $result = parent::__call($name, $arguments);
        }

        return $result;
    }
}

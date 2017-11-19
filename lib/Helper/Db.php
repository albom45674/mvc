<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * This is MVC!!!
 * Something about license usualy goes here
 */

namespace Helper;

/**
 * Database operations via PDO.
 */
class Db extends \Base\Helper 
{
    /**
     * DB connection instance
     */
    private $connection = null;

    /**
     * Fetch style
     */
    private $fetchStyle = \PDO::FETCH_COLUMN;

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct()
    {
        parent::__construct();
        
        $config = \Helper\Config::getObject();

        $connectionStr = 'mysql:'
            . 'host=' . (string)$config->db->host. ';'
            . 'dbname=' . (string)$config->db->db;

        $this->connection = new \PDO(
            $connectionStr,
            (string)$config->db->user,
            (string)$config->db->password
        );
    }

    /**
     * Set fetch style
     *
     * @param int $fetchStyle Fetch style
     *
     * @return \Helper\Db
     */
    public function setFetchStyle($fetchStyle)
    {
        $this->fetchStyle = $fetchStyle;

        return $this;
    }

    /**
     * Execute query 
     *
     * @param string $query Query
     * @param array $params Query params
     *
     * @return PDOStatement
     */
    public function execute(string $query, array $params = array())
    {
        $params = \Helper\Converter::getObject()->correctQueryParams($params);

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    /**
     * Execute query and fetch all rows
     *
     * @param string $query Query
     * @param array $params Query params
     *
     * @return array
     */
    public function fetchAll(string $query, array $params = array())
    {
        $result = $this->execute($query, $params)
            ->fetchAll($this->fetchStyle);

        return $result;
    }

    /**
     * Execute query and fetch single row
     *
     * @param string $query Query
     * @param array $params Query params
     *
     * @return array
     */
    public function fetch($query, $params = array())
    {
        $result = $this->execute($query, $params)
            ->fetch($this->fetchStyle);

        return $result;
    }
}

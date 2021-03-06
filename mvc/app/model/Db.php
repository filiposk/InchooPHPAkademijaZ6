<?php

/**
 * Created by PhpStorm.
 * User: filip
 * Date: 01.02.19.
 * Time: 19:28
 */
class Db extends PDO
{
    private static $instance = [];

    public function __construct($config)
    {
        if (!isset($config['host'])){
            $config['host'] = 'localhost';
        }

        //the data source name or DSn,
        // contains informations required to connect to the database

        $dsn = 'mysql:host='.$config['host'].';dbname='.$config['name'].';charset=utf8';

        parent::__construct($dsn, $config['user'], $config['password']);

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * @param string $name
     * @return Db
     */
    public static function connect($name = 'filip')
    {
        $config = App::config("db");
        if(!isset(self::$instance[$name]))
        {
            self::$instance[$name] = new self($config);
        }
        return self::$instance[$name];
    }
}
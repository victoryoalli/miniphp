<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    protected static $connections = [];

    /**
     * Get or create a new PDO connection.
     *
     * @param string $name
     * @param array $config
     * @return PDO
     */
    public static function make($name, $config)
    {
        // If the connection already exists, return it.
        if (isset(self::$connections[$name])) {
            return self::$connections[$name];
        }
        $currentConfig = $config[$name];
        // If not, create a new connection.
        try {
            self::$connections[$name] = new PDO(
                $currentConfig['connection'],
                $currentConfig['username'],
                $currentConfig['password'],
                $currentConfig['options']
            );
            return self::$connections[$name];
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}

<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 12:57
 */

namespace Models;


use DataBaseConnection;

abstract class Model
{
    protected $id;

    /**
     * Get all the rows filtered by $paramenters
     * @param array $parameters
     * @return mixed
     */
    public static function all(array $parameters = [])
    {
        $connection = new DataBaseConnection();
        return $connection->filter(self::getTable(), $parameters);
    }


    /**
     * Get the table associated with the classed what is invoking the method
     * @return string
     */
    private static function getTable(): string
    {
        return DB_TABLES[static::class];
    }


    /**
     * Create a new row in the DB table
     * @param array $parameters
     * @return int, Last ID of the new row created
     */
    public static function create(array $parameters)
    {
        $table = self::getTable();
        $connection = new DataBaseConnection();
        return $connection->insert($table, $parameters);
    }

    /**
     * Get a row by ID
     * @param $id
     * @return mixed
     */
    public static function find($id)
    {
        $table = self::getTable();
        $connection = new DataBaseConnection();
        $parameters = ['id' => $id];
        return $connection->first($table, $parameters);
    }

    /**
     * Get the first instance filtered by $parameters
     * @param array $parameters
     * @return mixed
     */
    public static function first(array $parameters)
    {
        $table = self::getTable();
        $connection = new DataBaseConnection();
        return $connection->first($table, $parameters);
    }

    /**
     * Look for the first instance in a DB table and create it if not exists
     * Abstract method, has to be developed in extended classes
     * @param array $parameters
     * @return mixed
     */
    protected abstract static function firstOrCreate(array $parameters);

    /**
     * Delete a row by ID
     * @param $id
     */
    public function delete()
    {
        $table = self::getTable();
        $connection = new DataBaseConnection();
        $parameters = ['id' => $this->id];
        return $connection->delete($table, $parameters);
    }

    /**
     * return the absolute path and name
     * @return string
     */
    protected abstract function getAbsolutePath(): string;


}
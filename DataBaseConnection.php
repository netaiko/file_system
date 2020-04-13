<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 11:00
 */


class DataBaseConnection
{

    private $pdo;
    private $query;


    /**
     * DataBaseConnection constructor.
     */
    public function __construct()
    {
        $dns = "mysql:host=" . DB_HOST . ";" . "dbname=" . DB_DATABASE;
        $this->pdo = new PDO($dns, DB_USERNAME, DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * Execute a basic Insert SQL query
     * @param $table
     * @param array $parameters
     * @return string
     */
    public function insert($table, array $parameters)
    {
        $keys = implode(", ", array_keys($parameters));
        $keys_bindeables = self::params2bindeable($parameters);

        $sql = "INSERT INTO $table ($keys) VALUES ($keys_bindeables)";


        $this->execute($sql, $parameters, true);

        return $this->pdo->lastInsertId();
    }


    /**
     * Make a string with the parameters for adding to a basic SQL query
     * @param array $parameters
     * @return string
     */
    public static function params2bindeable(array $parameters)
    {
        $new_params = [];
        foreach ($parameters as $key => $parameter) {
            $new_params[] = ":$key";
        }
        return implode(",", $new_params);
    }


    /**
     * Execute a valid SQL query
     * @param $sql
     * @param array $parameters
     * @param bool $allow_null true:Allow nulls|false: skip nulls
     * @param bool $strong_match true:strong word match filtering in queries|false:flexible match filtering in queries
     */
    private function execute($sql, $parameters = [], $allow_null = false, $strong_match = true)
    {
        try {
            $this->query = $this->pdo->prepare($sql);
            $this->bindParameters($parameters, $allow_null, $strong_match);
            $this->query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    /**
     * @param array $parameters
     * @param bool $allow_null true:Allow nulls|false: skip nulls
     * @param bool $strong_match true:strong word match filtering in queries|false:flexible match filtering in queries
     */
    public function bindParameters(array $parameters, $allow_null = false, $strong_match = true)
    {
        foreach ($parameters as $key => $value) {
            if (!is_null($value) || $allow_null) {

                $value = ($strong_match || is_null($value)) ? $value : "%$value%";

                $this->query->bindValue(":$key", $value);
            }
        }
    }


    /**
     * Execute a basic Select SQL query filtering by parameters with strong word match
     * @param $table
     * @param array $parameters
     * @return array
     */
    public function select($table, $parameters = [])
    {
        $sql = "SELECT * FROM  $table ";
        $sql .= self::params2where($parameters);
        $sql .= " ORDER BY ID";

        $this->execute($sql, $parameters);

        return $this->query->fetchAll();
    }

    /**
     * Execute a basic Select SQL query filtering by parameters with strong word match
     * @param array $parameters
     * @param bool $strong_match true:strong word match filtering in queries|false:flexible match filtering in queries
     * @return string
     */
    public static function params2where(array $parameters, $strong_match = true)
    {
        $string = " WHERE 1 ";
        $match = $strong_match ? '=' : 'LIKE';
        foreach ($parameters as $key => $parameter) {

            $string .= is_null($parameter) ? " AND  $key IS NULL " : " AND $key $match :$key ";
        }
        return $string;
    }

    /**
     * Execute a basic Delete SQL query by parameters
     * @param $table
     * @param array $parameters
     */
    public function delete($table, $parameters = [])
    {
        $sql = "DELETE FROM  $table ";
        $sql .= self::params2where($parameters);

        $this->execute($sql, $parameters);
    }

    /**
     * get the first row filtering by parameters
     * @param $table
     * @param array $parameters
     * @return array
     */
    public function first($table, $parameters = [])
    {
        $sql = "SELECT * FROM  $table ";
        $sql .= self::params2where($parameters) . ' LIMIT 1';

        $this->execute($sql, $parameters);

        return $this->query->fetch();
    }


    /**
     * Get all the rows filtering by parameters with flexible word match
     * @param $table
     * @param array $parameters
     * @return mixed
     */
    public function filter($table, $parameters = [])
    {
        $sql = "SELECT * FROM  $table ";
        $sql .= self::params2where($parameters, false);
        $sql .= " ORDER BY ID";

        $this->execute($sql, $parameters, false, false);

        return $this->query->fetchAll();
    }

}
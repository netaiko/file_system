<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 22:38
 */

namespace Validators;


class FolderValidator
{
    /**
     * Check if the name is a basic name for a directory or unit
     * @param $name
     * @return bool
     */
    public static function isDirectoryName($name)
    {
        return self::isName($name) || self::isUnit($name);
    }

    /**
     * Check if the name is a basic name for a folder
     * @param $name
     * @return boolean
     */
    public static function isName($name)
    {
        return preg_match("/^[a-zA-Z\s]+$/", $name) == true;
    }


    /**
     * Check if the filename is a basic unit name like C: D: E: F:
     * @param $name
     * @return boolean
     */
    public static function isUnit($name)
    {
        return preg_match("/^[a-zA-Z]+:+$/", $name) == true;
    }


}
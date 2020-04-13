<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 22:36
 */

namespace Validators;


class FileValidator
{
    /**
     * Throw an exception if the file name is not permitted
     * @param $name
     */
    public static function name($name)
    {
        if (self::isName()) {
            throw new Exception("$name is not a a valid file name");
        }
    }


    /**
     * Check if the filename is an basic filename format
     * @param $filename
     * @return false|true
     */
    public static function isName($filename)
    {
        return preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+([a-zA-Z0-9])$/", $filename) == true;
    }
}
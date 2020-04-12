<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 12/04/2020
 * Time: 00:03
 */

namespace Validators;


use Exception;

class TextFileValidator extends Exception
{

    /**
     * Read the whole text file line by line checking if contains permitted names
     * or throw an exception
     * @param $filename
     * @throws Exception
     */
    public static function textFile($filename)
    {
        $file = fopen($filename, "r") or die("Unable to open file!");
        while (!feof($file)) {
            $line = fgets($file);
            self::line($line);
        }
        fclose($file);
    }


    /**
     * Check a line if contains a permitted format like   C:\Documents\Images\Image1.jpg
     * or throw an exception
     * @param $line
     * @throws Exception
     */
    private static function line($line)
    {
        $slugs = explode("\\", $line);
        foreach ($slugs as $index => $slug) {
            if ($slug) {
                self::slug($slug, $index);
            }
        }
    }


    /**
     * Check if a string contain a permitted name for a file or directory
     * or throw an exception
     * @param $slug
     * @param $index
     * @throws Exception
     */
    private static function slug($slug, $index)
    {
        if ($index == 0) {
            self::unit($slug);
        } else {

            self::fileOrDirectory($slug);
        }
    }


    /**
     * Check if a string contain a permitted name for a unit like  C: D: E:
     * or throw an exception
     * @param $slug
     * @throws Exception
     */
    private static function unit($slug)
    {
        if (!FolderValidator::isUnit($slug)) {
            throw new Exception("File Error:\"$slug\" Unit Drive not defined");
        }
    }


    /**
     * Check if a string contain a permitted name for a directory
     * or throw an exception
     * @param $slug
     * @throws Exception
     */
    private static function fileOrDirectory($slug)
    {
        if (!(FolderValidator::isName($slug) || FileValidator::isName($slug))) {
            throw new Exception("File Error: \"$slug\" is not a valid file or directory name");
        }
    }


}
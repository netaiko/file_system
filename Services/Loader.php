<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 13:31
 */

namespace Services;


use Exception;
use Models\File;
use Models\Folder;
use Validators\FileValidator;
use Validators\FolderValidator;
use Validators\TextFileValidator;

class Loader
{

    /**
     *Execute the process for load a text file and store in the DB
     */
    public static function run()
    {
        self::loadTextFile();
    }


    /**
     *Get line by line from the text file
     */
    private static function loadTextFile()
    {
        try {
            TextFileValidator::textFile(FILE_INPUT);
            $file = fopen(FILE_INPUT, "r") or die("Unable to open file!");
            while (!feof($file)) {
                $line = fgets($file);
                self::addLine($line);
            }
            fclose($file);
        } catch (Exception $a) {
            die($a->getMessage());
        }
    }


    /**
     * processing lines separating by the character "\" in slugs
     * @param $line
     */
    private static function addLine($line)
    {
        $slugs = explode("\\", $line);
        foreach ($slugs as $key => $slug) {
            if ($slug) {
                $parent = self::addSlug($slug, $parent ?? null);
            }
        }
    }


    /**
     * Identifying if it is a File or Directory and store and create them
     * @param $slug          string from the line
     * @param null $parent   last parent folder added
     * @return Folder|null   new parent folder added
     */
    private static function addSlug($slug, $parent = null)
    {
        if (FolderValidator::isDirectoryName($slug)) {

            $parent = Folder::firstOrCreate(['name' => $slug, 'parent_id' => $parent ? $parent->getId() : null]);

        } elseif (FileValidator::isName($slug)) {

            $file = File::firstOrCreate(['name' => $slug, 'folder_id' => $parent ? $parent->getId() : null]);
            $parent = $file->folder();

        }
        return $parent;
    }


}
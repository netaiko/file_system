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


/**
 * Class Loader
 * load a file and add the information to the database.
 * @package Services
 */
class Loader
{
    private $text_file;
    private $files_added;
    private $folders_added;

    /**
     * Loader constructor.
     */
    public function __construct($text_file = FILE_INPUT)
    {
        $this->text_file = $text_file;
        $this->files_added = [];
        $this->folders_added = [];
    }


    /**
     *Execute the process for load a text file and store in the DB
     */
    public function run()
    {
        $this->loadTextFile($this->text_file);
    }


    /**
     *Get line by line from the text file
     * @param $text_file
     */
    private function loadTextFile($text_file)
    {
        try {
            TextFileValidator::textFile($text_file);
            $file = fopen($text_file, "r") or die("Unable to open file!");
            while (!feof($file)) {
                $line = fgets($file);
                $this->addLine($line);
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
    private function addLine($line)
    {
        $slugs = explode("\\", $line);
        foreach ($slugs as $key => $slug) {
            if ($slug) {
                $parent = $this->addSlug($slug, $parent ?? null);
            }
        }
    }


    /**
     * Identifying if it is a File or Directory and store and create them
     * @param $slug          string from the line
     * @param null $parent last parent folder added
     * @return Folder|null   new parent folder added
     */
    private function addSlug($slug, $parent = null)
    {
        if (FolderValidator::isDirectoryName($slug)) {

            $parent = Folder::firstOrCreate(['name' => $slug, 'parent_id' => $parent ? $parent->getId() : null]);

            $this->folders_added[] = $parent;

        } elseif (FileValidator::isName($slug)) {

            $file = File::firstOrCreate(['name' => $slug, 'folder_id' => $parent ? $parent->getId() : null]);
            $parent = $file->folder();

            $this->files_added[] = $file;
        }
        return $parent;
    }

    /**
     * Return the files have been added
     * @return array
     */
    public function getFilesAdded(): array
    {
        return $this->files_added;
    }

    /**
     * Return the folders have been added
     * @return array
     */
    public function getFoldersAdded(): array
    {
        return $this->folders_added;
    }

}
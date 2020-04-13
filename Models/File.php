<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 10:43
 */

namespace Models;


class File extends Model
{

    private $name;
    private $folder_id;

    /**
     * File constructor.
     * @param $id
     * @param $name
     * @param $folder_id
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->folder_id = $attributes['folder_id'];
    }


    /**
     * Get all the Files filtered by $parameters
     * @param array $parameters
     * @return array
     */
    public static function all(array $parameters = [])
    {
        foreach (parent::all($parameters) as $item) {
            $list[] = new File($item);
        }
        return $list ?? [];
    }


    /**
     * Look for the first instance create it if not exists
     * @param array $parameters
     * @return File|null
     */
    public static function firstOrCreate(array $parameters)
    {
        $file = self::first($parameters);
        if (!$file) {
            $file = self::create($parameters);
        }
        return $file;
    }


    /**
     * Look for the first instance by parameters
     * @param array $parameters
     * @return File|null
     */
    public static function first(array $parameters)
    {
        $results = parent::first($parameters);
        return empty($results) ? null : new File ($results);
    }


    /**
     * Create a new File in the DB table and return it
     * @param array $parameters
     * @return File
     */
    public static function create(array $parameters)
    {
        $id = parent::create($parameters);
        return self::find($id);
    }


    /**
     * Get a File by ID
     * @param $id
     * @return File|null
     */
    public static function find($id)
    {
        $results = parent::find($id);
        return empty($results) ? null : new File ($results);
    }


    /**
     * return the absolute path
     * @return string
     */
    function getAbsolutePath(): string
    {
        $path = $this->folder()->getAbsolutePath();
        return "$path";
    }


    /**
     * Get the Folder what this File belongs
     * @return Folder|null
     */
    public function folder()
    {
        return Folder::find($this->folder_id);
    }


    /** Getters and Setters */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFolderId()
    {
        return $this->folder_id;
    }

    /**
     * @param mixed $folder_id
     */
    public function setFolderId($folder_id)
    {
        $this->folder_id = $folder_id;
    }


}
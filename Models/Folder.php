<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 10:45
 */

namespace Models;


class Folder extends Model
{

    private $name;
    private $parent_id;


    /**
     * Folder constructor.
     */
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'] ?? null;
        $this->name = $attributes['name'];
        $this->parent_id = $attributes['parent_id'] ?? null;
    }

    /**
     * Get all the Folders filtered by $parameters
     * @param array $paramenters
     * @return array
     */
    public static function all(array $paramenters = [])
    {
        $list = [];
        foreach (parent::all($paramenters) as $item) {
            $list[] = new Folder($item);
        }
        return $list;
    }

    /**
     * Look for the first instance by parameters create it if not exists
     * @param array $parameters
     * @return Folder|null
     */
    public static function firstOrCreate(array $parameters)
    {
        $folder = self::first($parameters);
        if (!$folder) {
            $folder = self::create($parameters);
        }
        return $folder;
    }

    /**
     * Look for the first instance by parameters
     * @param array $parameters
     * @return Folder|null
     */
    public static function first(array $parameters)
    {
        $results = parent::first($parameters);
        return empty($results) ? null : new Folder ($results);
    }

    /**
     * Create a new Folder in the DB and return  it
     * @param array $parameters
     * @return Folder
     */
    public static function create(array $parameters)
    {
        $id = parent::create($parameters);
        return self::find($id);
    }

    /**
     * Find a Folder by ID
     * @param $id
     * @return Folder|null
     */
    public static function find($id)
    {
        $results = parent::find($id);
        return empty($results) ? null : new Folder ($results);
    }

    /** Getters and Setters */

    /**
     * return the absolute path
     * @return string
     */
    function getAbsolutePath(): string
    {
        $folder = $this;
        $path = $this->name;

        while ($folder->getParentId()) {
            $path = $folder->parent()->getName() . '\\' . $path;
            $folder = $folder->parent();
        }
        return $path;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed|Folder|null
     */
    public function parent()
    {
        return Folder::find($this->getParentId());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}
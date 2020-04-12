<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 10:47
 */

namespace Controllers;


use Models\File;
use Models\Folder;
use Requests\IndexRequest;
use Views\View;


class IndexController
{

    public function index($search = null)
    {
        try {
            IndexRequest::validateSearchWord($search);

            $files = File::all(['name' => $search]);
            $folders = Folder::all(['name' => $search]);

        } catch (\Exception $exception) {
            $errors[] = $exception->getMessage();
        }

        $parameters = ['files' => $files ?? [], 'folders' => $folders ?? [], 'search' => $search, 'errors' => $errors ?? []];
        return new View("welcome", $parameters);
    }

}
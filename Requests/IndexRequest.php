<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 12/04/2020
 * Time: 15:14
 */

namespace Requests;


use Exception;
use Validators\FileValidator;
use Validators\FolderValidator;

class IndexRequest extends Exception
{
    /**
     * Check if the word contains valid format for a file or directory
     * or throw an exception
     * @param $word
     * @throws exception
     */
    public static function validateSearchWord($word){
        if(!self::searchWordRule($word)){
            throw new Exception('This word doesnt not content a valid format for a file or directory');
        }
    }

    /**
     * Directory, file or empty are allowed
     * @param $word
     * @return bool
     */
    private static function searchWordRule($word)
    {
        return FolderValidator::isDirectoryName($word) ||
            FileValidator::isName($word)
            || empty($word);
    }

}
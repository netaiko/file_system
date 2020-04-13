<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 12/04/2020
 * Time: 22:35
 */

namespace Tests;

require __DIR__ . "/../Validators/FileValidator.php";
require __DIR__ . "/../Validators/FolderValidator.php";


require __DIR__ . "/../Requests/IndexRequest.php";

use PHPUnit\Framework\TestCase;
use Validators\FileValidator;
use Validators\FolderValidator;

class ValidationTest extends TestCase
{
    /*
     * validate filename format
     */
    function testFileName(): void
    {
        $this->assertTrue(FileValidator::isName("docu.doc"));
        $this->assertTrue(FileValidator::isName("docu"));
        $this->assertFalse(FileValidator::isName("doc?u"));
    }


    /**
     * validate folder format
     */
    function testFolderName(): void
    {
        $this->assertTrue(FolderValidator::isName("docu"));
        $this->assertFalse(FolderValidator::isName("docu.doc"));
        $this->assertFalse(FolderValidator::isName("doc?u"));
        $this->assertFalse(FolderValidator::isName("doc'u"));

    }

    /**
     * validate unit format
     */
    function testUnit(): void
    {
        $this->assertTrue(FolderValidator::isUnit("U:"));
        $this->assertFalse(FolderValidator::isUnit("docu.doc"));
        $this->assertFalse(FolderValidator::isUnit("doc?u"));
        $this->assertFalse(FolderValidator::isUnit("doc'u"));
    }


}

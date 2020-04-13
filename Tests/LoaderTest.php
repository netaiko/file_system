<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 12/04/2020
 * Time: 20:14
 */


namespace Tests;

require __DIR__ . "/../config/database.php";
require __DIR__ . "/../DataBaseConnection.php";
require __DIR__ . "/../Models/Model.php";
require __DIR__ . "/../Models/File.php";
require __DIR__ . "/../Models/Folder.php";
require __DIR__ . "/../Validators/TextFileValidator.php";
require __DIR__ . "/../Validators/FolderValidator.php";
require __DIR__ . "/../Validators/FileValidator.php";
require __DIR__ . "/../Services/Loader.php";


use PHPUnit\Framework\TestCase;
use Services\Loader;


class LoaderTest extends TestCase
{
    private $loader;

    function testFileExists(): void
    {
        $this->assertFileExists("../files.txt");
    }

    public function testLoadFileText()
    {
        $this->assertEquals(2, count($this->loader->getFilesAdded()));
        $this->assertEquals(6, count($this->loader->getFoldersAdded()));
    }

    protected function setUp(): void
    {
        $lines = ["C:\\Documents\\xml\\text1.xml\n",
            "C:\\Documents\\xml\\text2.xml\n",];

        $test_file = fopen("testFiles.txt", "w") or die("Unable to open file!");

        foreach ($lines as $line) {
            fwrite($test_file, $line);
        }
        fclose($test_file);


        $this->loader = new Loader("testFiles.txt");
        $this->loader->run();
    }

    protected function tearDown(): void
    {
        foreach ($this->loader->getFilesAdded() as $file) {
            $file->delete();
        }

        foreach ($this->loader->getFoldersAdded() as $folder) {
            $folder->delete();
        }

        unlink("testFiles.txt");
    }


}

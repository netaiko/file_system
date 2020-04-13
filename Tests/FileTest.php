<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 13/04/2020
 * Time: 10:42
 */

namespace Tests;

require __DIR__ . "/../config/database.php";
require __DIR__ . "/../DataBaseConnection.php";
require __DIR__ . "/../Models/Model.php";
require __DIR__ . "/../Models/File.php";
require __DIR__ . "/../Models/Folder.php";


use Models\File;
use Models\Folder;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{

    private $folder;
    private $subfolder;
    private $file;

    public function testCreate()
    {
        $this->assertEquals($this->file->getName(), 'file');
        $this->assertEquals($this->file->getFolderId(), $this->subfolder->getId());
    }

    public function testFirst()
    {
        $first_file = File::first(['name' => $this->file->getName(), 'folder_id' => $this->file->getFolderId()]);
        $this->assertEquals($first_file->getId(), $this->file->getId());
    }

    public function testFind()
    {
        $file_found = File::find($this->file->getId());
        $this->assertEquals($file_found->getId(), $this->file->getId());
    }

    public function testGetAbsolutePath()
    {
        $this->assertEquals($this->folder->getAbsolutePath(), 'z:');
        $this->assertEquals($this->subfolder->getAbsolutePath(), 'z:\TEST');
        $this->assertEquals($this->file->getAbsolutePath(), 'z:\TEST');
    }

    public function testFolder()
    {
        $this->assertEquals($this->file->folder(), $this->subfolder);
    }

    public function testAll()
    {
        $this->assertTrue(count(File::all()) > 0);
        foreach (File::all() as $item) {
            $this->assertInstanceOf(File::class, $item);
        }
    }

    protected function setUp(): void
    {
        $this->folder = Folder::create(['name' => 'z:', 'parent_id' => null]);
        $this->subfolder = Folder::create(['name' => 'TEST', 'parent_id' => $this->folder->getId()]);
        $this->file = File::create(['name' => 'file', 'folder_id' => $this->subfolder->getId()]);
    }

    protected function tearDown(): void
    {
        $this->folder->delete();
        $this->subfolder->delete();
        $this->file->delete();
    }

}

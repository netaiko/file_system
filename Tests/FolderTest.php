<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 13/04/2020
 * Time: 14:23
 */

namespace Tests;

require __DIR__ . "/../config/database.php";
require __DIR__ . "/../DataBaseConnection.php";
require __DIR__ . "/../Models/Model.php";
require __DIR__ . "/../Models/Folder.php";


use Models\Folder;
use PHPUnit\Framework\TestCase;

class FolderTest extends TestCase
{
    private $folder;
    private $subfolder;

    public function testCreate()
    {
        $this->assertEquals($this->folder->getName(), $this->folder->getName());
        $this->assertEquals($this->subfolder->getName(), $this->subfolder->getName());
    }

    public function testFirst()
    {
        $first_folder = Folder::first(['name' => $this->folder->getName(), 'parent_id' => $this->folder->getParentId()]);

        $this->assertEquals($first_folder->getName(), $this->folder->getName());
        $this->assertEquals($first_folder->getParentId(), $this->folder->getParentId());
    }

    public function testFind()
    {
        $folder_found = Folder::find($this->folder->getId());
        $subfolder_found = Folder::find($this->subfolder->getId());

        $this->assertEquals($folder_found->getName(), $this->folder->getName());
        $this->assertEquals($subfolder_found->getName(), $this->subfolder->getName());
    }

    public function testGetAbsolutePath()
    {
        $this->assertEquals($this->folder->getAbsolutePath(), 'z:');
        $this->assertEquals($this->subfolder->getAbsolutePath(), 'z:\TEST');
    }

    public function testAll()
    {
        $this->assertTrue(count(Folder::all()) > 0);

        foreach (Folder::all() as $item) {
            $this->assertInstanceOf(Folder::class, $item);
        }
    }

    protected function setUp(): void
    {
        $this->folder = Folder::create(['name' => 'z:', 'parent_id' => null]);
        $this->subfolder = Folder::create(['name' => 'TEST', 'parent_id' => $this->folder->getId()]);
    }

    protected function tearDown(): void
    {
        $this->folder->delete();
        $this->subfolder->delete();
    }


}

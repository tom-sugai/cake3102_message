<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProgressHelper;
use Cake\TestSuite\TestCase;
use Cake\View\view;

class ProgressHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Progress = new ProgressHelper($view);
    }

    public function testBar()
    {
    
    }
}
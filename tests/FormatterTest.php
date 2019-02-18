<?php

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('TaylorNetwork\\Tests\\', __DIR__.'/');

use Orchestra\Testbench\TestCase;
use TaylorNetwork\Formatters\Name\NameFormatterServiceProvider;
use TaylorNetwork\Formatters\Name\Formatter;
use TaylorNetwork\Tests\TestCustomer;
use TaylorNetwork\Tests\CustomConfigCustomer;

class FormatterTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ NameFormatterServiceProvider::class ];
    }

    protected function getEnvironmentSetUp($app)
    {
        //
    }

    public function testDefault()
    {
        $fmt = new Formatter(new TestCustomer);
        $this->assertEquals('Test Customer', $fmt->format());
    }

    public function testAttribute()
    {
        $this->assertEquals('Test Customer', (new TestCustomer)->fullName);
    }

    public function testLastFirstStyle()
    {
        $fmt = new Formatter(new TestCustomer);
        $this->assertEquals('Customer, Test', $fmt->style('L, F')->format());
    }

    public function testInitials()
    {
        $fmt = new Formatter(new TestCustomer);
        $this->assertEquals('TC', $fmt->style('fl')->format());
    }

    public function testInitialLast()
    {
        $fmt = new Formatter(new TestCustomer);
        $this->assertEquals('T Customer', $fmt->style('f L')->format());
    }

    public function testReplaceMultiple()
    {
        $fmt = new Formatter(new TestCustomer);
        $this->assertEquals('TTTTest CCCCustomer', $fmt->style('fffF lllL')->format());
    }

    public function testCustomTrait()
    {
        $this->assertEquals('Doe, J', (new CustomConfigCustomer)->fullName);
    }
}
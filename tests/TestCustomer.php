<?php

namespace TaylorNetwork\Tests;

use TaylorNetwork\Formatters\Name\Formatter;

class TestCustomer extends TestModel
{
    protected $attributes = [
        'first_name' => 'Test',
        'last_name' => 'Customer',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['fullName'] = $this->getFullNameAttribute();
    }

    public function getFullNameAttribute()
    {
        $formatter = new Formatter($this);
        return $formatter->format();
    }
}
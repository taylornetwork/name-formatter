<?php

namespace TaylorNetwork\Tests;

use TaylorNetwork\Formatters\Name\FormatsFullName;

class CustomConfigCustomer extends TestModel
{
    use FormatsFullName;

    protected $attributes = [
        'fname' => 'John',
        'lname' => 'Doe',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['fullName'] = $this->getFullNameAttribute();
    }

    public function formatterConfig(&$formatter)
    {
        $formatter->map([
            'first_name' => 'fname',
            'last_name' => 'lname',
        ])->style('L, f');
    }
}
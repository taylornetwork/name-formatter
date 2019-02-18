<?php

namespace TaylorNetwork\Tests;

use Illuminate\Database\Eloquent\Model;

abstract class TestModel extends Model
{
    protected $attributes = [];

    public function getAttribute($attribute)
    {
        return $this->attributes[$attribute];
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}

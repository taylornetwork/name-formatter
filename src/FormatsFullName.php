<?php

namespace TaylorNetwork\Formatters\Name;

trait FormatsFullName
{
    protected $nameFormatter;

    public function getFullNameAttribute()
    {
        return $this->getFormatter()->format();
    }

    public function formatterConfig(&$formatter)
    {
        // $formatter->style('F L');
    }

    public function getFormatter()
    {
        if (!isset($this->nameFormatter) || (!$this->nameFormatter instanceof Formatter)) {
            $this->nameFormatter = new Formatter($this);
            $this->formatterConfig($this->nameFormatter);
        }

        return $this->nameFormatter;
    }
}

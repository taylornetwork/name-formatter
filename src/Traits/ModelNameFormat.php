<?php

namespace TaylorNetwork\Formatters\Name\Traits;

use TaylorNetwork\Formatters\Name\Formatter;

trait ModelNameFormat
{
    /**
     * Field Map
     * 
     * @var array
     */
    protected $fieldMap;

    /**
     * Format Style
     * 
     * @var string
     */
    protected $formatStyle;

    /**
     * @var Formatter
     */
    protected $nameFormatter;

    /**
     * Get name formatter instance, or create one
     * 
     * @return Formatter
     */
    public function getNameFormatter()
    {
        if(!isset($this->nameFormatter) || !$this->nameFormatter instanceof Formatter)
        {
            $this->nameFormatter = new Formatter($this);
            
            if(isset($this->fieldMap))
            {
                $this->nameFormatter->map($this->fieldMap);
            }
            
            if(isset($this->formatStyle))
            {
                $this->nameFormatter->style($this->formatStyle);
            }
        }
        
        return $this->nameFormatter;
    }
}
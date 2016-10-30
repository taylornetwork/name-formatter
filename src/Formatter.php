<?php

namespace TaylorNetwork\Formatters\Name;

class Formatter
{
    /**
     * Name format style
     *
     * @var string
     */
    protected $style = 'F L';

    /**
     * Model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * Field map.
     * 
     * @var array
     */
    protected $fieldMap = [];

    /**
     * NameFormatter constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
        $this->style = config('nameformatter.style');
        $this->fieldMap = config('nameformatter.fieldMap');
    }

	/**
	 * Map a field to the model's equivalent
	 *
	 * @param array|string $field
	 * @param string|null $modelField
	 * @return $this
	 */
	public function map($field, $modelField = null)
	{
        if(is_array($field))
        {
            $this->fieldMap = $field;
        }
        else
        {
            $this->fieldMap[$field] = $modelField;
        }
		return $this;
	}

    /**
     * Override the style
     *
     * @param string $style
     * @return $this
     */
    public function style($style)
    {
        $this->style = $style;
        return $this;
    }
    
    /**
     * Get a field name for model
     * 
     * @param string $field
     * @return string
     */
    public function getField($field)
    {
    	if(isset($this->fieldMap[$field]))
    	{
    		return $this->fieldMap[$field];
    	}
    	return $field;
    }

    /**
     * Format the name
     *
     * @return string
     */
    public function format()
    {
        $name = '';
        for($i=0; $i<strlen($this->style); ++$i)
        {
            switch($this->style[$i])
            {
                case 'F':
                    $name .= $this->model->{$this->getField('first_name')};
                    break;
                case 'f':
                    $name .= $this->model->{$this->getField('first_name')}[0];
                    break;
                case 'L':
                    $name .= $this->model->{$this->getField('last_name')};
                    break;
                case 'l':
                    $name .= $this->model->{$this->getField('last_name')}[0];
                    break;
                default:
                    $name .= $this->style[$i];
                    break;
            }
        }
        return $name;
    }
}
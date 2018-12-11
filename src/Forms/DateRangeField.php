<?php

namespace DeptInternalAffairsNZ\SilverStripe\Forms;

use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DateField;

class DateRangeField extends CompositeField
{

    /**
     * @var DateField
     */
    protected $from;

    /**
     * @var DateField
     */
    protected $to;

    /**
     * @var string
     */
    public $dateFormat = 'yyyy-MM-dd';

    public function __construct($name, $title = null, $value = null)
    {
        $this->name = $name;
        $this->setTitle($title);

        $this->from = new DateField($this->name . '[From]', $title, null);
        $this->to = new DateField($this->name . '[To]', $title, null);

        parent::__construct(array(
            $this->from,
            $this->to
        ));

        $this->setConfig('showcalendar', true);

        $this->from->setDateFormat($this->dateFormat);
        $this->to->setDateFormat($this->dateFormat);

        $this->setValue($value);
    }

    public function setConfig($key, $value)
    {
        $this->from->setAttribute($key, $value);
        $this->to->setAttribute($key, $value);
    }

    public function hasData()
    {
        return true;
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the field name
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->from->setName($name . '[From]');
        $this->to->setName($name . '[To]');
        return $this;
    }

    public function setTitle($title)
    {
        parent::setTitle($title);

        if ($this->from instanceof DateField) {
            $this->from->setTitle('From ' . $title);
        }

        if ($this->to instanceof DateField) {
            $this->to->setTitle('To ' . $title);
        }
    }

}

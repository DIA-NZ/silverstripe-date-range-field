<?php

namespace DeptInternalAffairsNZ\SilverStripe;

use CompositeField;
use DateField;

class DateRangeField extends CompositeField {

	/* @var $from DateField */
	protected $from;

	/* @var $to DateField */
	protected $to;

	public function __construct($name, $title = null, $value = null) {
		$this->name = $name;
		$this->setTitle($title);

		$this->from = new DateField($this->name . '[From]', $title, null);
		$this->to = new DateField($this->name . '[To]', $title, null);

		parent::__construct(array(
			$this->from,
			$this->to
		));

		$this->setConfig('showcalendar', true);
		$this->setConfig('dateformat', 'yyyy-MM-dd');

		$this->setValue($value);
	}

	public function setConfig($key, $value) {
		$this->from->setConfig($key, $value);
		$this->to->setConfig($key, $value);
	}

	public function hasData() {
		return true;
	}

	public function getValue() {
		return $this->value;
	}

	/**
	 * Set the field name
	 */
	public function setName($name) {
		$this->name = $name;
		$this->from->setName($name . '[From]');
		$this->to->setName($name . '[To]');
		return $this;
	}

	public function setTitle($title) {
		parent::setTitle($title);

		if ($this->from instanceof DateField) {
			$this->from->setTitle('From ' . $title);
		}

		if ($this->to instanceof DateField) {
			$this->to->setTitle('To ' . $title);
		}
	}

}

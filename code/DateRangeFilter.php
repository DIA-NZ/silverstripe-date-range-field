<?php

namespace DeptInternalAffairsNZ\SilverStripe;

use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataQuery;
use SilverStripe\ORM\Filters\SearchFilter;

class DateRangeFilter extends SearchFilter {

	private $min, $max;

	public function findMinMax() {
		if (!isset($this->value)) {
			return false;
		}

		$value = $this->value;

		if(is_array($value)) {
			if (isset($value['From'])) {
				$fromDate = $value['From'];
			}

			if (isset($value['To'])) {
				$toDate = $value['To'];
			}

			$value = $fromDate . '-to-' . $toDate;
		}

		if (strpos($value, '-to-') !== FALSE) {
			$valueArray = explode('-to-', $value);

			if ($valueArray[0] != 0) {
				$this->setMin($valueArray[0]);
			}

			if ($valueArray[1] != 0) {
				$this->setMax($valueArray[1]);
			}
		}
	}

	public function setMin($min) {
		$this->min = $min;
	}

	public function setMax($max) {
		$this->max = $max;
	}

	public function apply(DataQuery $query) {
		if (!isset($this->min) || !isset($this->max)) {
			$this->findMinMax();
		}

		if ($this->min) {
			$query->where(sprintf(
				"%s >= '%s'",
				$this->getDbName(),
				Convert::raw2sql($this->min)
			));
		}

		if ($this->max) {
			$query->where(sprintf(
				"%s <= '%s'",
				$this->getDbName(),
				Convert::raw2sql($this->max)
			));
		}
	}

	/**
	 * Applies a match on the starting characters of a field value.
	 *
	 * @return DataQuery
	 */
	protected function applyOne(DataQuery $query) {
		return true;
	}

	/**
	 * Applies a match on the starting characters of a field value.
	 *
	 * @return DataQuery
	 */
	protected function applyMany(DataQuery $query) {
		return true;
	}

	/**
	 * Excludes a match on the starting characters of a field value.
	 *
	 * @return DataQuery
	 */
	protected function excludeOne(DataQuery $query) {
		return true;
	}

}
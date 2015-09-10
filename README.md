# SilverStripe date range field

A date range field for SilverStripe. Based heavily on dnadesign/silverstripe-datedropdownselectorfield but using SilverStripe's DateField.

Our primary use case for this module was for use in a ModelAdmin within the CMS - it hasn't been tested anywhere else so use with care.

## Installation

Use composer:

    composer require 'deptinternalaffairsnz/silverstripe-date-range-field' '1.0.0'

## Usage

When configuring `searchable_fields` for a `DataObject` you can make use of the `DateRangeField` and `DateRangeFilter` like so:

    private static $searchable_fields = array(
        'Created' => array(
            'title' => 'created date',
            'field' => 'DeptInternalAffairsNZ\SilverStripe\DateRangeField',
            'filter' => 'DeptInternalAffairsNZ\SilverStripe\DateRangeFilter'
        )
    );
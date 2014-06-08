<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Filter\ArrayFilter;
use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Filters\Filter;

class Constraint
{
    public $name;

    public $message;

    public $value;

    public $hasError = false;

    public $stopCheckOnError = true;

    /** @var bool Defines whether non empty input value is required to check at all */
    public $required = false;

    /** @var bool Defines whether empty values should be checked at all */
    public $checkEmptyValues = true;

    /** @var ConstraintCheck[] */
    protected $_checks = array();

    /** @var Filter[] */
    protected $_filters = array();

    function __construct($name = null, $value = null, $message = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->message = $message;
    }

    public function addFilter(Filter $filter, $prepend = false)
    {
        if ($prepend) {
            array_unshift($this->_filters, $filter);

        } else {
            $this->_filters[] = $filter;
        }
    }

    public function addCheck(Check $check, $id = null, $message = null)
    {
        $c = new ConstraintCheck();
        $c->check = $check;
        $c->message = $message;

        if ($id === null) {
            $id = $check->id;
        }

        $this->_checks[$id] = $c;
    }

    protected function _isEmpty($value)
    {
        return $value === null;
    }

    public function fetch(ArrayFilter $data)
    {
        $v = $data->get($this->name);

        foreach ($this->_filters as $filter) {
            $v = $filter->doFiltering($v);
        }

        $this->value = $v;

        return $this->value;
    }

    public function check($skipEmptyErrors = false)
    {
        $this->hasError = false;
        $errors = array();

        $isEmpty = $this->_isEmpty($this->value);

        if ($isEmpty) {
            if (!$this->checkEmptyValues) {
                return $errors;

            } elseif ($this->required) {
                $this->hasError = true;
                $errors['required'] = null;

                return $errors;
            }
        }

        foreach ($this->_checks as $id => $check) {
            $valid = $check->check->isValid($this->value);

            if (!$valid) {
                $this->hasError = true;

                if (!$skipEmptyErrors || $check->message !== null) {
                    $errors[$id] = $check->message;
                }

                if ($this->stopCheckOnError) {
                    break;
                }
            }
        }

        return $errors;
    }
}

class ConstraintCheck
{
    /** @var Check */
    public $check;

    public $message;
}
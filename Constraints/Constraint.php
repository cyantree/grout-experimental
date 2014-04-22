<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Filter\ArrayFilter;
use Cyantree\Grout\Form\FormStatus;
use Cyantree\Grout\Checks\Check;

class Constraint
{
    public $name;

    public $message;

    public $value;

    public $stopCheckOnError = true;

    public $allowEmpty = false;

    /** @var ConstraintCheck[] */
    protected $_checks = array();

    function __construct($name = null, $value = null, $message = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->message = $message;
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

    public function fetch(ArrayFilter $data)
    {
        $this->value = $data->get($this->name);

        return $this->value;
    }

    public function check($skipEmptyErrors = false)
    {
        $errors = null;
        $isValid = true;

        if ($this->allowEmpty && ($this->value === '' || $this->value === null)) {
            return true;
        }

        foreach ($this->_checks as $id => $check) {
            $valid = $check->check->isValid($this->value);

            if (!$valid) {
                if ($isValid) {
                    $isValid = false;
                    $errors = array();
                }

                if (!$skipEmptyErrors || $check->message !== null) {
                    $errors[$id] = $check->message;
                }

                if ($this->stopCheckOnError) {
                    break;
                }
            }
        }

        return $isValid ? true : $errors;
    }
}

class ConstraintCheck
{
    /** @var Check */
    public $check;

    public $message;
}
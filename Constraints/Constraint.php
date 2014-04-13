<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Filter\ArrayFilter;
use Cyantree\Grout\Form\FormStatus;
use Cyantree\Grout\Checks\Check;

class Constraint
{
    public $name;

    public $value;

    public $hasError = false;
    public $stopCheckOnError = true;

    /** @var Check[] */
    public $checks = array();

    function __construct($name = null, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function addCheck(Check $check)
    {
        $this->checks[] = $check;
    }

    public function fetch(ArrayFilter $data)
    {
        $this->value = $data->get($this->name);

        return $this->value;
    }

    public function check()
    {
        $this->hasError = false;

        foreach ($this->checks as $check) {
            $check->check($this->value);

            if ($check->hasErrors) {
                $this->hasError = true;

                if ($this->stopCheckOnError) {
                    return false;
                }
            }
        }

        return !$this->hasError;
    }

    public function pushStatus(FormStatus $status)
    {
        foreach ($this->checks as $check) {
            if ($check->hasErrors) {
                $status->postError($this->name);

                foreach ($check->errors as $code => $message) {
                    $status->postError($this->name . '.' . $code, $message);
                }
            }
        }
    }
}
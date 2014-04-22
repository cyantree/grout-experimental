<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Filter\ArrayFilter;
use Cyantree\Grout\Form\FormStatus;
use Cyantree\Grout\Tools\ArrayTools;

class ConstraintContainer
{
    /** @var Constraint[] */
    public $constraints = array();

    public function add(Constraint $constraint)
    {
        $this->constraints[$constraint->name] = $constraint;
    }

    /** @return Constraint */
    public function get($name)
    {
        return $this->constraints[$name];
    }

    public function fetch(ArrayFilter $data)
    {
        foreach ($this->constraints as $constraint) {
            $constraint->fetch($data);
        }
    }

    public function check($includeSubErrors = true, $skipEmptyErrors = false)
    {
        $isValid = true;
        $errors = null;

        foreach ($this->constraints as $constraint) {
            $result = $constraint->check($skipEmptyErrors);

            if ($result !== true) {
                if ($isValid) {
                    $isValid = false;
                    $errors = array();
                }

                $errors[$constraint->name] = $constraint->message;

                if ($includeSubErrors) {
                    foreach ($result as $code => $message) {
                        $errors[$constraint->name . '.' . $code] = $message;
                    }
                }
            }
        }

        return $isValid ? true : $errors;
    }

    public function dumpValuesTo($arrayOrObject, $exclude = null)
    {
        if ($exclude !== null) {
            $exclude = ArrayTools::convertToKeyArray($exclude);
        }

        if (is_array($arrayOrObject)) {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $arrayOrObject[$name] = $constraint->value;
            }

        } else {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $arrayOrObject->{$name} = $constraint->value;
            }
        }
    }

    public function getValues()
    {
        $res = array();

        foreach ($this->constraints as $name => $constraint) {
            $res[$name] = $constraint->value;
        }

        return $res;
    }

    public function loadValuesFrom($arrayOrObject, $exclude = null)
    {
        if ($exclude !== null) {
            $exclude = ArrayTools::convertToKeyArray($exclude);
        }

        if (is_array($arrayOrObject)) {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $constraint->value = $arrayOrObject[$name];
            }

        } else {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $constraint->value = $arrayOrObject->{$name};
            }
        }
    }
}
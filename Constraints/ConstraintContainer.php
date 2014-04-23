<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Filter\ArrayFilter;
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

    public function fetch(ArrayFilter $data, $exclude = null)
    {
        if ($exclude !== null) {
            $exclude = ArrayTools::convertToKeyArray($exclude);
        }

        foreach ($this->constraints as $name => $constraint) {
            if ($exclude !== null && isset($exclude[$name])) {
                continue;
            }

            $constraint->fetch($data);
        }
    }

    public function check($includeSubErrors = true, $skipEmptyErrors = false)
    {
        $errors = array();

        foreach ($this->constraints as $constraint) {
            $constraintErrors = $constraint->check($skipEmptyErrors);

            if (count($constraintErrors)) {
                $errors[$constraint->name] = $constraint->message;

                if ($includeSubErrors) {
                    foreach ($constraintErrors as $code => $message) {
                        $errors[$constraint->name . '.' . $code] = $message;
                    }
                }
            }
        }

        return $errors;
    }

    public function copyValuesTo(&$arrayOrObject, $exclude = null)
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

    public function loadValuesFrom($arrayOrObjectOrArrayFilter, $exclude = null)
    {
        if ($arrayOrObjectOrArrayFilter instanceof ArrayFilter) {
            $arrayOrObjectOrArrayFilter = $arrayOrObjectOrArrayFilter->getData();
        }

        if ($exclude !== null) {
            $exclude = ArrayTools::convertToKeyArray($exclude);
        }

        if (is_array($arrayOrObjectOrArrayFilter)) {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $constraint->value = isset($arrayOrObjectOrArrayFilter[$name]) ? $arrayOrObjectOrArrayFilter[$name] : null;
            }

        } else {
            foreach ($this->constraints as $name => $constraint) {
                if ($exclude !== null && isset($exclude[$name])) {
                    continue;
                }

                $constraint->value = isset($arrayOrObjectOrArrayFilter->{$name}) ? $arrayOrObjectOrArrayFilter->{$name} : null;
            }
        }
    }
}
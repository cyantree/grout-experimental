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

    public function check()
    {
        $success = true;

        foreach ($this->constraints as $constraint) {
            if (!$constraint->check()) {
                $success = false;
            }
        }

        return $success;
    }

    public function pushStatus(FormStatus $status) {
        foreach ($this->constraints as $constraint) {
            $constraint->pushStatus($status);
        }
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
<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\InRange;
use Cyantree\Grout\Checks\IsInteger;

class NumberConstraint extends Constraint
{
    public $min = null;
    public $max = null;
    public $isInteger = false;

    protected function isEmpty($value)
    {
        return $value === '' || $value === null;
    }

    public function setMin($min, $message = null)
    {
        $this->addCheck(new InRange($min), 'isMin', $message);

        $this->min = $min;

        if ($min) {
            $this->required = true;
        }
    }

    public function setMax($max, $message = null)
    {
        $this->addCheck(new InRange(null, $max), 'isMax', $message);

        $this->max = $max;
    }

    public function setMinMax($min, $max, $message = null)
    {
        $this->addCheck(new InRange($min, $max), 'isMinMax', $message);

        $this->min = $min;
        $this->max = $max;

        if ($this->min) {
            $this->required = true;
        }
    }

    public function requireInteger($message)
    {
        $this->addCheck(new IsInteger(), 'isInteger', $message);
    }
}

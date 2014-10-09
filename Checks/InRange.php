<?php
namespace Cyantree\Grout\Checks;

class InRange extends Check
{
    public $min = null;
    public $max = null;

    public function __construct($min = null, $max = null)
    {
        parent::__construct();

        $this->min = $min;
        $this->max = $max;
    }

    public function isValid($value)
    {
        return !(($this->min !== null && $value < $this->min) ||
              ($this->max !== null && $value > $this->max));
    }
}

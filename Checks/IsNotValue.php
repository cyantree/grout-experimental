<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;

class IsNotValue extends Check
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
    public function isValid($value)
    {
        return $value != $this->value;
    }
}
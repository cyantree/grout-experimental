<?php
namespace Cyantree\Grout\Checks;

class IsInteger extends Check
{
    public $id = 'isInteger';

    public function isValid($value)
    {
        return strval(intval($value)) === strval($value);
    }
}

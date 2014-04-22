<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsInteger extends Check
{
    public $id = 'isInteger';

    public function isValid($value)
    {
        return strval(intval($value)) === strval($value);
    }
}
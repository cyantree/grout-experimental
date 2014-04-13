<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsInteger extends Check
{
    public function check($value)
    {
        if (strval(intval($value)) !== strval($value)) {
            $this->addError('isInteger');
        }
    }
}
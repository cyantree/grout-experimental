<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsEmailAddress extends Check
{
    public $id = 'isEmailAddress';

    public function isValid($value)
    {
        return StringTools::isEmailAddress($value);
    }
}

<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsUrl extends Check
{
    public $id = 'isUrl';

    public function isValid($value)
    {
        return StringTools::isUrl($value);
    }
}
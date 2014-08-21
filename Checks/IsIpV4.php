<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\StringTools;

class IsIpV4 extends Check
{
    public $id = 'isIpV4';

    public function isValid($value)
    {
        return StringTools::isIp($value);
    }
}
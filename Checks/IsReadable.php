<?php
namespace Cyantree\Grout\Checks;

class IsReadable extends Check
{
    public function isValid($value)
    {
        return !preg_match('/[^\p{L}\p{M}\p{N}\p{P}\p{S}\p{Z}\r\n\t]/u', $value);
    }
}

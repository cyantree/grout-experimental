<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsUrl extends Check
{
    public function check($value)
    {
        if (ArrayTools::get($this->options, 'allowEmpty') && $value == '') {
            return;
        }

        if (!StringTools::isUrl($value)) {
            $this->addError('isUrl');
        }
    }
}
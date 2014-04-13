<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class InArray extends Check
{
    public $array;

    public function __construct($array, $messageOrOptions)
    {
        parent::__construct($messageOrOptions);

        $this->array = $array;
    }
    public function check($value)
    {
        if (!in_array($value, $this->array)) {
            $this->addError('inArray');
        }
    }
}
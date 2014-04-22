<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class InArray extends Check
{
    public $id = 'inArray';

    public $array;

    public function __construct($array)
    {
        parent::__construct();

        $this->array = $array;
    }
    public function isValid($value)
    {
        return in_array($value, $this->array);
    }
}
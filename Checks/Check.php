<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;

class Check
{
    public $id;

    public function __construct()
    {

    }

    public function isValid($value)
    {
        return true;
    }
}
<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;

abstract class Check
{
    public $id;

    public function __construct()
    {

    }

    abstract public function isValid($value);
}

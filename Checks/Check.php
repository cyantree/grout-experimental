<?php
namespace Cyantree\Grout\Checks;

abstract class Check
{
    public $id;

    public function __construct()
    {

    }

    abstract public function isValid($value);
}

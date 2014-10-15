<?php
namespace Cyantree\Grout\Checks;

class MatchesRegEx extends Check
{
    public $id = 'matchesRegEx';

    public $regEx;

    public function __construct($regEx)
    {
        parent::__construct();

        $this->regEx = $regEx;
    }
    public function isValid($value)
    {
        return preg_match($this->regEx, $value);
    }
}

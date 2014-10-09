<?php
namespace Cyantree\Grout\Checks;

class HasLength extends Check
{
    public $minLength = null;
    public $maxLength = null;

    public function __construct($minLength = null, $maxLength = null)
    {
        parent::__construct();

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function isValid($value)
    {
        $len = mb_strlen($value);

        return !(($this->minLength !== null && $len < $this->minLength) ||
              ($this->maxLength !== null && $len > $this->maxLength));
    }
}

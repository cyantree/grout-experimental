<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\HasLength;

class TextConstraint extends Constraint
{
    public $minLength = null;
    public $maxLength = null;

    function __construct($name = null, $value = null)
    {
        parent::__construct($name, $value);
    }

    public function setMinLength($length, $message = null)
    {
        $this->addCheck(new HasLength($length, null, $message));

        $this->minLength = $length;
    }

    public function setMaxLength($length, $message = null)
    {
        $this->addCheck(new HasLength(null, $length, $message));

        $this->maxLength = $length;
    }

    protected function _onCheck()
    {
        $len = mb_strlen($this->value);

        if ($this->minLength !== null && $len < $this->minLength) {
            return false;
        }

        if ($this->maxLength !== null && $len > $this->maxLength) {
            return false;
        }

        return true;
    }
}
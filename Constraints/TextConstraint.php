<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\HasLength;

class TextConstraint extends Constraint
{
    public $minLength = null;
    public $maxLength = null;

    public function setMinLength($length, $message = null)
    {
        $this->addCheck(new HasLength($length), null, $message);

        $this->minLength = $length;
    }

    public function setMaxLength($length, $message = null)
    {
        $this->addCheck(new HasLength(null, $length), null, $message);

        $this->maxLength = $length;
    }
}
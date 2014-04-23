<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\HasLength;
use Cyantree\Grout\Filters\SanitizeString;

class TextConstraint extends Constraint
{
    public $minLength = null;
    public $maxLength = null;

    public function setMinLength($length, $message = null)
    {
        $this->addCheck(new HasLength($length), 'hasMinLength', $message);

        $this->minLength = $length;

        if ($length) {
            $this->required = true;
        }
    }

    protected function _isEmpty($value)
    {
        return $value === '' || $value === null;
    }

    public function setMaxLength($length, $message = null)
    {
        $this->addCheck(new HasLength(null, $length), 'hasMaxLength', $message);

        $this->maxLength = $length;
    }

    public function setMinMaxLength($minLength, $maxLength, $message = null)
    {
        $this->addCheck(new HasLength($minLength, $maxLength), 'hasLength', $message);

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;

        if ($this->minLength) {
            $this->required = true;
        }
    }

    public function sanitizeInput($trim = true, $collapseLines = false, $collapseSpaces = false)
    {
        $this->addFilter(new SanitizeString($trim, $collapseLines, $collapseSpaces));
    }
}
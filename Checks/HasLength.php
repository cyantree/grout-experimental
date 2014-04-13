<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;

class HasLength extends Check
{
    public $minLength = null;
    public $maxLength = null;

    public function __construct($minLength = null, $maxLength = null, $messageOrOptions = null)
    {
        parent::__construct($messageOrOptions);

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function check($value)
    {
        $len = mb_strlen($value);

        if (
              ($this->minLength !== null && $len < $this->minLength) ||
              ($this->maxLength !== null && $len > $this->maxLength)) {
            $this->addError('hasLength');
        }
    }
}
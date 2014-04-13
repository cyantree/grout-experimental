<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Tools\StringTools;

class IsCorrect extends Check
{
    public $correctOrClosure;

    public function __construct($correctOrClosure, $messageOrOptions = null)
    {
        parent::__construct($messageOrOptions);

        $this->correctOrClosure = $correctOrClosure;
    }
    public function check($value)
    {
        if (is_callable($this->correctOrClosure)) {
            if (!call_user_func($this->correctOrClosure, $this, $value)) {
                $this->addError(ArrayTools::get($this->options, 'error', 'manual'));
            }

        } elseif (!$this->correctOrClosure) {
            $this->addError(ArrayTools::get($this->options, 'error', 'manual'));
        }
    }
}
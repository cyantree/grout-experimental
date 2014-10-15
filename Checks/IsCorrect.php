<?php
namespace Cyantree\Grout\Checks;

class IsCorrect extends Check
{
    public $id = 'isCorrect';

    public $correctOrClosure;

    public function __construct($correctOrClosure)
    {
        parent::__construct();

        $this->correctOrClosure = $correctOrClosure;
    }
    public function isValid($value)
    {
        if (is_callable($this->correctOrClosure)) {
            return call_user_func($this->correctOrClosure, $this, $value);

        }

        return $this->correctOrClosure;
    }
}

<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\InArray;

class ListConstraint extends Constraint
{
    public $options;

    function __construct($name = null, $value = null)
    {
        parent::__construct($name, $value);
    }

    public function setOptions($options, $message = null)
    {
        $this->addCheck(new InArray($options, $message));

        $this->options = $options;
    }
}
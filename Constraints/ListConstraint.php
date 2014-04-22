<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\InArray;

class ListConstraint extends Constraint
{
    public $options;

    public function setOptions($options, $message = null)
    {
        $this->addCheck(new InArray($options), null, $message);

        $this->options = $options;
    }
}
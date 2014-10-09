<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\InArray;
use Cyantree\Grout\Checks\IsNotValue;

class ListConstraint extends Constraint
{
    public $options;

    public function setRequired($message = null)
    {
        $this->required = true;
        $this->addCheck(new IsNotValue(''), null, $message);
    }

    public function setOptions($options, $message = null)
    {
        $this->addCheck(new InArray(array_keys($options)), null, $message);
        $this->options = $options;
    }
}

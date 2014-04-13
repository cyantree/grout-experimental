<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Tools\ArrayTools;

class Check
{
    public $options;

    public $errors = array();
    public $hasErrors = false;

    public function __construct($messageOrOptions = null)
    {
        if (is_string($messageOrOptions)) {
            $this->options = array('message' => $messageOrOptions);

        } else {
            $this->options = $messageOrOptions;
        }
    }

    public function check($value)
    {

    }

    public function addError($code, $message = null)
    {
        if ($message === null) {
            $message = ArrayTools::get($this->options, 'message');
        }

        $this->errors[$code] = $message;
        $this->hasErrors = true;
    }
}
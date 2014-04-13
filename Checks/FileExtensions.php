<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Types\FileUpload;

class FileExtensions extends Check
{
    const MODE_REQUIRED = 'required';
    const MODE_PERMITTED = 'permitted';

    private $_extensions;
    private $_mode;

    private $_ignoreCase = false;

    public function __construct($extensions, $mode, $messageOrOptions = null)
    {
        parent::__construct($messageOrOptions);

        $this->_ignoreCase = ArrayTools::get($this->options, 'ignoreCase');
        $this->_mode = $mode;

        if ($this->_ignoreCase) {
            $this->_extensions = explode('/', strtolower(implode('/', $extensions)));

        } else {
            $this->_extensions = $extensions;
        }
    }

    public function check($fileUploadOrPath)
    {

        if ($fileUploadOrPath == '') {
            return;
        }

        if ($fileUploadOrPath instanceof FileUpload) {
            $filename = $fileUploadOrPath->name;

        } else {
            $filename = $fileUploadOrPath;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($this->_ignoreCase) {
            $extension = strtolower($extension);
        }

        if (($this->_mode == self::MODE_REQUIRED && !in_array($extension, $this->_extensions)) ||
              ($this->_mode == self::MODE_PERMITTED && in_array($extension, $this->_extensions))) {
            $this->addError('fileExtensions');
        }
    }
}
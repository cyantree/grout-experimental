<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Types\FileUpload;

class FileExtensions extends Check
{
    const MODE_REQUIRED = 'required';
    const MODE_FORBIDDEN = 'forbidden';

    public $extensions;
    public $mode;
    public $ignoreCase;

    public function __construct($extensions, $mode, $ignoreCase = false)
    {
        parent::__construct();

        $this->ignoreCase = $ignoreCase;
        $this->mode = $mode;

        if ($this->ignoreCase) {
            $this->extensions = explode('/', strtolower(implode('/', $extensions)));

        } else {
            $this->extensions = $extensions;
        }
    }

    public function isValid($fileUploadOrPath)
    {
        if ($fileUploadOrPath instanceof FileUpload) {
            $filename = $fileUploadOrPath->name;

        } else {
            $filename = $fileUploadOrPath;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        if ($this->ignoreCase) {
            $extension = strtolower($extension);
        }

        return !(($this->mode == self::MODE_REQUIRED && !in_array($extension, $this->extensions)) ||
              ($this->mode == self::MODE_FORBIDDEN && in_array($extension, $this->extensions)));
    }
}

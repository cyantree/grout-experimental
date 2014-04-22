<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Types\FileUpload;

class HasFilesize extends Check
{
    public $minSize = null;
    public $maxSize = null;

    public function __construct($minSize = null, $maxSize = null)
    {
        parent::__construct();

        $this->minSize = $minSize;
        $this->maxSize = $maxSize;
    }

    public function isValid($fileUploadOrPath)
    {
        if ($fileUploadOrPath instanceof FileUpload) {
            $size = $fileUploadOrPath->size;

        } else {
            $size = filesize($fileUploadOrPath);
        }

        return !(($this->minSize !== null && $size < $this->minSize) ||
              ($this->maxSize !== null && $size > $this->maxSize));
    }
}
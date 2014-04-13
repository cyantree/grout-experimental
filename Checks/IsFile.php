<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Types\FileUpload;

class IsFile extends Check
{
    public function check($fileUploadOrPath)
    {
        if ($fileUploadOrPath instanceof FileUpload) {
            if (!is_file($fileUploadOrPath->file)) {
                $this->addError('isFile');
            }
        } else {
            if (!is_file($fileUploadOrPath)) {
                $this->addError('isFile');
            }
        }
    }
}
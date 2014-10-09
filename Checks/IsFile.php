<?php
namespace Cyantree\Grout\Checks;

use Cyantree\Grout\Checks\Check;
use Cyantree\Grout\Types\FileUpload;

class IsFile extends Check
{
    public $id = 'isFile';

    public function isValid($fileUploadOrPath)
    {
        if ($fileUploadOrPath instanceof FileUpload) {
            if (!is_file($fileUploadOrPath->file)) {
                return false;
            }

        } else {
            if (!is_file($fileUploadOrPath)) {
                return false;
            }
        }

        return true;
    }
}

<?php
namespace Cyantree\Grout\Constraints;

use Cyantree\Grout\Checks\FileExtensions;
use Cyantree\Grout\Checks\HasFilesize;
use Cyantree\Grout\Checks\IsFile;
use Cyantree\Grout\Constraints\Constraint;
use Cyantree\Grout\Filter\ArrayFilter;
use Cyantree\Grout\Types\FileUpload;

class FileConstraint extends Constraint
{
    public $required = true;

    /** @return FileUpload */
    public function getFileUpload()
    {
        /** @var FileUpload $u */
        $u = $this->value;
        return $u;
    }

    public function fetch(ArrayFilter $data)
    {
        $this->value = FileUpload::fromPhpFileArray($data->get($this->name));

        return $this->value;
    }

    protected function isEmpty($value)
    {
        /** @var $value FileUpload */

        return $value === null || !$value->size;
    }

    public function setRequired($message = null)
    {
        $this->required = true;
        $this->addCheck(new IsFile(), null, $message);
    }

    public function setFilesize($minSize, $maxSize, $message = null)
    {
        $this->addCheck(new HasFilesize($minSize, $maxSize), null, $message);
    }

    public function setMaxFilesize($size, $message = null)
    {
        $this->addCheck(new HasFilesize(null, $size), null, $message);
    }

    public function setMinFilesize($size, $message = null)
    {
        $this->addCheck(new HasFilesize($size), null, $message);
    }

    public function setAllowedExtensions($extensions, $message = null)
    {
        $this->addCheck(new FileExtensions($extensions, FileExtensions::MODE_REQUIRED, true), null, $message);
    }

    public function setForbiddenExtensions($extensions, $message = null)
    {
        $this->addCheck(new FileExtensions($extensions, FileExtensions::MODE_FORBIDDEN, true), null, $message);
    }
}

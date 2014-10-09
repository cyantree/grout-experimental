<?php
namespace Cyantree\Grout\Filters;

class SanitizeString extends Filter
{
    public $trim = true;
    public $collapseLines = false;
    public $collapseSpaces = false;

    public function __construct($trim = true, $collapseLines = false, $collapseSpaces = false)
    {
        $this->trim = $trim;
        $this->collapseLines = $collapseLines;
        $this->collapseSpaces = $collapseSpaces;
    }

    public function doFiltering($value)
    {
        // Remove non printable characters
        $value = preg_replace('![^\p{L}\p{M}\p{N}\p{P}\p{S}\p{Z}\r\n]!u', '', $value);

        if ($this->collapseLines) {
            $value = str_replace(array("\r", "\n"), array('', ' '), $value);
//            $value = preg_replace('![\r\n]!', ' ', $value);
//            $value = preg_replace('![\r\n]!', ' ', $value);
        }

        if ($this->collapseSpaces) {
            $value = preg_replace('![ ]{2,}!', ' ', $value);
        }

        if ($this->trim) {
            $value = trim($value);
        }

        return $value;
    }
}

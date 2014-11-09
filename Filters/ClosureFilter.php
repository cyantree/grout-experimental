<?php
namespace Cyantree\Grout\Filters;

class ClosureFilter extends Filter
{
    private $closure;

    public function __construct($closure)
    {
        $this->closure = $closure;
    }

    public function doFiltering($value)
    {
        return call_user_func($this->closure, $this, $value);
    }
}

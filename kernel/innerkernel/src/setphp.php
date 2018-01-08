<?php
namespace Karmate\Kernel\InnerKernel\Src;

class SetPHP
{
    /**
    * Set error reporting function
    * @param '1' or '0'
    */
    public function error_reporting($param)
    {
		error_reporting($param);
		return $this;
	}

}

<?php
namespace Stk2k\Collection\Util;

interface EqualableInterface
{
    /**
     *  Check whether specified item is same to this object
     *
     * @param mixed $other
     *
     * @return bool
     */
    public function equals( $other ) : bool;
}


<?php
namespace Stk2k\Collection;

use ArrayAccess;
use IteratorAggregate;

use Stk2k\Collection\Util\PhpArrayTrait;

class HashMap extends Collection implements ArrayAccess, IteratorAggregate
{
    use PhpArrayTrait;

    /**
     * get list of keys
     */
    public function keys() : array
    {
        return $this->_keys();
    }

    /**
     * get list of values
     */
    public function values() : array
    {
        return $this->_values();
    }

    /**
     *  check if specified key is in the list
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function hasKey($key) : bool
    {
        return $this->_isset($key, false);
    }

    /**
     * Get an element value
     *
     * @param mixed $key
     *
     * @return mixed|NULL
     */
    public function get($key)
    {
        return $this->_get($key, false);
    }

    /**
     * update an element value
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return HashMap
     */
    public function set($key, $value) : HashMap
    {
        $values = $this->_set($key, $value, false);
        $this->setValues($values);
        return $this;
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->_get($offset, false);
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $values = $this->_set($offset, $value, false);
        $this->setValues($values);
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->_isset($offset, false);
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        $values = $this->_unset($offset, false);
        $this->setValues($values);
    }

}


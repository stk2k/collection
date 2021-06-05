<?php
declare(strict_types=1);

namespace stk2k\collection;

use ArrayAccess;

use stk2k\collection\Util\PhpArrayTrait;

class Vector extends Collection implements ArrayAccess
{
    use PhpArrayTrait;

    /**
     *  Get element value
     *
     * @param int $index
     *
     * @return mixed
     */
    public function get(int $index)
    {
        return $this->_get($index, true);
    }

    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     *
     * @return Vector
     */
    public function set($index, $value) : Vector
    {
        $values = $this->_set($index, $value, true);
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
        return $this->_get($offset, true);
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $values = $this->_set($offset, $value, true);
        $this->setValues($values);
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->_isset($offset, true);
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        $values = $this->_unset($offset, true);
        $this->setValues($values);
    }

    /**
     *  Find index of element
     *
     * @param mixed $target
     * @param int|NULL $start
     *
     * @return bool|int
     */
    public function indexOf($target, int $start = NULL )
    {
        return $this->_indexOf($target, $start);
    }

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function push(... $items) : Vector
    {
        $values = $this->_pushAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return Vector
     */
    public function pushAll(array $items) : Vector
    {
        $values = $this->_pushAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     * Pop item from stack
     *
     * @param mixed & $item
     *
     * @return Vector
     */
    public function pop(& $item) : Vector
    {
        $values = $this->_pop($item);
        $this->setValues($values);
        return $this;
    }

    /**
     * Get head element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function first(callable $callback = null)
    {
        return $this->_first($callback);
    }

    /**
     * Get tail element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function last(callable $callback = null)
    {
        return $this->_last($callback);
    }

    /**
     * remove element by index
     *
     * @param int|Integer $start
     * @param int|Integer|NULL $length
     *
     * @return Vector
     */
    public function remove(int $start, int $length = null) : Vector
    {
        $values = $this->_remove($start, $length);
        $this->setValues($values);
        return $this;
    }

    /**
     *  get item from head
     *
     * @param mixed & $item
     *
     * @return Vector
     */
    public function shift(& $item) : Vector
    {
        $values = $this->_shift($item);
        $this->setValues($values);
        return $this;
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function unshift(... $items) : Vector
    {
        $values = $this->_unshiftAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function unshiftAll(array $items) : Vector
    {
        $values = $this->_unshiftAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return Vector
     */
    public function reverse() : Vector
    {
        $values = $this->_reverse();
        $this->setValues($values);
        return $this;
    }

    /**
     * Apply callback to each elements
     *
     * @param callable $callback
     *
     * @return Vector
     */
    public function map($callback) : Vector
    {
        $values = $this->_map($callback);
        $this->setValues($values);
        return $this;
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return Vector
     */
    public function replace($from, $to)
    {
        $values = $this->_replace($from, $to);
        $this->setValues($values);
        return $this;
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     *
     * @return Vector
     */
    public function replaceAll(array $from_to)
    {
        $values = $this->_replaceAll($from_to);
        $this->setValues($values);
        return $this;
    }

    /**
     * Merge with array data
     *
     * @param $data
     *
     * @return Vector
     */
    public function merge(array $data) : Vector
    {
        $values = $this->_merge($data);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return Vector
     */
    public function sort(callable $callback = null) : Vector
    {
        $values = $this->_sort($callback);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable $callback
     *
     * @return Vector
     */
    public function sortBy(string $field, callable $callback = null) : Vector
    {
        $values = $this->_sortBy($field, $callback);
        $this->setValues($values);
        return $this;
    }
}


<?php
namespace Stk2k\Collection;

use Stk2k\Collection\Util\PhpArrayTrait;

class ArrayList extends Collection
{
    use PhpArrayTrait;

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return ArrayList
     */
    public function push(... $items) : ArrayList
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
     * @return ArrayList
     */
    public function pushAll(array $items) : ArrayList
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
     * @return ArrayList
     */
    public function pop(& $item) : ArrayList
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
     * @return ArrayList
     */
    public function remove(int $start, int $length = null) : ArrayList
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
     * @return ArrayList
     */
    public function shift(& $item) : ArrayList
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
     * @return ArrayList
     */
    public function unshift(... $items) : ArrayList
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
     * @return ArrayList
     */
    public function unshiftAll(array $items) : ArrayList
    {
        $values = $this->_unshiftAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return ArrayList
     */
    public function reverse() : ArrayList
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
     * @return ArrayList
     */
    public function map($callback) : ArrayList
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
     * @return ArrayList
     */
    public function replace($from, $to) : ArrayList
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
     * @return ArrayList
     */
    public function replaceAll(array $from_to) : ArrayList
    {
        $values = $this->_replaceAll($from_to);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return ArrayList
     */
    public function sort(callable $callback = null) : ArrayList
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
     * @return ArrayList
     */
    public function sortBy(string $field, callable $callback = null) : ArrayList
    {
        $values = $this->_sortBy($field, $callback);
        $this->setValues($values);
        return $this;
    }

    
}


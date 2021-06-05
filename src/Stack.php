<?php
declare(strict_types=1);

namespace stk2k\collection;

use stk2k\collection\Util\PhpArrayTrait;

class Stack extends Collection
{
    use PhpArrayTrait;

    /**
     * @return Stack
     */
    protected function getSelf()
    {
        return $this;
    }

    /**
     * Get the item which is top of the stack
     *
     * @return mixed
     */
    public function peek()
    {
        return $this->_last();
    }

    /**
     * Push item to the top of stack
     *
     * @param mixed $items
     *
     * @return Stack
     */
    public function push(... $items) : Stack
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
     * @return Stack
     */
    public function pop(& $item) : Stack
    {
        $values = $this->_pop($item);
        $this->setValues($values);
        return $this;
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return Stack
     */
    public function reverse() : Stack
    {
        $values = $this->_reverse();
        $this->setValues($values);
        return $this;
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return Stack
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
     * @return Stack
     */
    public function replaceAll(array $from_to)
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
     * @return Stack
     */
    public function sort(callable $callback = null) : Stack
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
     * @return Stack
     */
    public function sortBy(string $field, callable $callback = null) : Stack
    {
        $values = $this->_sortBy($field, $callback);
        $this->setValues($values);
        return $this;
    }
}


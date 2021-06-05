<?php
declare(strict_types=1);

namespace stk2k\collection;

use stk2k\collection\Util\PhpArrayTrait;

class Queue extends Collection
{
    use PhpArrayTrait;

    /**
     * Take item from the queue
     *
     * @param mixed &$item
     *
     * @return Queue
     */
    public function dequeue(&$item) : Queue
    {
        $values = $this->_shift($item);
        $this->setValues($values);
        return $this;
    }

    /**
     * Add item to the queue
     *
     * @param mixed $items
     *
     * @return Queue
     */
    public function enqueue(... $items) : Queue
    {
        $values = $this->_pushAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return Queue
     */
    public function sort(callable $callback = null) : Queue
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
     * @return Queue
     */
    public function sortBy(string $field, callable $callback = null) : Queue
    {
        $values = $this->_sortBy($field, $callback);
        $this->setValues($values);
        return $this;
    }
}


<?php
declare(strict_types=1);

namespace stk2k\collection;

use stk2k\collection\Util\PhpArrayTrait;

class Set extends Collection
{
    use PhpArrayTrait;

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return Set
     */
    public function add(... $items) : Set
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
     * @return Set
     */
    public function addAll(array $items) : Set
    {
        $values = $this->_pushAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     * remove same element
     *
     * @param mixed $items
     *
     * @return Set
     */
    public function remove(... $items) : Set
    {
        $values = $this->_removeSameAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     * remove same element
     *
     * @param array $items
     *
     * @return Set
     */
    public function removeAll(array $items) : Set
    {
        $values = $this->_removeSameAll($items);
        $this->setValues($values);
        return $this;
    }

}
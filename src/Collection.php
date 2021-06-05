<?php
declare(strict_types=1);

namespace stk2k\collection;

use Countable;
use IteratorAggregate;
use Serializable;
use ArrayIterator;

use stk2k\collection\Util\PhpArrayTrait;

class Collection implements Countable, IteratorAggregate, Serializable
{
    use PhpArrayTrait;

    /** @var array */
    protected $values;
    
    /**
     * Collection constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * Get array values
     *
     * @return mixed
     */
    protected function getValues() : array
    {
        return $this->values;
    }

    /**
     * Set array values
     *
     * @param array $values
     */
    protected function setValues(array $values)
    {
        $this->values = $values;
    }

    /**
     * Serialize
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->getValues());
    }

    /**
     * Unserialize
     *
     * @param string $data
     */
    public function unserialize($data)
    {
        $this->setValues(unserialize($data));
    }

    /**
     * Returns number of items
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->getValues());
    }

    /**
     * Check if the collection is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return count($this->getValues()) === 0;
    }

    /**
     * check if contains a value
     *
     * @param mixed $items
     *
     * @return bool
     */
    public function contains(... $items) : bool
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            if (!in_array($item, $values, true))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * check if contains a value
     *
     * @param array|Collection $items
     *
     * @return bool
     */
    public function containsAll($items)
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            if (!in_array($item, $values, true))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * Remove all elements
     *
     * @return Collection
     */
    public function empty() : Collection
    {
        $this->setValues([]);
        return $this;
    }

    /**
     * IteratorAggregate interface: valid() implementation
     */
    public function getIterator()
    {
        return new ArrayIterator($this->getValues());
    }

    /**
     * Applies a callback to all elements and replace them
     *
     * @param callable $callback
     *
     * @return Collection
     */
    public function map($callback)
    {
        $values = $this->_map($callback);
        $this->setValues($values);
        return new Collection($values);
    }

    /**
     * Applies a callback to all elements
     *
     * @param callable $callback
     *
     * @return Collection
     */
    public function each($callback)
    {
        $this->_map($callback);
        return $this;
    }

    /**
     * Iteratively reduce the array to a single value using a callback function
     *
     * @param callable $callback
     * @param mixed $initial
     *
     * @return mixed
     */
    public function reduce($callback, $initial = null)
    {
        return $this->_reduce($callback, $initial);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return Collection
     */
    public function replace($from, $to)
    {
        $values = $this->_replace($from, $to);
        return new Collection($values);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     *
     * @return Collection
     */
    public function replaceAll(array $from_to)
    {
        $values = $this->_replaceAll($from_to);
        return new Collection($values);
    }

    /**
     * Join array elements with a string
     *
     * @param string $delimiter
     *
     * @return string
     */
    public function join(string $delimiter = ',') : string
    {
        return implode($delimiter, $this->getValues());
    }

    /**
     * convert to array
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->getValues();
    }
    /**
     *  String expression of this object
     *
     * @return string
     */
    public function __toString() : string
    {
        return get_class($this) . ' values:' . json_encode($this->values);
    }
}


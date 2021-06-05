<?php
declare(strict_types=1);

namespace stk2k\collection\Util;

trait PhpArrayTrait
{
    /**
     * Get array values
     *
     * @return mixed
     */
    abstract protected function getValues() : array;

    /**
     * Set array values
     *
     * @param array $values
     */
    abstract protected function setValues(array $values);

    /**
     * get list of keys
     */
    private function _keys() : array
    {
        return array_keys($this->getValues());
    }

    /**
     * get list of values
     */
    private function _values() : array
    {
        return array_values($this->getValues());
    }

    /**
     *  Get reverse index
     *
     * @param mixed $index
     * @param array $values
     *
     * @return int
     */
    private function _rindex($index, array $values) : int
    {
        if (is_int($index) && $index < 0){
            return count($values) + $index;
        }
        return $index;
    }

    /**
     *  Check if offset exists
     *
     * @param mixed $index
     * @param bool $accept_reverse_index
     *
     * @return bool
     */
    private function _isset($index, $accept_reverse_index) : bool
    {
        $values = $this->getValues();
        if ($accept_reverse_index){
            $index = $this->_rindex($index, $values);
        }
        return isset($values[$index]);
    }

    /**
     *  Check if offset exists
     *
     * @param mixed $index
     * @param bool $accept_reverse_index
     *
     * @return mixed
     */
    private function _unset($index, $accept_reverse_index) : array
    {
        $values = $this->getValues();
        if ($accept_reverse_index){
            $index = $this->_rindex($index, $values);
        }
        unset($values[$index]);
        return $values;
    }

    /**
     *  Get element value
     *
     * @param mixed $index
     * @param bool $accept_reverse_index
     *
     * @return mixed
     */
    private function _get($index, $accept_reverse_index)
    {
        $values = $this->getValues();
        if ($accept_reverse_index){
            $index = $this->_rindex($index, $values);
        }
        return $values[$index] ?? null;
    }

    /**
     *  Set element value
     *
     * @param mixed $index
     * @param mixed $value
     * @param bool $accept_reverse_index
     *
     * @return array
     */
    private function _set($index, $value, $accept_reverse_index) : array
    {
        $values = $this->getValues();
        if ($accept_reverse_index){
            $index = $this->_rindex($index, $values);
        }
        $values[$index] = $value;
        return $values;
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return array
     */
    private function _pushAll(array $items) : array
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            $values[] = $item;
        }
        return $values;
    }

    /**
     * Get head element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    private function _first(callable $callback = null)
    {
        $values = $this->getValues();
        if ($callback){
            foreach($values as $key => $value){
                if ($callback($value, $key)){
                    return $value;
                }
            }
        }
        else{
            return empty($values) ? null : $values[0];
        }
        return null;
    }

    /**
     * Get tail element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    private function _last(callable $callback = null)
    {
        $values = $this->getValues();
        if ($callback){
            foreach(array_reverse($values) as $key => $value){
                if ($callback($value, $key)){
                    return $value;
                }
            }
        }
        else{
            return empty($values) ? null : $values[count($values)-1];
        }
        return null;
    }

    /**
     * remove element by index
     *
     * @param int|Integer $start
     * @param int|Integer|null $length
     *
     * @return array
     */
    private function _remove(int $start, int $length = null) : array
    {
        $values = $this->getValues();
        if ($length){
            array_splice($values, $start, $length);
        }
        else{
            array_splice($values, $start);
        }
        return $values;
    }

    /**
     *  get item from tail
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    private function _pop(& $item) : array
    {
        $values = $this->getValues();
        if (empty($values)) {
            $item = null;
            return $values;
        }
        $item = array_pop($values);
        return $values;
    }

    /**
     *  get item from head
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    private function _shift(& $item) : array
    {
        $values = $this->getValues();
        if (empty($values)) {
            $item = null;
            return $values;
        }
        $item = array_shift($values);
        return $values;
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return array
     */
    public function _unshiftAll(array $items) : array
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            array_unshift($values, $item);
        }
        return $values;
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return array
     */
    private function _reverse() : array
    {
        return array_reverse($this->getValues());
    }

    /**
     * Applies a callback to all elements
     *
     * @param callable $callback
     *
     * @return array
     */
    private function _map(callable $callback) : array
    {
        return array_map($callback, $this->getValues());
    }

    /**
     * Iteratively reduce the array to a single value using a callback function
     *
     * @param callable $callback
     * @param mixed $initial
     *
     * @return mixed
     */
    private function _reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->getValues(), $callback, $initial);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return array
     */
    private function _replace($from, $to) : array
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            if ($value === $from)
            {
                $values[$key] = $to;
            }
        }
        return $values;
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     *
     * @return array
     */
    private function _replaceAll(array $from_to) : array
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            if (isset($from_to[$value]))
            {
                $values[$key] = $from_to[$value];
            }
        }
        return $values;
    }

    /**
     * remove same element
     *
     * @param array $items
     *
     * @return array
     */
    private function _removeSameAll(array $items) : array
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            foreach($items as $item)
            {
                if ($item === $value)
                {
                    unset($values[$key]);
                }
            }
        }
        $values = array_values($values);
        return $values;
    }

    /**
     * Merge with array data
     *
     * @param array $data
     *
     * @return array
     */
    private function _merge(array $data) : array
    {
        $values = $this->getValues();
        $values = array_merge($values, $data);
        return $values;
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return array
     */
    private function _sort(callable $callback = null) : array
    {
        $values = $this->getValues();
        if ($callback){
            usort($values, $callback);
        }
        else{
            sort($values);
        }
        return $values;
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable|null $callback
     *
     * @return array
     */
    private function _sortBy(string $field, callable $callback = null) : array
    {
        $values = $this->getValues();
        if (!$callback){
            $callback = 'strnatcmp';
        }
        usort($values, function($a, $b) use($callback, $field){
            if (is_array($a) && is_array($b) && isset($a[$field]) && isset($b[$field])){
                return $callback((string)$a[$field], (string)$b[$field]);
            }
            if (is_object($a) && is_object($b) && property_exists($a, $field) && property_exists($b, $field)){
                return $callback($a->$field, $b->$field);
            }
            return 0;
        });
        return $values;
    }

    /**
     *  Find index of element
     *
     * @param mixed $target
     * @param int|NULL $start
     *
     * @return bool|int
     */
    private function _indexOf($target, int $start = NULL )
    {
        $values = $this->getValues();
        if ( $start === NULL ){
            $start = 0;
        }
        $size = count($values);
        for( $i=$start; $i < $size; $i++ ){
            $item = $values[$i];
            if ($item instanceof EqualableInterface){
                if ( $item->equals($target) ){
                    return $i;
                }
            }
            else if ($item === $target){
                return $i;
            }
        }

        return FALSE;
    }

}
<?php
declare(strict_types=1);

namespace stk2k\collection;

class Property extends Collection
{
    /**
     * Get as raw value
     *
     * @param string $key             key string for hash map
     *
     * @return mixed
     */
    public function get( string $key )
    {
        return $this->getPropertyNodeValue( $key );
    }

    /**
     * Get as string value
     *
     * @param string $key             key string for hash map
     * @param string $default_value   default value
     *
     * @return string|NULL
     */
    public function getString( string $key, string $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return strval($value);
    }

    /**
     * Get as list value
     *
     * @param string $key
     * @param array $default_value
     *
     * @return ArrayList|NULL
     */
    public  function getList( $key, array $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new ArrayList($default_value);
        }

        return new ArrayList($value);
    }

    /**
     * Get as associative array value
     *
     * @param string $key
     * @param array $default_value
     *
     * @return HashMap|NULL
     */
    public  function getHashMap($key, array $default_value = NULL)
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new HashMap($default_value);
        }

        return new HashMap($value);
    }

    /**
     * Get as int value
     *
     * @param string $key
     * @param int $default_value
     *
     * @return int|NULL
     */
    public  function getInteger( $key, int $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue($key);

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return intval($value);
    }

    /**
     * Get as float value
     *
     * @param string $key             key string for hash map
     * @param float $default_value   default value
     *
     * @return float|NULL
     */
    public  function getFloat($key, float $default_value = NULL)
    {
        $value = $this->getPropertyNodeValue($key);

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return floatval($value);
    }

    /**
     * Get as bool value
     *
     * @param string $key             key string for hash map
     * @param bool $default_value   default value
     *
     * @return bool|NULL
     */
    public  function getBoolean( $key, bool $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return boolval($value);
    }

    /**
     * Get property node
     *
     * @param string $key
     *
     * @return mixed
     */
    private function getPropertyNodeValue(string $key)
    {
        $data = $this->toArray();
        if (strpos($key,'/')===false){
            return $data[$key] ?? NULL;
        }
        $node_keys = explode('/', $key);
        $node = $data;
        while(($node_key = array_shift($node_keys)) && (count($node_keys) > 0)){
            if (!isset($node[$node_key])){
                return NULL;
            }
            $node = $node[$node_key];
        }
        return $node[$node_key] ?? NULL;
    }
}
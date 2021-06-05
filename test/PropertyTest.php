<?php
declare(strict_types=1);

namespace stk2k\collection\test;

use ReflectionMethod;

use PHPUnit\Framework\TestCase;

use stk2k\collection\Property;

class PropertyTest extends TestCase
{
    /**
     * @throws
     */
    public function testGetPropertyNodeValue()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                        'g' => 4
                    ]
                ]
            ]
        ]);

        $method = new ReflectionMethod($property, 'getPropertyNodeValue');
        $method->setAccessible(true);
        $value = $method->invokeArgs($property, ['b/d/f/g']);
        $this->assertSame( 4, $value );

        $method = new ReflectionMethod($property, 'getPropertyNodeValue');
        $method->setAccessible(true);
        $value = $method->invokeArgs($property, ['b/x']);
        $this->assertNull( $value );

        $method = new ReflectionMethod($property, 'getPropertyNodeValue');
        $method->setAccessible(true);
        $value = $method->invokeArgs($property, ['x']);
        $this->assertNull( $value );
    }
    
    public function testGetIntegerHierarchy()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                        'g' => 4
                    ]
                ]
            ]
        ]);
        
        $this->assertSame( 1, $property->getInteger('a') );
        $this->assertSame( 2, $property->getInteger('b/c') );
        $this->assertSame( 3, $property->getInteger('b/d/e') );
        $this->assertSame( 4, $property->getInteger('b/d/f/g') );
    }
}
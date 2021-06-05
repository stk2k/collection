<?php
declare(strict_types=1);

namespace stk2k\collection\test;

use Iterator;

use PHPUnit\Framework\TestCase;
use stk2k\collection\Collection;

class CollectionTest extends TestCase
{
    public function testIsEmpty()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertSame( false, $collection->isEmpty() );

        $collection = new Collection([]);
        $this->assertSame( true, $collection->isEmpty() );
    }
    public function testSerializeUnserialize()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);

        $data = $collection->serialize();
        $this->assertSame( 'a:3:{i:0;s:5:"apple";i:1;s:6:"banana";i:2;s:4:"kiwi";}', $data );

        $collection->unserialize($data);
        $this->assertSame( ['apple', 'banana', 'kiwi'], $collection->toArray() );
    }
    public function testCount()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertSame( 3, $collection->count() );

        $collection = new Collection([]);
        $this->assertSame( 0, $collection->count() );
    }
    public function testContains()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertSame( false, $collection->contains(0) );
        $this->assertSame( true, $collection->contains(1) );
        $this->assertSame( false, $collection->contains(null) );

        $collection = new Collection([1, false, 3.4, 1, true]);
        $this->assertSame( false, $collection->contains(0) );
        $this->assertSame( true, $collection->contains(3.4) );
        $this->assertSame( true, $collection->contains(1) );
        $this->assertSame( true, $collection->contains(3.4, 1) );
        $this->assertSame( false, $collection->contains(3.4, 1, 0) );
        $this->assertSame( true, $collection->contains(3.4, 1, true) );
    }
    public function testContainsAll()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertSame( false, $collection->containsAll([0]) );
        $this->assertSame( true, $collection->containsAll([1]) );
        $this->assertSame( false, $collection->containsAll([null]) );

        $collection = new Collection([1, false, 3.4, 1, true]);
        $this->assertSame( false, $collection->containsAll([0]) );
        $this->assertSame( true, $collection->containsAll([3.4]) );
        $this->assertSame( true, $collection->containsAll([1]) );
        $this->assertSame( true, $collection->containsAll([3.4, 1]) );
        $this->assertSame( false, $collection->containsAll([3.4, 1, 0]) );
        $this->assertSame( true, $collection->containsAll([3.4, 1, true]) );
        $this->assertSame( true, $collection->containsAll(new Collection([3.4, 1, true])) );
    }
    public function testClear()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertSame( [1, 2, 3], $collection->toArray() );
        $ret = $collection->empty();
        $this->assertSame( [], $collection->toArray() );
        $this->assertSame( [], $ret->toArray() );
    }
    public function testGetIterator()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertInstanceOf(Iterator::class, $collection->getIterator() );
    }
    public function testMap()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return $item . ' fruits';
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame(['apple fruits', 'banana fruits', 'kiwi fruits'], $collection->toArray());

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return strlen($item);
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame([5, 6, 4], $collection->toArray());
    }
    public function testEach()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->each(function ($item){
            return $item . ' fruits';
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->each(function ($item){
            return strlen($item);
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());
    }
    public function testReduce()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $result = $collection->reduce(function ($carry, $item){
            return $carry . '/' . $item;
        });
        $this->assertSame('/apple/banana/kiwi', $result);

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $result = $collection->reduce(function ($carry, $item){
            return $carry + strlen($item);
        });
        $this->assertSame(15, $result);
    }
    public function testReplace()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $ret = $collection->replace('apple', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Collection::class, $ret);

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $ret = $collection->replace('banana', 'orange');
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Collection::class, $ret);
    }
    public function testReplaceAll()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $replace = ['apple' => 'mango', 'banana' => 'orange'];
        $ret = $collection->replaceAll($replace);
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
        $this->assertSame(['mango', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Collection::class, $ret);
    }
    public function testJoin()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple,banana,kiwi', $collection->join());
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple or banana or kiwi', $collection->join(' or '));
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
    }
    public function testToArray()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
    }
    public function testToString()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertSame('stk2k\Collection\Collection values:["apple","banana","kiwi"]', $collection->__toString());
        $this->assertSame(['apple', 'banana', 'kiwi'], $collection->toArray());     // immutable
    }
    
}
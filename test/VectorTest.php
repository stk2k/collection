<?php
declare(strict_types=1);

namespace stk2k\collection\test;

use PHPUnit\Framework\TestCase;
use stk2k\collection\Vector;

class VectorTest extends TestCase
{
    public function testGet()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $this->assertSame('banana', $vec->get(1));
        $this->assertSame(null, $vec->get(3));
        $this->assertSame('kiwi', $vec->get(-1));
        $this->assertSame('banana', $vec->get(-2));
        $this->assertSame(null, $vec->get(-4));
    }
    public function testSet()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $ret = $vec->set(0, 'mango');
        $this->assertSame(['mango', 'banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $ret = $vec->set(1, 'orange');
        $this->assertSame(['apple', 'orange', 'kiwi'], $vec->toArray());
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testOffsetGet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertSame(1, $vec[0]);
        $this->assertSame(2, $vec[1]);
        $this->assertSame(3, $vec[2]);
        $this->assertSame(null, $vec[3]);
    }
    public function testOffsetSet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertSame(2, $vec[1]);
        $vec[1] = 22;
        $this->assertSame(22, $vec[1]);
    }
    public function testOffsetExists()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertTrue(isset($vec[0]));
        $this->assertTrue(isset($vec[1]));
        $this->assertFalse(isset($vec[3]));
    }
    public function testOffsetUnset()
    {
        $vec = new Vector([1, 2, 3]);
        unset($vec[0]);
        $this->assertSame([1 => 2, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[1]);
        $this->assertSame([0 => 1, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[2]);
        $this->assertSame([0 => 1, 1 => 2], $vec->toArray());
    }
    public function testPush()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->push('orange');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $vec->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->push('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $vec->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testPushAll()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->pushAll(['orange']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $vec->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->pushAll(['orange', 'mango']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $vec->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testPop()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->pop($item);
        $this->assertSame(['apple', 'banana'], $vec->toArray());
        $this->assertSame(['apple', 'banana'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('kiwi', $item);

        $ret = $vec->pop($item);
        $this->assertSame(['apple'], $vec->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('banana', $item);

        $ret = $vec->pop($item);
        $this->assertSame([], $vec->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('apple', $item);

        $ret = $vec->pop($item);
        $this->assertSame([], $vec->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame(null, $item);
    }
    public function testFirst()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->first());
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());   // immutable

        $vec = new Vector([1, 2, 3, 4, 5]);
        $this->assertSame(2, $vec->first(function($v){ return $v%2==0; }));
        $this->assertSame([1, 2, 3, 4, 5], $vec->toArray());   // immutable
    }
    public function testLast()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('kiwi', $vec->last());
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());   // immutable

        $vec = new Vector([1, 2, 3, 4, 5]);
        $this->assertSame(4, $vec->last(function($v){ return $v%2==0; }));
        $this->assertSame([1, 2, 3, 4, 5], $vec->toArray());   // immutable
    }
    public function testRemove()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->remove(1,1);
        $this->assertSame(['apple', 'kiwi'], $vec->toArray());
        $this->assertSame(['apple', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->remove(1);
        $this->assertSame(['apple'], $vec->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->remove(-2,2);
        $this->assertSame(['apple'], $vec->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testShift()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->shift($item);
        $this->assertSame(['banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('apple', $item);

        $ret = $vec->shift($item);
        $this->assertSame(['kiwi'], $vec->toArray());
        $this->assertSame(['kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('banana', $item);

        $ret = $vec->shift($item);
        $this->assertSame([], $vec->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame('kiwi', $item);

        $ret = $vec->shift($item);
        $this->assertSame([], $vec->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
        $this->assertSame(null, $item);
    }
    public function testUnshift()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->unshift('mango');
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->unshift('mango', 'orange');
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testUnshiftAll()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->unshiftAll(['mango']);
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->unshiftAll(['mango', 'orange']);
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $vec->toArray());
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testReverse()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->reverse();
        $this->assertSame(['kiwi', 'banana', 'apple'], $vec->toArray());
        $this->assertSame(['kiwi', 'banana', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testMap()
    {
        $collection = new Vector(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return $item . ' fruits';
        });
        $this->assertInstanceOf(Vector::class, $collection);
        $this->assertSame(['apple fruits', 'banana fruits', 'kiwi fruits'], $collection->toArray());

        $collection = new Vector(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return strlen($item);
        });
        $this->assertInstanceOf(Vector::class, $collection);
        $this->assertSame([5, 6, 4], $collection->toArray());
    }
    public function testReplace()
    {
        $collection = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $collection->replace('apple', 'mango');
        $this->assertSame(['mango', 'banana', 'kiwi'], $collection->toArray());
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $collection = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $collection->replace('banana', 'orange');
        $this->assertSame(['apple', 'orange', 'kiwi'], $collection->toArray());
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testReplaceAll()
    {
        $collection = new Vector(['apple', 'banana', 'kiwi']);
        $replace = ['apple' => 'mango', 'banana' => 'orange'];
        $ret = $collection->replaceAll($replace);
        $this->assertSame(['mango', 'orange', 'kiwi'], $collection->toArray());
        $this->assertSame(['mango', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testMerge()
    {
        $vec = new Vector([1, 2, 3]);

        $ret = $vec->merge([4, 5]);

        $this->assertSame([1, 2, 3, 4, 5], $vec->toArray());
        $this->assertSame([1, 2, 3, 4, 5], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testSort()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());    // immutable
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $vec->sort();
        if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
            $this->assertSame([-1, 0, 1.2, 3, 4, 12, 'apple', 'kiwi'], $vec->toArray());
            $this->assertSame([-1, 0, 1.2, 3, 4, 12, 'apple', 'kiwi'], $ret->toArray());
        }
        else{
            $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $vec->toArray());
            $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        }
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $vec->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $vec->toArray());
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testSortBy()
    {
        $vec = new Vector([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $vec->sortBy('name');
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $vec->toArray());
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $ret = $vec->sortBy('age');
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $vec->toArray());
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $ret = $vec->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $vec->toArray());
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
}
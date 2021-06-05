<?php
declare(strict_types=1);

namespace stk2k\collection\test;

use PHPUnit\Framework\TestCase;
use stk2k\collection\ArrayList;

class ArrayListTest extends TestCase
{
    public function testPush()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->push('orange');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->push('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testPushAll()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->pushAll(['orange']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->pushAll(['orange', 'mango']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testPop()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->pop($item);
        $this->assertSame(['apple', 'banana'], $list->toArray());
        $this->assertSame(['apple', 'banana'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('kiwi', $item);

        $ret = $list->pop($item);
        $this->assertSame(['apple'], $list->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('banana', $item);

        $ret = $list->pop($item);
        $this->assertSame([], $list->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('apple', $item);

        $ret = $list->pop($item);
        $this->assertSame([], $list->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame(null, $item);
    }
    public function testFirst()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $list->first());
        $this->assertSame(['apple', 'banana', 'kiwi'], $list->toArray());   // immutable

        $list = new ArrayList([1, 2, 3, 4, 5]);
        $this->assertSame(2, $list->first(function($v){ return $v%2==0; }));
        $this->assertSame([1, 2, 3, 4, 5], $list->toArray());   // immutable
    }
    public function testLast()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $this->assertSame('kiwi', $list->last());
        $this->assertSame(['apple', 'banana', 'kiwi'], $list->toArray());   // immutable

        $list = new ArrayList([1, 2, 3, 4, 5]);
        $this->assertSame(4, $list->last(function($v){ return $v%2==0; }));
        $this->assertSame([1, 2, 3, 4, 5], $list->toArray());   // immutable
    }
    public function testRemove()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->remove(1,1);
        $this->assertSame(['apple', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->remove(1);
        $this->assertSame(['apple'], $list->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->remove(-2,2);
        $this->assertSame(['apple'], $list->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testShift()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->shift($item);
        $this->assertSame(['banana', 'kiwi'], $list->toArray());
        $this->assertSame(['banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('apple', $item);

        $ret = $list->shift($item);
        $this->assertSame(['kiwi'], $list->toArray());
        $this->assertSame(['kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('banana', $item);

        $ret = $list->shift($item);
        $this->assertSame([], $list->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame('kiwi', $item);

        $ret = $list->shift($item);
        $this->assertSame([], $list->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
        $this->assertSame(null, $item);
    }
    public function testUnshift()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->unshift('mango');
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->unshift('mango', 'orange');
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testUnshiftAll()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->unshiftAll(['mango']);
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->unshiftAll(['mango', 'orange']);
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['orange', 'mango', 'apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testReverse()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->reverse();
        $this->assertSame(['kiwi', 'banana', 'apple'], $list->toArray());
        $this->assertSame(['kiwi', 'banana', 'apple'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testMap()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->map(function ($item){
            return $item . ' fruits';
        });
        $this->assertSame(['apple fruits', 'banana fruits', 'kiwi fruits'], $list->toArray());
        $this->assertSame(['apple fruits', 'banana fruits', 'kiwi fruits'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->map(function ($item){
            return strlen($item);
        });
        $this->assertSame([5, 6, 4], $list->toArray());
        $this->assertSame([5, 6, 4], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testReplace()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->replace('apple', 'mango');
        $this->assertSame(['mango', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->replace('banana', 'orange');
        $this->assertInstanceOf(ArrayList::class, $list->replace('banana', 'orange'));
        $this->assertSame(['apple', 'orange', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testReplaceAll()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $replace = ['apple' => 'mango', 'banana' => 'orange'];
        $ret = $list->replaceAll($replace);
        $this->assertSame(['mango', 'orange', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testSort()
    {
        $list = new ArrayList(['apple', 'kiwi', 'banana']);
        $ret = $list->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort();
        print_r($list->toArray());
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $list->toArray());
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $list = new ArrayList([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $list->toArray());
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
    public function testSortBy()
    {
        $list = new ArrayList([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $list->sortBy('name');
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $list->toArray());
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $ret = $list->sortBy('age');
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $list->toArray());
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);

        $ret = $list->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $list->toArray());
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(ArrayList::class, $ret);
    }
}
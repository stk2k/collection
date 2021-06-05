<?php
declare(strict_types=1);

namespace stk2k\collection\test;

use PHPUnit\Framework\TestCase;
use stk2k\collection\Stack;

class StackTest extends TestCase
{
    public function testPush()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->push('orange');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $stack->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->push('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $stack->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testPop()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->pop($item);
        $this->assertSame(['apple', 'banana'], $stack->toArray());
        $this->assertSame(['apple', 'banana'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
        $this->assertSame('kiwi', $item);

        $ret = $stack->pop($item);
        $this->assertSame(['apple'], $stack->toArray());
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
        $this->assertSame('banana', $item);

        $ret = $stack->pop($item);
        $this->assertSame([], $stack->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
        $this->assertSame('apple', $item);

        $ret = $stack->pop($item);
        $this->assertSame([], $stack->toArray());
        $this->assertSame([], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
        $this->assertSame(null, $item);
    }
    public function testPeek()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->peek();
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());
        $this->assertSame('kiwi', $ret);
    }
    public function testReverse()
    {
        $list = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $list->reverse();
        $this->assertSame(['kiwi', 'banana', 'apple'], $list->toArray());
        $this->assertSame(['kiwi', 'banana', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testReplace()
    {
        $list = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $list->replace('apple', 'mango');
        $this->assertSame(['mango', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $list = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $list->replace('banana', 'orange');
        $this->assertInstanceOf(Stack::class, $list->replace('banana', 'orange'));
        $this->assertSame(['apple', 'orange', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testReplaceAll()
    {
        $list = new Stack(['apple', 'banana', 'kiwi']);
        $replace = ['apple' => 'mango', 'banana' => 'orange'];
        $ret = $list->replaceAll($replace);
        $this->assertSame(['mango', 'orange', 'kiwi'], $list->toArray());
        $this->assertSame(['mango', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testSort()
    {
        $list = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $list->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $list = new Stack([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort();
        if (version_compare(PHP_VERSION, '8.0.0') >= 0) {
            $this->assertSame([-1, 0, 1.2, 3, 4, 12, 'apple', 'kiwi'], $list->toArray());
            $this->assertSame([-1, 0, 1.2, 3, 4, 12, 'apple', 'kiwi'], $ret->toArray());
        }
        else{
            $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $list->toArray());
            $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        }
        $this->assertInstanceOf(Stack::class, $ret);

        $list = new Stack([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $list->toArray());
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testSortBy()
    {
        $list = new Stack([
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
        $this->assertInstanceOf(Stack::class, $ret);

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
        $this->assertInstanceOf(Stack::class, $ret);

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
        $this->assertInstanceOf(Stack::class, $ret);
    }
}
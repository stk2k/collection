<?php
use PHPUnit\Framework\TestCase;
use Stk2k\Collection\Set;

class SetTest extends TestCase
{
    public function testAdd()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->add('orange');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $set->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->add('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $set->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);
    }
    public function testAddAll()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->addAll(['orange']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $set->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->addAll(['orange', 'mango']);
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $set->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);
    }
    public function testRemove()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->remove('banana');
        $this->assertSame(['apple', 'kiwi'], $set->toArray());
        $this->assertSame(['apple', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set(['apple', 'banana', 'kiwi']);
        $ret = $set->remove('kiwi', 'apple');
        $this->assertSame(['banana'], $set->toArray());
        $this->assertSame(['banana'], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set([1, false, 3.4, 1, true]);
        $ret = $set->remove(1);
        $this->assertSame([false, 3.4, true], $set->toArray());
        $this->assertSame([false, 3.4, true], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set([1, false, 3.4, 1, true]);
        $ret = $set->remove(false);
        $this->assertSame([1, 3.4, 1, true], $set->toArray());
        $this->assertSame([1, 3.4, 1, true], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);

        $set = new Set([1, false, 3.4, 1, true]);
        $ret = $set->remove(3.4);
        $this->assertSame([1, false, 1, true], $set->toArray());
        $this->assertSame([1, false, 1, true], $ret->toArray());
        $this->assertInstanceOf(Set::class, $ret);
    }
}
<?php
use PHPUnit\Framework\TestCase;
use Stk2k\Collection\Queue;

class QueueTest extends TestCase
{
    public function testDequeue()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->dequeue($item);
        $this->assertSame(['banana', 'kiwi'], $queue->toArray());
        $this->assertSame(['banana', 'kiwi'], $ret->toArray());
        $this->assertSame('apple', $item);
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $ret->dequeue($item);
        $this->assertSame(['kiwi'], $queue->toArray());
        $this->assertSame(['kiwi'], $ret->toArray());
        $this->assertSame('banana', $item);
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testEnqueue()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->enqueue('orange');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $queue->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->enqueue('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $queue->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testSort()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $queue->sort();
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $queue->toArray());
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $queue->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $queue->toArray());
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testSortBy()
    {
        $queue = new Queue([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $queue->sortBy('name');
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $queue->toArray());
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $queue->sortBy('age');
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $queue->toArray());
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $queue->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $queue->toArray());
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
}
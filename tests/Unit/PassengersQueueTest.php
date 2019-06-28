<?php

namespace Tests\Unit;

use App\Elevator\Passengers;
use App\Elevator\PassengersQueue;
use Tests\TestCase;

class PassengersQueueTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPushToQueue()
    {
        $queue = new PassengersQueue();
        $this->assertTrue($queue->empty());
        $this->assertTrue($queue->size() === 0);
        $queue->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 4));
        $this->assertFalse($queue->empty());
        $this->assertTrue($queue->size() === 1);
        $queue->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 3))
            ->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 2));
        $this->assertFalse($queue->empty());
        $this->assertTrue($queue->size() === 3);
    }

    public function testPopFromQueue() {
        $queue = new PassengersQueue();
        $this->assertTrue($queue->empty());
        $this->assertTrue($queue->size() === 0);
        $queue->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 4))
            ->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 3))
            ->push(new Passengers(1, Passengers::WHERE_TO_GO[0], 2));
        $this->assertFalse($queue->empty());
        $this->assertTrue($queue->size() === 3);
        $this->assertTrue($queue->pop() instanceof Passengers);
        $this->assertTrue($queue->size() === 2);
        $queue->pop();
        $queue->pop();
        $this->assertNull($queue->pop());
        $this->assertTrue($queue->empty());
        $this->assertTrue($queue->size() === 0);
    }
}

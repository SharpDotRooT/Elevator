<?php
/**
 * Created by PhpStorm.
 * User: Sharp
 * Date: 28.06.2019
 * Time: 13:00
 */

namespace App\Elevator;


use App\Interfaces\Elevator\Queue;

/**
 * Class PassengersQueue
 *
 * @package App\Elevator
 */
class PassengersQueue implements Queue {

    /**
     * @var array
     */
    private $queue = [];

    /**
     * @return \App\Elevator\Passengers|null
     */
    public function pop(): ?Passengers {
        return array_shift($this->queue);
    }

    /**
     * PassengersQueue constructor.
     *
     * @param \App\Elevator\Passengers[] $queue
     */
    public function __construct(array $queue = []) {
        foreach ($queue as $item) {
            $this->push($item);
        }
    }

    /**
     * @return bool
     */
    public function empty(): bool {
        return empty($this->queue);
    }

    /**
     * @return int
     */
    public function size(): int {
        return count($this->queue);
    }

    /**
     * @param \App\Elevator\Passengers $element
     *
     * @return \App\Interfaces\Elevator\Queue
     */
    public function push($element): Queue {
        array_push($this->queue, $element);
        return $this;
    }
}

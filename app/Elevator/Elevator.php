<?php
/**
 * Created by PhpStorm.
 * User: Sharp
 * Date: 28.06.2019
 * Time: 11:59
 */

namespace App\Elevator;

use App\Interfaces\Elevator\Queue;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Elevator
 *
 * @package App\Elevator
 */
class Elevator {

    /**
     *
     */
    const UP = 'up';

    /**
     *
     */
    const DOWN = 'down';

    /**
     * @var \Symfony\Component\Console\Output\OutputInterface $output
     */
    private $output;

    /**
     * @var int $current_floor
     */
    private $current_floor = 1;

    /**
     * @var int $needed_floor
     */
    private $needed_floor;

    /**
     * @var array $needed_floors
     */
    private $needed_floors = [];

    /**
     * @var \App\Elevator\Passengers[] $moveUp
     */
    private $moveUp = [];

    /**
     * @var \App\Elevator\Passengers[] $moveDown
     */
    private $moveDown = [];

    /**
     * Elevator constructor.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function __construct(OutputInterface $output) {
        $this->output = $output;
    }

    /**
     * @param int $delay
     */
    private function sleep(int $delay) {
        if (config('app.building.elevator.simulate', false)) {
            sleep($delay);
        }
    }

    /**
     * @param \App\Interfaces\Elevator\Queue $queue
     */
    public function processQueue(Queue $queue) {
        if (!$queue->empty()) {
            $first = $queue->pop();
            while ($passenger = $queue->pop()) {
                if ($passenger->getNeededFloor() > $passenger->getFloor()) {
                    $this->moveUp[$passenger->getFloor()] = $passenger;
                } else {
                    $this->moveDown[$passenger->getFloor()] = $passenger;
                }
            }
            $this->move($first->getFloor(), $first->getNeededFloor());
            $this->processQueue($queue);
        } else if (!empty($this->moveUp)) {
            ksort($this->moveUp, SORT_NUMERIC);
            $first = current($this->moveUp);
            unset($this->moveUp[key($this->moveUp)]);
            $this->move($first->getFloor(), $first->getNeededFloor());
            $this->processQueue($queue);
        } else if (!empty($this->moveDown)) {
            krsort($this->moveDown, SORT_NUMERIC);
            $first = current($this->moveDown);
            unset($this->moveDown[key($this->moveDown)]);
            $this->move($first->getFloor(), $first->getNeededFloor());
            $this->processQueue($queue);
        } else {
            $this->output->writeln('Elevator stopped.');
        }
    }

    /**
     * @param int      $floor
     * @param int|null $neededFloor
     */
    private function move(int $floor, int $neededFloor = null) {
        if ($neededFloor) {
            $this->needed_floor = $neededFloor;
            $this->output->writeln("Elevator received a call from the floor: $floor to floor $neededFloor.");
        }
        if ($floor === $this->current_floor) {
            $this->turnDoor($this->needed_floor);
            $this->move($this->needed_floor);
        } else {
            if ($floor > $this->current_floor) {
                $this->up($floor);
            } else {
                $this->down($floor);
            }
        }
    }

    /**
     *
     */
    private function open() {
        $this->sleep(config('app.building.elevator.open', 1));
        $this->output->writeln("Elevator opened doors on floor {$this->current_floor}.");
    }

    /**
     *
     */
    private function close() {
        $this->sleep(config('app.building.elevator.close', 1));
        $this->output->writeln("Elevator closed the doors on floor {$this->current_floor}.");
    }

    /**
     * @param $neededFloor
     */
    private function turnDoor($neededFloor) {
        $this->open();
        $this->needed_floors[$neededFloor] = true;
        $this->sleep(0.5);
        $this->output->writeln("The elevator took command to move to floor $neededFloor.");
        $this->close();
    }

    /**
     *
     */
    private function passengerLeft() {
        $this->open();
        $this->output->writeln("The passenger left the elevator on floor {$this->current_floor}");
        $this->close();
    }

    /**
     * @param $floor
     */
    private function up($floor) {
        $this->current_floor++;
        $this->sleep(config('app.building.floor_height', 4) * config('app.building.elevator.speed', 1));
        if (isset($this->moveUp[$this->current_floor])) {
            $passenger = $this->moveUp[$this->current_floor];
            unset($this->moveUp[$this->current_floor]);
            $this->turnDoor($passenger->getNeededFloor());
            if ($passenger->getNeededFloor() > $this->needed_floor) {
                $this->needed_floor = $passenger->getNeededFloor();
            }
        }
        if (isset($this->needed_floors[$this->current_floor])) {
            unset($this->needed_floors[$this->current_floor]);
            $this->passengerLeft();
        }
        if ($this->needed_floor != $this->current_floor) {
            $this->up($floor);
        }
    }

    /**
     * @param $floor
     */
    private function down($floor) {
        $this->current_floor--;
        $this->sleep(config('app.building.floor_height', 4) * config('app.building.elevator.speed', 1));
        if (isset($this->moveDown[$this->current_floor])) {
            $passenger = $this->moveDown[$this->current_floor];
            unset($this->moveDown[$this->current_floor]);
            $this->turnDoor($passenger->getNeededFloor());
            if ($passenger->getNeededFloor() < $this->needed_floor) {
                $this->needed_floor = $passenger->getNeededFloor();
            }
        }
        if (isset($this->needed_floors[$this->current_floor])) {
            unset($this->needed_floors[$this->current_floor]);
            $this->passengerLeft();
        }
        if ($this->needed_floor != $this->current_floor) {
            $this->down($floor);
        }
    }
}

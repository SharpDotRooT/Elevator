<?php
/**
 * Created by PhpStorm.
 * User: Sharp
 * Date: 28.06.2019
 * Time: 13:11
 */

namespace App\Elevator;


/**
 * Class Passengers
 *
 * @package App\Elevator
 */
class Passengers {

    /**
     * @var string $move
     */
    private $move;

    /**
     * @var int $floor
     */
    private $floor;

    /**
     * @var int $needed_floor
     */
    private $needed_floor;

    /**
     * Passengers constructor.
     *
     * @param int    $floor
     * @param string $move
     * @param int    $needed_floor
     */
    public function __construct(int $floor, string $move, int $needed_floor) {
        $this->floor = $floor;
        $this->move = $move;
        $this->needed_floor = $needed_floor;
    }

    /**
     * @return string
     */
    public function getMove(): string {
        return $this->move;
    }

    /**
     * @return int
     */
    public function getFloor(): int {
        return $this->floor;
    }

    /**
     * @return int
     */
    public function getNeededFloor(): int {
        return $this->needed_floor;
    }
}

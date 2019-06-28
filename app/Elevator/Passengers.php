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
     *
     */
    const WHERE_TO_GO = ['up', 'down'];

    /**
     * @var string $go
     */
    private $go;

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
     * @param string $go
     * @param int    $needed_floor
     */
    public function __construct(int $floor, string $go, int $needed_floor) {
        $this->floor = $floor;
        $this->go = $go;
        $this->needed_floor = $needed_floor;
    }

    /**
     * @return string
     */
    public function getGo(): string {
        return $this->go;
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

<?php
/**
 * Created by PhpStorm.
 * User: Sharp
 * Date: 28.06.2019
 * Time: 13:10
 */

namespace App\Interfaces\Elevator;


use App\Elevator\Passengers;

/**
 * Interface Queue
 *
 * @package App\Interfaces\Elevator
 */
interface Queue extends \App\Interfaces\Queue {

    /**
     * @param $element
     *
     * @return \App\Interfaces\Elevator\Queue
     */
    public function push($element): Queue;

    /**
     * @return \App\Elevator\Passengers|null
     */
    public function pop(): ?Passengers;

}

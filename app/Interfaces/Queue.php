<?php
/**
 * Created by PhpStorm.
 * User: Sharp
 * Date: 28.06.2019
 * Time: 13:05
 */

namespace App\Interfaces;


/**
 * Interface Queue
 *
 * @package App\Interfaces
 */
interface Queue {

    /**
     * Queue constructor.
     *
     * @param array $queue
     */
    public function __construct(array $queue = []);

    /**
     * @param $element
     *
     * @return mixed
     */
    public function push($element);

    /**
     * @return mixed
     */
    public function pop();

    /**
     * @return bool
     */
    public function empty(): bool;

    /**
     * @return int
     */
    public function size(): int;

}

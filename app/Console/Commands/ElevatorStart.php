<?php

namespace App\Console\Commands;

use App\Elevator\Elevator;
use App\Elevator\Passengers;
use App\Elevator\PassengersQueue;
use Illuminate\Console\Command;

class ElevatorStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elevator:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start elevator.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        if ($this->confirm('Start elevator?')) {
            $this->line('Elevator started.');
            $elevator = new Elevator($this->output);
            $elevator->processQueue($this->queue());
        }
    }

    /**
     * @return \App\Elevator\PassengersQueue
     */
    private function queue(): PassengersQueue {
        $passengers = new PassengersQueue();
        $passengers->push(new Passengers(1, Elevator::UP, 4))
            ->push(new Passengers(3, Elevator::DOWN, 2))
            ->push(new Passengers(4, Elevator::DOWN, 1));
        return $passengers;
    }
}

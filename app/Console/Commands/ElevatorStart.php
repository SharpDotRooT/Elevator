<?php

namespace App\Console\Commands;

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
        }
    }
}

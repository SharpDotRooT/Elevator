<?php

namespace Tests\Unit;

use Tests\TestCase;

class ElevatorStartConsoleCommandTest extends TestCase
{
    /**
     * Unit test for confirm ask "Start elevator?".
     *
     * @return void
     */
    public function testConfirmElevatorStart() {
        $this->artisan('elevator:start')
            ->expectsQuestion('Start elevator?', 'yes')
            ->expectsOutput('Elevator started.')
            ->expectsOutput('Elevator received a call from the floor: 1 to floor 4.')
            ->expectsOutput('Elevator opened doors on floor 1.')
            ->expectsOutput('The elevator took command to move to floor 4.')
            ->expectsOutput('Elevator closed the doors on floor 1.')
            ->expectsOutput('Elevator opened doors on floor 4.')
            ->expectsOutput('The passenger left the elevator on floor 4')
            ->expectsOutput('Elevator closed the doors on floor 4.')
            ->expectsOutput('Elevator received a call from the floor: 4 to floor 1.')
            ->expectsOutput('Elevator opened doors on floor 4.')
            ->expectsOutput('The elevator took command to move to floor 1.')
            ->expectsOutput('Elevator closed the doors on floor 4.')
            ->expectsOutput('Elevator opened doors on floor 3.')
            ->expectsOutput('The elevator took command to move to floor 2.')
            ->expectsOutput('Elevator closed the doors on floor 3.')
            ->expectsOutput('Elevator opened doors on floor 2.')
            ->expectsOutput('The passenger left the elevator on floor 2')
            ->expectsOutput('Elevator closed the doors on floor 2.')
            ->expectsOutput('Elevator opened doors on floor 1.')
            ->expectsOutput('The passenger left the elevator on floor 1')
            ->expectsOutput('Elevator closed the doors on floor 1.')
            ->expectsOutput('Elevator stopped.')
            ->assertExitCode(0);

        $this->artisan('elevator:start')
            ->expectsQuestion('Start elevator?', 'no')
            ->assertExitCode(0);
    }
}

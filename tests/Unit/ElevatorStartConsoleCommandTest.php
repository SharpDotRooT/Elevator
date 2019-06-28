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
            ->assertExitCode(0);

        $this->artisan('elevator:start')
            ->expectsQuestion('Start elevator?', 'no')
            ->assertExitCode(0);
    }
}

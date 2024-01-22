<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Classes\CoordsDistanceCalculator;

class CoordsDistanceCalculatorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDistance()
    {
        $distance1 = CoordsDistanceCalculator::distance(
            51.5,
            -0.1,
            38.8,
            -77.1,
        );
        $this->assertIsFloat($distance1);

        $distance2 = CoordsDistanceCalculator::distance(
            51.5,
            -0.1,
            51.5,
            -0.1,
        );
        $this->assertEquals(0, $distance2);
    }
}

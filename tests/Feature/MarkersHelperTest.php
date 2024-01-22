<?php

namespace Tests\Feature;

use App\Classes\MarkersHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarkersHelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderMarkersWithShortestDistance()
    {
        $markers = [
            '51.5,-0.1',
            '40.7,-74.0',
            '48.9,2.4',
            '38.8,-77.1',
        ];
        $markersOrdered = MarkersHelper::orderMarkersWithShortestDistance($markers);
        $this->assertEquals('51.5,-0.1', $markersOrdered[0]);
        $this->assertEquals(4, sizeof($markersOrdered));
        $markers = [
        ];
        $markersOrdered = MarkersHelper::orderMarkersWithShortestDistance($markers);
        $this->assertEquals(0, sizeof($markersOrdered));
    }
}

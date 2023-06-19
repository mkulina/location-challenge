<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\CoordinateController;
use PHPUnit\Framework\TestCase;

class CoordinateControllerTest extends TestCase
{
    public function testCalculateDistance()
    {
        $controller = new CoordinateController();

        // Test case 1: Distance between same coordinates should be 0
        $latitude = 53.3340285;
        $longitude = -6.2535495;
        $result = $controller->calculateDistance($latitude, $longitude, $latitude, $longitude);
        $this->assertEquals(0, $result);

        // Test case 2: Distance between two close points
        $latitude1 = 53.3340285;
        $longitude1 = -6.2535495;
        $latitude2 = 53.3340482;
        $longitude2 = -6.2535196;
        $result = $controller->calculateDistance($latitude1, $longitude1, $latitude2, $longitude2);
        // Expected distance calculated using an external tool or formula
        $expectedDistance = 0.0029563675638876;
        $this->assertEquals($expectedDistance, $result, '', 0.0000001);

        // Test case 3: Distance between two points on opposite sides of the Earth
        $latitude1 = 53.3340285;
        $longitude1 = -6.2535495;
        $latitude2 = -33.8688;
        $longitude2 = 151.2093;
        $result = $controller->calculateDistance($latitude1, $longitude1, $latitude2, $longitude2);
        // Expected distance calculated using an external tool or formula
        $expectedDistance = 17215.242469992;
        $this->assertEquals($expectedDistance, $result, '', 0.0000001);
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class CoordinateController extends Controller
{
    public function findWithinRadius(Request $request)
    {
        $locations = $this->processFile();
        $dublinCoordinates = ["latitude" => "53.3340285", "longitude" => "-6.2535495"];
        $closeLocations = new Collection();

        foreach ($locations as $location) {
            $latitude = $location["latitude"];
            $longitude = $location["longitude"];
            $distance = $this->calculateDistance($dublinCoordinates["latitude"], $dublinCoordinates["longitude"], $latitude, $longitude);

            if ($distance <= 100) {
                $closeLocations->push($location);
            }
        }

        $sortedLocations = $closeLocations->sortBy('affiliate_id');
        // Could also pass close locations to front end. Or add distance to office as a column
        return View::make('list', compact('sortedLocations'));
    }

    /**
     * Processes a file and returns its contents as an array.
     *
     * @return array The contents of the file.
     */
    private function processFile(): array
    {
        $filePath = storage_path('app/affiliates.txt');

        try {
            if (file_exists($filePath)) {
                $data = [];

                // Read the file line by line
                $lines = file($filePath, FILE_IGNORE_NEW_LINES);

                foreach ($lines as $line) {
                    $decodedLine = json_decode($line, true);

                    if ($decodedLine !== null) {
                        $data[] = $decodedLine;
                    } else {
                        // Handle the case when decoding fails for a line
                        // You can log an error or skip the line
                    }
                }

                return $data;
            } else {
                echo 'File not found.';
            }
        } catch (Exception $e) {
            echo 'Error reading or decoding the file: ' . $e->getMessage();
        }
    }

    /**
     * Calculates the distance between two locations based on their latitude and longitude.
     *
     * @param float $latitude1 Latitude of the first location.
     * @param float $longitude1 Longitude of the first location.
     * @param float $latitude2 Latitude of the second location.
     * @param float $longitude2 Longitude of the second location.
     *
     * @return string The calculated distance between the two locations.
     */
    public function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2): string 
    {
        $earthRadius = 6371; // radius of the Earth in kilometers
    
        // Convert degrees to radians
        $lat1 = deg2rad($latitude1);
        $lon1 = deg2rad($longitude1);
        $lat2 = deg2rad($latitude2);
        $lon2 = deg2rad($longitude2);
    
        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
    
        return $distance;
    }
}

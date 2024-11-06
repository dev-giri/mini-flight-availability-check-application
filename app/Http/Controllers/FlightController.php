<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    public function search(Request $request)
    {
        $dayOfWeek = Carbon::parse($request->date_of_travel)->format('l');

        $flights = Flight::where('takeoff_location', 'like', "%{$request->boarding_location}%")
            ->where('landing_location', 'like', "%{$request->destination_location}%")
            ->whereJsonContains('operating_days', $dayOfWeek)
            ->get();

        return Inertia::render('FlightSearch', [
            'flights' => $flights
        ]);
    }

    // Store a new flight
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_name' => 'required|string',
            'takeoff_location' => 'required|string',
            'landing_location' => 'required|string',
            'operating_days' => 'required|array',
        ]);
        $validated['operating_days'] = json_encode($validated['operating_days']);
        $flight = Flight::create($validated);
        return redirect()->route('dashboard');
    }
}

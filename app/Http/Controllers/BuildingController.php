<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Http\Requests\StoreBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use Illuminate\Http\Request;
use App\Models\Image;

class BuildingController extends Controller
{
    public function index()
    {
        return Building::with('images')->get();
    }

    public function filter(Request $request)
    {
        $request->validate([
            'city'          => 'nullable|string|max:255',
            'value_min'     => 'nullable|numeric|min:0',
            'value_max'     => 'nullable|numeric|min:0',
            'room_amount'   => 'nullable|array',
            'room_amount.*' => 'integer|min:1',
        ]);

        $query = Building::query();

        // Filter by city (case-insensitive)
        if ($request->filled('city')) {
            $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        // Filter by rental_value range
        if ($request->filled('value_min')) {
            $query->where('rental_value', '>=', $request->value_min);
        }

        if ($request->filled('value_max')) {
            $query->where('rental_value', '<=', $request->value_max);
        }

        // Filter by room amount
        if ($request->filled('room_amount')) {
            // If includes 4+, we match >= 4
            $query->where(function ($q) use ($request) {
                foreach ($request->room_amount as $room) {
                    if ($room >= 4) {
                        $q->orWhere('room_amount', '>=', 4);
                    } else {
                        $q->orWhere('room_amount', $room);
                    }
                }
            });
        }

        return response()->json($query->with('images')->get());
    }

    public function store(StoreBuildingRequest $request)
    {
        $building = Building::create($request->validated());
        // Save base64 images directly in DB
        if ($request->has('images')) {
            foreach ($request->images as $base64) {
                Image::create([
                    'building_id' => $building->id,
                    'base_64' => $base64, // store raw base64 string
                ]);
            }
        }
        return response()->json($building, 201);
    }

    public function show(Building $building)
    {
        return $building->load('images');
    }

    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $building->update($request->validated());
        return response()->json($building);
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
}

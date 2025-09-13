<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return Building::with('images')->get();
    }

    public function store(Request $request)
    {
        $building = Building::create($request->all());
        return response()->json($building, 201);
    }

    public function show(Building $building)
    {
        return $building->load('images');
    }

    public function update(Request $request, Building $building)
    {
        $building->update($request->all());
        return response()->json($building);
    }

    public function destroy(Building $building)
    {
        $building->delete();
        return response()->json(null, 204);
    }
}

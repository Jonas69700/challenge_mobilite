<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $activities = $user->activities()
            ->orderByDesc('date')
            ->take(10)
            ->get();

        return view('activities.create', compact('activities'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        // Vérifie s’il existe déjà une activité pour aujourd’hui
        $exists = Activity::where('user_id', $user->id)
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'date' => 'Vous avez déjà déclaré une activité pour ce jour.',
            ])->withInput();
        }

        // Conversion automatique si marche/course
        $distance = $data['type'] === 'walk'
            ? round($data['steps'] / 1500, 2)
            : $data['distance_km'];

        Activity::create([
            'user_id' => $user->id,
            'type' => $data['type'],
            'date' => $data['date'],
            'steps' => $data['steps'] ?? null,
            'distance_km' => $distance,
        ]);

        return redirect()->route('activities.create')->with('success', 'Activité enregistrée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $activities = $user->activities()->get();

        $totalKm = $activities->sum(function ($a) {
            return $a->type === 'walk' ? $a->steps / 1500 : $a->distance_km;
        });

        $totalDays = $activities->unique('date')->count();

        $avgKm = $totalDays > 0 ? $totalKm / $totalDays : 0;

        $byType = [
            'bike' => $activities->where('type', 'bike')->sum('distance_km'),
            'walk' => $activities->where('type', 'walk')->sum(fn($a) => $a->steps / 1500),
        ];

        $last30days = collect();

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');

            $km = $activities->filter(function ($a) use ($date) {
                return $a->date->format('Y-m-d') === $date;
            })->sum(function ($a) {
                return $a->type === 'walk' ? $a->steps / 1500 : $a->distance_km;
            });

            $last30days->push([
                'date' => \Carbon\Carbon::parse($date)->format('d/m'),
                'km' => round($km, 2),
            ]);
        }

        return view('dashboard.index', compact('totalKm', 'avgKm', 'byType', 'last30days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

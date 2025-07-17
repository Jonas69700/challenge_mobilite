<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StatService;


class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;

        // ----- CLASSEMENT UTILISATEURS -----
        $users = User::select('users.id', 'users.name')
            ->leftJoin('activities', 'users.id', '=', 'activities.user_id')
            ->selectRaw('
            SUM(CASE 
                WHEN activities.type = "bike" THEN activities.distance_km
                WHEN activities.type = "walk" THEN activities.steps / 1500
                ELSE 0 END
            ) as total_km')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_km')
            ->get();

        $topUsers = $users->take(10);
        $rank = $users->search(fn($u) => $u->id === $userId) + 1;
        $totalUsers = $users->count();

        // ----- CLASSEMENT ÉQUIPES -----
        $teams = Team::select('teams.id', 'teams.name')
            ->leftJoin('users', 'teams.id', '=', 'users.team_id')
            ->leftJoin('activities', 'users.id', '=', 'activities.user_id')
            ->selectRaw('
            COUNT(DISTINCT users.id) as members_count,
            SUM(CASE 
                WHEN activities.type = "bike" THEN activities.distance_km
                WHEN activities.type = "walk" THEN activities.steps / 1500
                ELSE 0 END) as total_km')
            ->groupBy('teams.id', 'teams.name')
            ->orderByDesc('total_km')
            ->get()
            ->map(function ($team) {
                $team->average_km = $team->members_count ? round($team->total_km / $team->members_count, 2) : 0;
                return $team;
            });

        // ----- STATISTIQUES -----
        $globalStats = [
            'total_users' => $totalUsers,
            'total_teams' => Team::count(),
            'total_km' => $users->sum('total_km'),
            'average_per_user' => $totalUsers ? round($users->sum('total_km') / $totalUsers, 2) : 0,
        ];

        return view('rankings.index', compact('topUsers', 'users', 'rank', 'totalUsers', 'teams', 'globalStats'));
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

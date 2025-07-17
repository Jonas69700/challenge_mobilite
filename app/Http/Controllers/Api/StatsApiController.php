<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;

class StatsApiController extends Controller
{
    public function general()
    {
        $users = User::with('activities')->get();
        $totalKm = $users->sum(function ($user) {
            return $user->activities->sum(function ($activity) {
                return $activity->type === 'bike'
                    ? $activity->distance_km
                    : $activity->steps / 1500;
            });
        });

        $totalUsers = $users->count();
        $totalTeams = Team::count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_users' => $totalUsers,
                'total_teams' => $totalTeams,
                'total_km' => round($totalKm, 2),
                'average_per_user' => $totalUsers ? round($totalKm / $totalUsers, 2) : 0,
            ],
            'meta' => null,
        ]);
    }

    public function teams()
    {
        $teams = Team::with('users.activities')->get()->map(function ($team) {
            $totalKm = $team->users->sum(function ($user) {
                return $user->activities->sum(function ($a) {
                    return $a->type === 'bike' ? $a->distance_km : $a->steps / 1500;
                });
            });

            return [
                'id' => $team->id,
                'name' => $team->name,
                'members_count' => $team->users->count(),
                'total_km' => round($totalKm, 2),
                'average_km' => $team->users->count() ? round($totalKm / $team->users->count(), 2) : 0,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $teams,
            'meta' => null,
        ]);
    }

    public function users()
    {
        $users = User::with('activities')->get()->map(function ($user) {
            $totalKm = $user->activities->sum(function ($a) {
                return $a->type === 'bike' ? $a->distance_km : $a->steps / 1500;
            });

            return [
                'id' => $user->id,
                'name' => $user->name,
                'total_km' => round($totalKm, 2),
            ];
        })->sortByDesc('total_km')->values();

        return response()->json([
            'status' => 'success',
            'data' => $users->forPage(request('page', 1), 20)->values(),
            'meta' => [
                'total' => $users->count(),
                'page' => (int) request('page', 1),
                'per_page' => 20,
            ],
        ]);
    }
}
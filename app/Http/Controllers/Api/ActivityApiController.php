<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;

class ActivityApiController extends Controller
{
    public function index()
    {
        $activities = Activity::select('id', 'user_id', 'type', 'distance_km', 'steps', 'date')
            ->orderByDesc('date')
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => $activities->items(),
            'meta' => [
                'total' => $activities->total(),
                'page' => $activities->currentPage(),
                'per_page' => $activities->perPage(),
            ],
        ]);
    }

    public function byUser($id)
    {
        $user = User::findOrFail($id);

        $activities = $user->activities()
            ->select('id', 'type', 'distance_km', 'steps', 'date')
            ->orderByDesc('date')
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => $activities->items(),
            'meta' => [
                'total' => $activities->total(),
                'page' => $activities->currentPage(),
                'per_page' => $activities->perPage(),
            ],
        ]);
    }
}


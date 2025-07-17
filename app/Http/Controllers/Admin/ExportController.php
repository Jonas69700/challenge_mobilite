<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function csv(): StreamedResponse
    {
        $fileName = 'challenge_global.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Nom', 'Email', 'Équipe', 'Distance totale (km)', 'Total pas', 'Nombre d’activités'];

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            $users = \App\Models\User::with(['team', 'activities'])->get();

            foreach ($users as $user) {
                $totalSteps = $user->activities->sum('steps');
                $totalDistance = $user->activities->reduce(function ($carry, $activity) {
                    if ($activity->type === 'bike') {
                        return $carry + $activity->distance_km;
                    } elseif ($activity->type === 'walk') {
                        return $carry + ($activity->steps / 1500);
                    }
                    return $carry;
                }, 0);

                fputcsv($handle, [
                    $user->name,
                    $user->email,
                    $user->team->name ?? 'Aucune',
                    round($totalDistance, 2),
                    $totalSteps,
                    $user->activities->count(),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}

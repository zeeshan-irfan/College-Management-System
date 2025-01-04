<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class NavigationController extends Controller
{
    public function toAdminDashboard()
    {
        $status = true; // Define the active status for all fields

        // Cache counts for 10 minutes
        $counts = Cache::remember('admin_dashboard_counts', now()->addMinutes(10), function () use ($status) {
            return DB::selectOne("
                SELECT
                    (SELECT COUNT(*) FROM records) AS recordsCount,
                    (SELECT COUNT(*) FROM departments WHERE status = ?) AS departmentsCount,
                    (SELECT COUNT(*) FROM programs WHERE status = ?) AS programsCount,
                    (SELECT COUNT(*) FROM degrees WHERE status = ?) AS degreesCount,
                    (SELECT COUNT(*) FROM users) AS usersCount,
                    (SELECT COUNT(*) FROM banks) AS banksCount
            ", [$status, $status, $status]); // Bind the $status variable to each placeholder
        });

        return view('admin.home', [
            'recordsCount' => $counts->recordsCount,
            'departmentsCount' => $counts->departmentsCount,
            'programsCount' => $counts->programsCount,
            'degreesCount' => $counts->degreesCount,
            'usersCount' => $counts->usersCount,
            'banksCount' => $counts->banksCount,
        ]);
    }


    public function toUserDashboard()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        $status = true; // Define the active status for departments

        // Cache counts for 10 minutes, specific to this user
        $cacheKey = "user_dashboard_counts_{$userId}";
        $counts = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($userId, $status) {
            return DB::selectOne("
                SELECT
                    (SELECT COUNT(*) FROM records WHERE user_id = ?) AS recordsCount,
                    (SELECT COUNT(*) FROM departments WHERE status = ?) AS departmentsCount,
                    (SELECT COUNT(*) FROM programs) AS programsCount
                ", [$userId, $status]); // Bind the user ID and status values
        });

        return view('user.home', [
            'recordsCount' => $counts->recordsCount ?? 0,
            'departmentsCount' => $counts->departmentsCount ?? 0,
            'programsCount' => $counts->programsCount ?? 0,
        ]);
    }


}


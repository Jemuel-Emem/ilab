<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Payments;
use App\Models\User;
use Carbon\Carbon;

class Index extends Component
{
    public $dailyPatientCount;
    public $serviceRanking;
    public $totalClients;
    public $dailyPaymentsData = [];

    public function mount()
    {
        // Daily Patients
        $this->dailyPatientCount = Payments::whereDate('created_at', Carbon::today())
            ->distinct('user_id')
            ->count('user_id');

        // Ranking of Services
        $this->serviceRanking = Payments::select('service_id')
            ->with('service')
            ->selectRaw('service_id, COUNT(*) as count')
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->take(3)
            ->get();

        // Total Clients
        $this->totalClients = User::count();

        // Prepare daily transactions data for chart
        $this->dailyPaymentsData = Payments::selectRaw('DATE(created_at) as date, COUNT(DISTINCT user_id) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function ($item) {
                return ['date' => $item->date, 'total' => $item->total];
            });
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'dailyPaymentsData' => $this->dailyPaymentsData
        ]);
    }
}

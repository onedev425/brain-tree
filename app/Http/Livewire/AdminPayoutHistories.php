<?php

namespace App\Http\Livewire;

use App\Services\Admin\AdminPricingService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPayoutHistories extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public string $fromDate = '';
    public string $toDate = '';
    public int $per_page = 10;

    public function mount($unique_id = null, $per_page = 10)
    {
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {
        $adminPricingService = app(AdminPricingService::class);
        $payout_histories = $adminPricingService->getPayoutHistories($this->fromDate, $this->toDate, $this->search);
        $payout_histories = $payout_histories->paginate(10);

        return view('livewire.admin-payout-histories', [
            'payout_histories' => $payout_histories,
        ]);
    }
}

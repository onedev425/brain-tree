<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\Admin\AdminPricingService;
use App\Services\Payment\PaypalService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class AdminPayout extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public string $fromDate = '';
    public string $toDate = '';
    public int $per_page = 10;
    public array $payout_amounts  = [];
    public int $total_earning = 0;
    public int $fee_amount = 0;
    public int $teacher_id = -1;
    public string $payout_at;

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
        $teachers = $adminPricingService->getSoldCoursesOfTeacher($this->search);
        $teachers = $teachers->paginate(10);

        return view('livewire.admin-payout', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Allow the given user's role to be managed.
     *
     * @param  int  $teacher_id
     * @return void
     */
    public function updatePayoutFee($teacher_id, $fee_amount, $payout_at)
    {
        $this->teacher_id = $teacher_id;
        $this->fee_amount = $fee_amount;
        $this->payout_at = date("Y-m-d", strtotime($payout_at));
    }

    /**
     * Allow the given user's role to be managed.
     *
     * @param  int  $teacher_id
     * @return void
     */
    public function savePayoutFee()
    {
        if ($this->teacher_id > 0) {
            $user = User::find($this->teacher_id);

            if ($user) {
                $user->fee_amount = $this->fee_amount;
                $user->payout_at = $this->payout_at;
                $user->save();
            }
            $this->teacher_id = -1;
            $this->fee_amount = -1;
            $this->payout_at = now()->format("m/d Y");
        }
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TeacherPricingPaymentMethod extends Component
{
    public string $connection_date;
    public string $error_message;

    public function mount()
    {
        $teacher = auth()->user();
        $this->connection_date = $teacher->payment_connection ? $teacher->payment_connection->created_at : '';
        $this->error_message = (Request::has('message') && Request::filled('message')) ? Request::input('message') : '';
    }

    public function render()
    {
        return view('livewire.teacher-pricing-payment-method');
    }
}

<?php

namespace App\Http\Livewire;

use App\Services\School\SchoolService;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class LoginForm extends Component
{
    public $activeTab = 'login';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}

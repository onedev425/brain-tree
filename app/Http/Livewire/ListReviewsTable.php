<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Request;

class ListReviewsTable extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public int $per_page = 10;
    private StudentService $studentService;
    public string $activeTab = 'all';
    private $reviews;

    public function mount(StudentService $studentService, $unique_id = null, $per_page = 10)
    {
        $this->studentService = $studentService;
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
        $this->setTab((Request::has('type') && Request::filled('type')) ? Request::input('type') : 'all');
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
        //  get the reviews list again based on tab
        
    }

    public function render()
    {
        if (!isset($this->studentService)) {
            $this->studentService = app(StudentService::class);
        }
        $this->reviews = $this->studentService->getStudentReviews($this->search, $this->activeTab);
        $this->reviews = $this->reviews->paginate(10);
        return view('livewire.list-reviews-table', [
            'all_reviews' => $this->reviews,
        ]);
    }
}

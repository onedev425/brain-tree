<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustryRequest;
use App\Models\Industry;
use App\Services\Industry\IndustryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class IndustryController extends Controller
{
    public IndustryService $industryService;

    public function __construct(IndustryService $industryService)
    {
        $this->industryService = $industryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.industry.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $industry = new Industry();
        return view('pages.industry.create', compact('industry'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIndustryRequest $request): RedirectResponse
    {
        $this->industryService->storeIndustry($request->validated());
        $client = new Client();

        try {
            $client->request('POST', env('WP_API_SYNC_BASE_URL') . "/wp-json/sync-api/v1/category/create", [
                'form_params' => ['category' => $request['name']]
            ]);
        } catch(\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }

        return redirect()->route('industry.index')->with('success', 'Industry Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Industry $industry): Response
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Industry $industry): View
    {
        return view('pages.industry.edit', compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreIndustryRequest $request, Industry $industry): RedirectResponse
    {
        $this->industryService->updateIndustry($industry, $request->validated());
        $client = new Client();

        try {
            $client->request('POST', env('WP_API_SYNC_BASE_URL') . "/wp-json/sync-api/v1/category/update", [
                'form_params' => [
                    'category' => $industry->name,
                    'new_category' => $request['name']
                ]
            ]);
        } catch(\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }

        return back()->with('success', 'Industry Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industry $industry): RedirectResponse
    {
        try {
            $this->industryService->deleteIndustry($industry);
            $client = new Client();

                $client->request('POST', env('WP_API_SYNC_BASE_URL') . "/wp-json/sync-api/v1/category/delete", [
                    'form_params' => ['category' => $industry->name]
                ]);
        } catch(\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return back()->with('danger', 'It\'s failed to delete the course because there is a course that is using an industry.');
        }

        return back()->with('success', 'Industry Deleted Successfully');
    }
}

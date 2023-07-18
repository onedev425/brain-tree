<?php

namespace App\Services\Industry;

use App\Models\Industry;

class IndustryService
{
    /**
     * Store a new industry.
     *
     * @param array $records
     */
    public function storeIndustry($records): Industry
    {
        $industry = Industry::create([
            'name' => $records['name'],
        ]);

        return $industry;
    }

    /**
     * Update a industry.
     *
     * @param Industry   $industry
     * @param array $record
     */
    public function updateIndustry(Industry $industry, $record): Industry
    {
        $industry->update([
            'name'         => $record['name'],
            'description'  => $record['description'] ?? null,
        ]);

        return $industry;
    }

    /**
     * Delete a industry.
     *
     * @param Industry $industry
     */
    public function deleteIndustry(Industry $industry): bool|null
    {
        return $industry->delete();
    }
}

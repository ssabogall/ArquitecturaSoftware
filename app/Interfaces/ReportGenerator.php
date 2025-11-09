<?php

/**
 * ReportGenerator Interface
 *
 * Defines the contract for report generation.
 *
 * @author Alejandro Carmona
 */

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ReportGenerator
{
    public function generate(Collection $data, array $columns, string $title): string;

    public function getExtension(): string;

    public function getMimeType(): string;
}

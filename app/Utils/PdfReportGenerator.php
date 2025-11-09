<?php

/**
 * PdfReportGenerator
 *
 * Implementation for generating PDF reports using DomPDF.
 *
 * @author Alejandro Carmona
 */

namespace App\Utils;

use App\Interfaces\ReportGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class PdfReportGenerator implements ReportGenerator
{
    public function generate(Collection $data, array $columns, string $title): string
    {
        $pdf = Pdf::loadView('admin.reports.template', [
            'title' => $title,
            'data' => $data,
            'columns' => $columns,
        ]);

        $filename = $this->generateFilename($title);
        $path = storage_path('app/public/reports/' . $filename);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        $pdf->save($path);

        return 'storage/reports/' . $filename;
    }

    public function getExtension(): string
    {
        return 'pdf';
    }

    public function getMimeType(): string
    {
        return 'application/pdf';
    }

    private function generateFilename(string $title): string
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $timestamp = time();

        return "{$slug}-{$timestamp}.{$this->getExtension()}";
    }
}

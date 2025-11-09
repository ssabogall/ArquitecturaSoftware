<?php

/**
 * ExcelReportGenerator
 *
 * Implementation for generating Excel reports using Maatwebsite/Excel.
 *
 * @author Alejandro Carmona
 */

namespace App\Utils;

use App\Interfaces\ReportGenerator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelReportGenerator implements ReportGenerator
{
    public function generate(Collection $data, array $columns, string $title): string
    {
        $filename = $this->generateFilename($title);
        $path = storage_path('app/public/reports/' . $filename);
        
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setTitle(substr($title, 0, 31));
        
        $columnLetters = range('A', 'Z');
        $columnIndex = 0;
        foreach ($columns as $key => $label) {
            $sheet->setCellValue($columnLetters[$columnIndex] . '1', $label);
            $sheet->getStyle($columnLetters[$columnIndex] . '1')->getFont()->setBold(true);
            $columnIndex++;
        }
        
        $rowIndex = 2;
        foreach ($data as $item) {
            $columnIndex = 0;
            foreach ($columns as $key => $label) {
                $value = is_object($item) ? ($item->$key ?? '-') : ($item[$key] ?? '-');
                $sheet->setCellValue($columnLetters[$columnIndex] . $rowIndex, $value);
                $columnIndex++;
            }
            $rowIndex++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
        
        if (!file_exists($path)) {
            throw new \Exception("Error: No se pudo crear el archivo Excel en: $path");
        }

        return 'storage/reports/' . $filename;
    }

    public function getExtension(): string
    {
        return 'xlsx';
    }

    public function getMimeType(): string
    {
        return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    }

    private function generateFilename(string $title): string
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $timestamp = time();

        return "{$slug}-{$timestamp}.{$this->getExtension()}";
    }
}

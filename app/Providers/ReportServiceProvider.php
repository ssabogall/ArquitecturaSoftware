<?php

/**
 * ReportServiceProvider
 *
 * Service Provider for report generation.
 *
 * @author Alejandro Carmona
 */

namespace App\Providers;

use App\Interfaces\ReportGenerator;
use App\Utils\ExcelReportGenerator;
use App\Utils\PdfReportGenerator;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('report.pdf', function ($app) {
            return new PdfReportGenerator;
        });

        $this->app->bind('report.excel', function ($app) {
            return new ExcelReportGenerator;
        });

        $this->app->bind(ReportGenerator::class, function ($app) {
            return $app->make('report.pdf');
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

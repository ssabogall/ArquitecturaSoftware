<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ReportGenerator;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function generateSalesReport(string $type): BinaryFileResponse
    {
        if (!in_array($type, ['pdf', 'excel'])) {
            abort(400, 'Tipo de reporte inválido');
        }

        $salesData = OrderItem::select(
            'mobile_phones.name as producto',
            'mobile_phones.brand as marca',
            DB::raw('COUNT(order_items.id) as cantidad_vendida'),
            DB::raw('SUM(order_items.quantity) as unidades_totales'),
            DB::raw('SUM(order_items.price * order_items.quantity) as ingresos_totales')
        )
        ->join('mobile_phones', 'order_items.mobile_phone_id', '=', 'mobile_phones.id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->groupBy('mobile_phones.id', 'mobile_phones.name', 'mobile_phones.brand')
        ->orderBy('ingresos_totales', 'desc')
        ->get();

        $columns = [
            'producto' => __('messages.product'),
            'marca' => __('messages.brand'),
            'cantidad_vendida' => __('messages.sales_count'),
            'unidades_totales' => __('messages.total_units'),
            'ingresos_totales' => __('messages.total_revenue'),
        ];

        $generator = app('report.' . $type);
        $filePath = $generator->generate(
            $salesData,
            $columns,
            __('messages.sales_report')
        );

        return response()->download(
            public_path($filePath),
            basename($filePath),
            ['Content-Type' => $generator->getMimeType()]
        )->deleteFileAfterSend(true);
    }
}

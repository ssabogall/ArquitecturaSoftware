{{--
    View: Compare Show
    Purpose: Displays side-by-side comparison of selected phones.

    @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">{{ __('messages.phone_comparison') }}</h1>
        <a href="{{ route('compare.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            {{ __('messages.back_to_selection') }}
        </a>
    </div>
</div>

@if ($viewData['phones']->count() < 2)
    <div class="alert alert-warning">
        {{ __('messages.select_at_least_2') }}
    </div>
@else
    <!-- Basic Info Row -->
    <div class="row g-3 mb-4">
        @foreach ($viewData['phones'] as $phone)
            <div class="col-12 col-md-{{ $viewData['phones']->count() === 2 ? '6' : '4' }}">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $viewData['phones'][$loop->index]->getBrand() }}</h5>
                        <p class="card-text text-muted mb-1">{{ $viewData['phones'][$loop->index]->getName() }}</p>
                        @if ($viewData['phones'][$loop->index]->specification)
                            <p class="card-text small text-muted">{{ $viewData['phones'][$loop->index]->specification->getModel() }}</p>
                        @endif
                        <p class="card-text fw-bold text-primary fs-4">${{ number_format($viewData['phones'][$loop->index]->getPrice(), 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Specifications Comparison Table -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ __('messages.specifications_comparison') }}</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="bg-light" style="width: 25%;">{{ __('messages.specification') }}</th>
                            @foreach ($viewData['phones'] as $phone)
                                <th class="text-center">
                                    {{ $viewData['phones'][$loop->index]->specification ? $viewData['phones'][$loop->index]->specification->getModel() : $viewData['phones'][$loop->index]->getName() }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $specsToCompare = [
                                'processor' => __('messages.processor'),
                                'battery' => __('messages.battery'),
                                'screen_size' => __('messages.screen_size'),
                                'screen_tech' => __('messages.screen_tech'),
                                'ram' => __('messages.ram'),
                                'storage' => __('messages.storage'),
                                'camera_specs' => __('messages.camera_specs'),
                                'color' => __('messages.color'),
                            ];
                        @endphp

                        @php
                            $hasAnySpec = false;
                            foreach ($viewData['phones'] as $phone) {
                                if ($phone->specification) {
                                    $hasAnySpec = true;
                                    break;
                                }
                            }
                        @endphp

                        @if (!$hasAnySpec)
                            <tr>
                                <td colspan="{{ $viewData['phones']->count() + 1 }}" class="text-center text-muted py-4">
                                    {{ __('messages.no_specifications') }}
                                </td>
                            </tr>
                        @else
                            @foreach ($specsToCompare as $field => $label)
                                <tr>
                                    <td class="fw-bold bg-light">{{ $label }}</td>
                                    @php
                                        $values = collect();
                                        $parts = explode('_', $field);
                                        $getter = 'get' . implode('', array_map('ucfirst', $parts));
                                        foreach ($viewData['phones'] as $phone) {
                                            if ($phone->specification) {
                                                $values->push($phone->specification->$getter());
                                            }
                                        }
                                        $valuesDiffer = $values->filter()->unique()->count() > 1;
                                    @endphp
                                    
                                    @foreach ($viewData['phones'] as $phone)
                                        @php
                                            if ($viewData['phones'][$loop->index]->specification) {
                                                $parts = explode('_', $field);
                                                $getter = 'get' . implode('', array_map('ucfirst', $parts));
                                                $value = $viewData['phones'][$loop->index]->specification->$getter();
                                                
                                                if ($field === 'battery') {
                                                    $displayValue = $value . ' mAh';
                                                } elseif ($field === 'screen_size') {
                                                    $displayValue = $value . '"';
                                                } elseif ($field === 'ram') {
                                                    $displayValue = $value . ' GB';
                                                } elseif ($field === 'storage') {
                                                    $displayValue = $value . ' GB';
                                                } else {
                                                    $displayValue = $value;
                                                }
                                            } else {
                                                $displayValue = '-';
                                            }
                                        @endphp
                                        <td class="text-center {{ $valuesDiffer && $viewData['phones'][$loop->index]->specification ? 'table-warning' : '' }}">
                                            {{ $displayValue }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted small">
            <i class="bi bi-info-circle"></i>
            {{ __('messages.highlighted_specs_differ') }}
        </div>
    </div>

    <!-- Additional Info -->
    <div class="row g-3 mt-3">
        @foreach ($viewData['phones'] as $phone)
            <div class="col-12 col-md-{{ $viewData['phones']->count() === 2 ? '6' : '4' }}">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{ $viewData['phones'][$loop->index]->specification 
                                ? $viewData['phones'][$loop->index]->specification->getModel() 
                                : $viewData['phones'][$loop->index]->getName() }}
                        </h6>
                        <p class="card-text small text-muted">{{ $viewData['phones'][$loop->index]->getName() }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-muted small">
                                <i class="bi bi-box-seam"></i>
                                {{ __('messages.stock') }}: {{ $viewData['phones'][$loop->index]->getStock() }}
                            </span>
                            @if ($viewData['phones'][$loop->index]->getStock() > 0)
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="mobile_phone_id" value="{{ $viewData['phones'][$loop->index]->getId() }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-cart-plus"></i>
                                        {{ __('messages.add_to_cart') }}
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-secondary">{{ __('messages.out_of_stock') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
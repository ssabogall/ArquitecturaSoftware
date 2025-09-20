@extends('layouts.admin')

@section('title', __('messages.products'))
@section('header', __('messages.products'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">{{ __('messages.products') }}</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">{{ __('messages.create') }}</a>
        </div>

        @if(!isset($products) || $products->isEmpty())
            <p class="mb-0">{{ __('messages.no_results') }}</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.name') }}</th>
                            <th>{{ __('messages.brand') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.stock') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th class="text-end">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->getId() }}</td>
                                <td>{{ $product->getName() }}</td>
                                <td>{{ $product->getBrand() }}</td>
                                <td>{{ $product->getPrice() }}</td>
                                <td>{{ $product->getStock() }}</td>
                                <td>{{ $product->getCreatedAt() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.products.show', $product->getId()) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                                    <a href="{{ route('admin.products.edit', $product->getId()) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('admin.products.destroy', $product->getId()) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.are_you_sure') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">{{ __('messages.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        @endif
    </div>
</div>
@endsection

{{--
    View: Admin Products Index
    Purpose: Muestra la lista de productos en el panel de administrador.

    @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.products'))
@section('header', __('messages.products'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">{{ __('messages.products') }}</h5>
            <a href="{{ route('admin.mobilePhones.create') }}" class="btn btn-primary btn-sm">{{ __('messages.create') }}</a>
        </div>

        @if(!isset($viewData['mobilePhones']) || $viewData['mobilePhones']->isEmpty())
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
                        @foreach($viewData['mobilePhones'] as $mobilePhone)
                            <tr>
                                <td>{{ $mobilePhone->getId() }}</td>
                                <td>{{ $mobilePhone->getName() }}</td>
                                <td>{{ $mobilePhone->getBrand() }}</td>
                                <td>{{ $mobilePhone->getPrice() }}</td>
                                <td>{{ $mobilePhone->getStock() }}</td>
                                <td>{{ $mobilePhone->getCreatedAt() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.mobilePhones.show', ['mobilePhone' => $mobilePhone->getId()]) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                                    <a href="{{ route('admin.mobilePhones.edit', ['mobilePhone' => $mobilePhone->getId()]) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('admin.mobilePhones.destroy', ['mobilePhone' => $mobilePhone->getId()]) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.are_you_sure') }}')">
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
            {{ $viewData['mobilePhones']->links() }}
        @endif
    </div>
</div>
@endsection

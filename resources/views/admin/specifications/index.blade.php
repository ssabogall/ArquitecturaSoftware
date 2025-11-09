{{--
    View: Admin Specifications Index
    Purpose: List of technical specifications.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.specifications'))
@section('header', __('messages.specifications'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">{{ __('messages.specifications') }}</h5>
            <a href="{{ route('admin.specifications.create') }}" class="btn btn-primary btn-sm">{{ __('messages.create') }}</a>
        </div>

        <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.model') }}</th>
                    <th>{{ __('messages.processor') }}</th>
                    <th>{{ __('messages.ram') }}</th>
                    <th>{{ __('messages.storage') }}</th>
                    <th>{{ __('messages.color') }}</th>
                    <th>{{ __('messages.products') }}</th>
                    <th class="text-end">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @forelse($viewData['specs'] as $spec)
                <tr>
                    <td>{{ $spec->getId() }}</td>
                    <td>{{ $spec->getModel() }}</td>
                    <td>{{ $spec->getProcessor() }}</td>
                    <td>{{ $spec->getRam() }}</td>
                    <td>{{ $spec->getStorage() }}</td>
                    <td>{{ $spec->getColor() }}</td>
                    <td>{{ optional($spec->getMobilePhone())->getName() ?? __('messages.not_provided') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.specifications.show', ['specification' => $spec->getId()]) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                        <a href="{{ route('admin.specifications.edit', ['specification' => $spec->getId()]) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
                        <form action="{{ route('admin.specifications.destroy', ['specification' => $spec->getId()]) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.are_you_sure') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">{{ __('messages.no_results') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>
        {{ $viewData['specs']->links() }}
    </div>
</div>
@endsection

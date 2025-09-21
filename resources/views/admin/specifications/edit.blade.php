{{--
    View: Admin Specifications Edit
    Purpose: Editar una Specification existente.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.edit_spec'))
@section('header', __('messages.edit_spec'))

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.specifications.update', $spec->getId()) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.specifications.partials.form', ['spec' => $spec])
                <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">{{ __('messages.update') }}</button>
                        <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
        </form>
    </div>
</div>
@endsection

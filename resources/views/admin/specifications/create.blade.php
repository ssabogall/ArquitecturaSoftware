{{--
    View: Admin Specifications Create
    Purpose: Crear una nueva Specification.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.new_spec'))
@section('header', __('messages.new_spec'))

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.specifications.store') }}" method="POST">
                @csrf
                @include('admin.specifications.partials.form', ['spec' => $spec])
                <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">{{ __('messages.save') }}</button>
                        <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                </div>
        </form>
    </div>
</div>
@endsection

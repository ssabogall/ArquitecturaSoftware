{{--
    View: Admin Specifications Show
    Purpose: Mostrar detalle de Specification.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.spec_details'))
@section('header', __('messages.spec_details'))

@section('content')
<div class="card">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">{{ __('messages.id') }}</dt>
            <dd class="col-sm-9">{{ $spec->getId() }}</dd>

            <dt class="col-sm-3">{{ __('messages.products') }}</dt>
            <dd class="col-sm-9">{{ optional($spec->mobilePhone)->getName() ?? __('messages.not_provided') }}</dd>

            <dt class="col-sm-3">{{ __('messages.model') }}</dt>
            <dd class="col-sm-9">{{ $spec->getModel() }}</dd>

            <dt class="col-sm-3">{{ __('messages.processor') }}</dt>
            <dd class="col-sm-9">{{ $spec->getProcessor() }}</dd>

            <dt class="col-sm-3">{{ __('messages.battery') }}</dt>
            <dd class="col-sm-9">{{ $spec->getBattery() }}</dd>

            <dt class="col-sm-3">{{ __('messages.screen_size') }}</dt>
            <dd class="col-sm-9">{{ $spec->getScreenSize() }}</dd>

            <dt class="col-sm-3">{{ __('messages.screen_tech') }}</dt>
            <dd class="col-sm-9">{{ $spec->getScreenTech() }}</dd>

            <dt class="col-sm-3">{{ __('messages.ram') }}</dt>
            <dd class="col-sm-9">{{ $spec->getRam() }}</dd>

            <dt class="col-sm-3">{{ __('messages.storage') }}</dt>
            <dd class="col-sm-9">{{ $spec->getStorage() }}</dd>

            <dt class="col-sm-3">{{ __('messages.camera_specs') }}</dt>
            <dd class="col-sm-9">{{ $spec->getCameraSpecs() ?? __('messages.not_provided') }}</dd>

            <dt class="col-sm-3">{{ __('messages.color') }}</dt>
            <dd class="col-sm-9">{{ $spec->getColor() }}</dd>
        </dl>
        <div class="mt-3">
            <a href="{{ route('admin.specifications.edit', $spec->getId()) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
            <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>
@endsection

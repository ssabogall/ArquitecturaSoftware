{{--
    View: Admin Specifications Show
    Purpose: Shows the details of a Specification.

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
            <dd class="col-sm-9">{{ $viewData['specification']->getId() }}</dd>

            <dt class="col-sm-3">{{ __('messages.products') }}</dt>
            <dd class="col-sm-9">{{ optional($viewData['specification']->getMobilePhone())->getName() ?? __('messages.not_provided') }}</dd>

            <dt class="col-sm-3">{{ __('messages.model') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getModel() }}</dd>

            <dt class="col-sm-3">{{ __('messages.processor') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getProcessor() }}</dd>

            <dt class="col-sm-3">{{ __('messages.battery') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getBattery() }}</dd>

            <dt class="col-sm-3">{{ __('messages.screen_size') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getScreenSize() }}</dd>

            <dt class="col-sm-3">{{ __('messages.screen_tech') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getScreenTech() }}</dd>

            <dt class="col-sm-3">{{ __('messages.ram') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getRam() }}</dd>

            <dt class="col-sm-3">{{ __('messages.storage') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getStorage() }}</dd>

            <dt class="col-sm-3">{{ __('messages.camera_specs') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getCameraSpecs() ?? __('messages.not_provided') }}</dd>

            <dt class="col-sm-3">{{ __('messages.color') }}</dt>
            <dd class="col-sm-9">{{ $viewData['specification']->getColor() }}</dd>
        </dl>
        <div class="mt-3">
            <a href="{{ route('admin.specifications.edit', ['specification' => $viewData['specification']->getId()]) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
            <a href="{{ route('admin.specifications.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>
@endsection

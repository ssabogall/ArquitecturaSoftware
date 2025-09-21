{{--
    View: Admin Reviews Index
    Purpose: Listado de reseñas para aprobación/denegación.

    @author Miguel Arcila
--}}
@extends('layouts.admin')

@section('title', __('messages.reviews'))
@section('header', __('messages.reviews'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">{{ __('messages.reviews') }}</h5>
        </div>

        @if(!isset($reviews) || $reviews->isEmpty())
            <p class="mb-0">{{ __('messages.no_results') }}</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.users') }}</th>
                        <th>{{ __('messages.products') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.rating') }}</th>
                        <th>{{ __('messages.comments') }}</th>
                        <th>{{ __('messages.created_at') }}</th>
                        <th class="text-end">{{ __('messages.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->getId() }}</td>
                            <td>{{ optional($review->user)->getName() }}</td>
                            <td>{{ optional($review->mobilePhone)->getName() }}</td>
                            <td>
                                <span class="badge text-bg-{{ $review->getStatus() === 'approved' ? 'success' : ($review->getStatus() === 'rejected' ? 'danger' : 'secondary') }}">
                                    {{ __($review->getStatus()) }}
                                </span>
                            </td>
                            <td>{{ $review->getRating() }}</td>
                            <td>{{ $review->getComments() ?? __('messages.not_provided') }}</td>
                            <td>{{ $review->getCreatedAt() }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.reviews.approve', $review->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm" type="submit" @if($review->getStatus()==='approved') disabled @endif>
                                        <i class="bi bi-check2"></i> {{ __('messages.approve') }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.reviews.reject', $review->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-danger btn-sm" type="submit" @if($review->getStatus()==='rejected') disabled @endif>
                                        <i class="bi bi-x"></i> {{ __('messages.reject') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $reviews->links() }}
        @endif
    </div>
</div>
@endsection

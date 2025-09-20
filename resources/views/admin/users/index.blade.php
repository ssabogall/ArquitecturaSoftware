@extends('layouts.admin')

@section('title', __('messages.users'))
@section('header', __('messages.users'))

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title mb-0">{{ __('messages.users') }}</h5>
      <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">{{ __('messages.create') }}</a>
    </div>

    @if($users->isEmpty())
      <p class="mb-0">{{ __('messages.no_results') }}</p>
    @else
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>{{ __('messages.id') }}</th>
              <th>{{ __('messages.name') }}</th>
              <th>{{ __('messages.email') }}</th>
              <th>{{ __('messages.staff') }}</th>
              <th>{{ __('messages.created_at') }}</th>
              <th class="text-end">{{ __('messages.actions') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->staff ? __('messages.yes') : __('messages.no') }}</td>
                <td>{{ $user->created_at }}</td>
                <td class="text-end">
                  <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                  <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">{{ __('messages.edit') }}</a>
                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('messages.are_you_sure') }}')">
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
      {{ $users->links() }}
    @endif
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Pengguna</h5>
      <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $key => $user)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if(!empty($user->getRoleNames()))
                  @foreach($user->getRoleNames() as $v)
                    {{ $v }}
                  @endforeach
                @endif
              </td>
              <td>
                <a class="btn btn-info" href="{{ route('superadmin.users.show', $user->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('superadmin.users.edit', $user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['superadmin.users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    @csrf
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{!! $data->render() !!}

@endsection

@extends('admin.layouts.app')


@section('content')
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title"> </h3>
              <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="btn btn-success" href="{{ route('admin.users.create') }}"> Create New User</a>
                      </li>
                  </ul>
              </div>
          </div>

          <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif

            <table class="table table-bordered">
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
              </tr>
              @foreach ($data as $key => $user)
               <tr>
                 <td>{{ ++$i }}</td>
                 <td>{{ $user->name }}</td>
                 <td>{{ $user->email }}</td>
                 <td>
                   @if(!empty($user->getRoleNames()))
                     @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                     @endforeach
                   @endif
                 </td>
                 <td>
                    <a class="btn btn-info" href="{{ route('admin.users.detail',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id ) }}">Edit</a>
                     {!! Form::open(['method' => 'DELETE','route' => ['admin.users.delete', $user->id],'style'=>'display:inline']) !!}
                         {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                     {!! Form::close() !!}
                 </td>
               </tr>
              @endforeach
             </table>
          </div>
      </div>
  </div>
</div>

{!! $data->render() !!}

@endsection
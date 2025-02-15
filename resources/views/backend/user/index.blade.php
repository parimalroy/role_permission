@extends('backend.layout.app')

@section('content')
<div class="row">
<div class="row">
    <div class="col-md-9 bg-light ">
        <h2>User List</h2>
    </div>
    {{-- <div class="col-md-3 bg-light pull-right">
        <a href="{{route('role.create')}}" class="btn btn-primary">create </a>
    </div> --}}
    @include('../../message')
</div>
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Role</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th>
                <b>N</b>ame
              </th>
              <th >Email</th>
              <th >Role</th>
              <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($users->isNotEmpty())
            @foreach ($users as $user)
                
            
            <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->roles->pluck('name')->implode(', ')}}</td>
              <td>{{$user->created_at}}</td>
              <td class="center">
                @can('edit user')
                <span><a href="{{route('user.edit',$user->id)}}" class="bi  bi-pencil-square text-primary p-2"></a></span>
                @endcan
                
                <span><a href="" class="bi bi-trash text-danger p-2"></a></span>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>
@endsection
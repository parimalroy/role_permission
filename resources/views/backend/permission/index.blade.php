@extends('backend.layout.app')

@section('content')
<div class="row">
<div class="row">
    <div class="col-md-9 bg-light ">
        <h2>Permission List</h2>
    </div>
    <div class="col-md-3 bg-light pull-right">
        <a href="{{route('permission.create')}}" class="btn btn-primary">create permission</a>
    </div>
    @include('../../message')
</div>
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Permission</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th>
                <b>N</b>ame
              </th>
              <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($permissionLists->isNotEmpty())
            @foreach ($permissionLists as $permission)
                
            
            <tr>
              <td>{{$permission->name}}</td>
              <td>{{$permission->create_at}}</td>
              <td class="center">
                @can('edit permission')
                <span><a href="{{route('permission.edit',$permission->id)}}" class="bi  bi-pencil-square text-primary p-2"></a></span>
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
@extends('backend.layout.app');
@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body m-5">

                <form action="{{ route('role.store') }}" method="post" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Role</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        @if($permissions->isNotEmpty())
                        @foreach ($permissions as $permission )                                            
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="permission-{{$permission->id}}" name="permissions[]" value="{{$permission->name}}">
                            <label class="form-check-label"  for="permission-{{$permission->id}}">{{$permission->name}}</label>
                          </div>
                          @endforeach
                          @endif

                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('permission.index')}}" class="btn btn-danger">cancle</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

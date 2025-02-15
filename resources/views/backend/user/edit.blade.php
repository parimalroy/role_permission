@extends('backend.layout.app');
@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body m-5">

                <form action="{{route('user.update',$users->id)}}" method="post" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Role</label>
                        <input type="text" name="name" value="{{old('name',$users->name)}}" class="form-control @error('name') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Email</label>
                        <input type="text" name="email" value="{{old('email',$users->email)}}" class="form-control @error('email') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('email')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        @if($roles->isNotEmpty())
                        @foreach ($roles as $role )                                            
                        <div class="form-check form-check-inline">
                            {{-- {{($hasRole->contains($role->name))?'checked' : ''}} --}}
                            <input  {{($hasRole->contains($role->id))?'checked' : ''}} class="form-check-input" type="checkbox" id="role-{{$role->id}}" name="role[]" value="{{$role->name}}">
                            <label class="form-check-label"  for="role-{{$role->id}}">{{$role->name}}</label>
                          </div>
                          @endforeach
                          @endif

                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">update</button>
                        <a href="{{route('user.index')}}" class="btn btn-danger">cancle</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

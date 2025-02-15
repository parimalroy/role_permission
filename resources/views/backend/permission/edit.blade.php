@extends('backend.layout.app');
@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body m-5">

                <form action="{{ route('permission.update',$permission->id) }}" method="post" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Permission</label>
                        <input type="text" name="name" value="{{old('name',$permission->name)}}" class="form-control @error('name') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
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

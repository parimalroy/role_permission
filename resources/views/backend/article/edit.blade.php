@extends('backend.layout.app');
@section('content')
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body m-5">

                <form action="{{ route('article.update',$article->id) }}" method="post" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Title</label>
                        <input type="text" name="title" value="{{old('title',$article->title)}}" class="form-control @error('title') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('title')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Content</label>
                        <textarea name="content" class="form-control" id="" cols="30" rows="10">{{$article->content}}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Author</label>
                        <input type="text" name="author" value="{{old('author',$article->author)}}" class="form-control @error('author') 'is-invalid' @enderror"
                            id="inputNanme4">
                        @error('author')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('article.index')}}" class="btn btn-danger">cancle</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

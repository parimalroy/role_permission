@extends('backend.layout.app')

@section('content')
<div class="row">
<div class="row">
    <div class="col-md-9 bg-light ">
        <h2>Article List</h2>
    </div>
    <div class="col-md-3 bg-light pull-right">
        <a href="{{route('article.create')}}" class="btn btn-primary">create article</a>
    </div>
    @include('../../message')
</div>
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Article</h5>

        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th>
                Title
              <th>Content</th>
              <th>author</th>
              <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($articles->isNotEmpty())
            @foreach ($articles as $article)
                
            
            <tr>
              <td>{{$article->title}}</td>
              <td>{{$article->content}}</td>
              <td>{{$article->author}}</td>
              <td>{{$article->created_at}}</td>
              <td class="center">
                @can('edit article')
                <span><a href="{{route('article.edit',$article->id)}}" class="bi  bi-pencil-square text-primary p-2"></a></span>
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
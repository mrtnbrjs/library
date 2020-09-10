@extends('layouts.app')
@section('content')
<div class="row">
 <div class="col-sm-4 offset-sm-2">
    <h1 class="">Edit a Book</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="POST" action="{{ route('books.update',$book->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">    
                <label for="name">Title:</label>
                <input type="text" class="form-control" name="name" value="{{ $book->name }}"/>
            </div>
            <div class="form-group">    
                <label for="name">Author:</label>
                <input type="text" class="form-control" name="author" value="{{ $book->author }}"/>
            </div>
          
            <div class="form-group">
                <label for="description">Published date:</label>
                <input class="form-control" type="date" id="start" name="published_date" value="{{ $book->published_date }}">
            </div>  

            <div class="form-group">
                <label for="description">Category:</label>
                <select class="form-control" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
          <button type="submit" class="btn btn-primary">Edit Book</button>
      </form>
  </div>
</div>
</div>
@endsection
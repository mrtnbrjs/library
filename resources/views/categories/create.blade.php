@extends('layouts.app')
@section('content')
<div class="row">
 <div class="col-sm-4 offset-sm-3">
    <h1 class="">Add a Category</h1>
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
      <form method="post" action="{{ route('categories.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="description">Description:</label>
              <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
          </div>                         
          <button type="submit" class="btn btn-primary">Add category</button>
      </form>
  </div>
</div>
</div>
@endsection
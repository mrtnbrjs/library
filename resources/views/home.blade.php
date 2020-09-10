@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Books
                </div>
                <div class="card-body">
                    <div style="display: grid; list-style: none;">
                        <div class="col-xs-12">
                            <div class="float-right">
                                <a href="/create-category" class="f-right btn btn-primary" data-target="#exampleModal">Create Category</a>
                                <a href="/create-book" class="f-right btn btn-primary" data-target="#createBook">Create Book</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-12"></div>
                    </div>

                    <table style="margin-top: 30px" class="table table-bordered table-striped dataTableBooks">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Published date</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        {{--  <tbody>
                            @foreach ( $books as $book )
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>
                                        {{ $book->published_date }}
                                    </td>
                                    <td>
                                        {{ $book->category->name }}
                                    </td>
                                    
                                    @if (empty($book->user))
                                        <td class="freeBook">
                                            Available!!!
                                        </td>  
                                    @else
                                        <td class="takenBook">
                                            {{ $book->user->name }}
                                        </td>
                                    @endif
                                        
                                    
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                                        <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >Delete</button>
                                        </form>
                                        <button class="changeStatus btn btn-success" data-bookid="{{ $book->id }}" data-toggle="modal" data-target="#changeStatusModal">
                                            Change status
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>  --}}
                    </table>
                    {{ $books->links() }}
                      
                      <!-- Modal -->
                      <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="changeStatus" method="POST" action="">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="changeStatusLabel">Change status</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="description">Choose a user:</label>
                                            <select class="form-control" name="user_id">
                                                <option value="">Free</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                  </div>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

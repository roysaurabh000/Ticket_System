@extends('master')
@section('content')


<div class='row my-4'>
    <div class="col-xl-6">
        @if(Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success')}}
        </div>
        @elseif(Session::has('error'))
        <div class="alert alert-danger">
          {{ Session::get('error')}}
    </div>
    @endif

    </div> 
    <div class="col-6 text-end">
        <a href="{{route('todos.create')}}" class="btn btn-primary">Create TIcket</a>

    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>TicketID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($todos as $todo)
                <tr>
                    <td>{{$todo->id}}</td>
                    <td>{{$todo->name}}</td>
                    <td>{{$todo->description}}</td>
                    <td>{{$todo->is_completed ? 'completed' : 'Pending'}}</td>
                    <td>
                        <form action="{{route('todos.destroy',$todo->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                                <a href="{{route('todos.show',$todo->id)}}" class="btn btn-info"> View Ticket</a>
                                <a href="{{route('todos.edit',$todo->id)}}" class="btn btn-success"> Edit Ticket</a>
                                <button type="submit" onclick="return confirm('Are you sure you want to Delete this ticket?')" class="btn btn-danger"> Delete Ticket</button>
                        </form>
                    </td>

                </tr>

                
            @empty
            <tr>
                <td colspan="4"><p class="text-danger">No ticket found</p>
            </tr>
                
            @endforelse
            
</div>

@endsection
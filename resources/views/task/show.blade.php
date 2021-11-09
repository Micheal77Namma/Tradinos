@extends('layouts.app')

@section('content')
<div class="card" style="width: 18rem;">

    <div class="card-body">
        <h5 class="card-title">Create date:</h5>
        <p>{{$task->create_date}}</p>
        <h5 class="card-title">Sub Tasks :</h5>
        <p>{{$task->sub_task}}</p>
        <h5 class="card-title">End Flag :</h5>
        <p>{{$task->end_flag}}</p>
        <a href="/task" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection

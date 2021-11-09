
@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="card">
<div class="card-header">{{ __('Create Task') }}</div>
<form action="{{route('task.store')}}" method="POST">
    @csrf
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Task Description :</label></br>
            <div class="col-sm-10">
                <input name="task_description" type="text" placeholder="Enter task description" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Create Date :</label></br>
            <div class="col-sm-10">
                <input name="create_date" type="datetime-local" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
    <div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">Category :</label>
        <select class="form-select" id="exampleSelect1" name="category_id">
            @foreach ($categories as $c)
            <option value="{{$c->id}}"> {{$c->name}} </option>
            @endforeach
        </select>
    </div>
    </fieldset>
    </br>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Deadline :</label></br>
            <div class="col-sm-10">
                <input name="deadline" type="date" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Sub Tasks :</label></br>
            <div class="col-sm-10">
                <input name="sub_tasks" type="text" placeholder="Enter sub tasks" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">End Flag :</label></br>
            <div class="col-sm-10">
                <input name="end_flag" type="text" placeholder="Enter end flag" class="form-control">
            </div>
        </div>
    </fieldset>

    <div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">Assign to :</label>
        <select class="form-select" id="exampleSelect1" name="assign">
            @foreach ($users as $u)
            <option value="{{$u->id}}"> {{$c->name}} </option>
            @endforeach
        </select>
    </div>
    </br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection

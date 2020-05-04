@extends('layouts.app')

@section('style')
    <style>
        .form-group.required .control-label:after {
            content:" *";
            color:red;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Creare activitate</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('task.store')}}">
                            @csrf
                            <div class="form-group required">
                                <label for="title" class="control-label">Titlu</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" required="required" name="title">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Descriere</label>
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="optional"></textarea>
                            </div>
                            <div class="form-group required">
                                <label for="deadline" class="control-label">Deadline</label>
                                <div class="input-group date" id="deadline" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input  @error('deadline') is-invalid @enderror" data-target="#deadline" required="required" data-toggle="datetimepicker" name="deadline"/>
                                    <div class="input-group-append" data-target="#deadline" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('deadline')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group required">
                                <label for="priority" class="control-label">Prioritate</label>
                                <select id="priority" class="form-control" required="required" name="priority">
                                    @foreach($priorities as $single_priority)
                                        <option value="{{$single_priority->code}}" @if($single_priority->name === 'medie') selected="selected" @endif>
                                            {{$single_priority->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if(auth()->user()->can('add_any_task'))
                                <div class="form-group required">
                                    <label for="assignee" class="control-label">Atribuit</label>
                                    <select id="assignee" class="form-control"  required="required" name="assignee">
                                        @foreach($users as $single_user)
                                            <option value="{{$single_user->id}}">{{ $single_user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Creeaza</button>
                        </form>
                        @if(session('task_created'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('task_created')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function()
        {
            $(function(){
                $('#deadline').datetimepicker({
                    format: "L",
                    locale: "ro",
                });
            })
        });
    </script>
@endsection

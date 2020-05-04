@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <span>Echipa</span>
                        @if(auth()->user()->can('add_any_task'))
                            <a href="{{route('task.create')}}" class="btn btn-success float-right">Creeaza activitate</a>
                        @endif
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($users as $single_user)
                                <li class="list-group-item">
                                    <span class="float-left">{{$single_user->name}}</span>
                                    <span class="float-right">{{$single_user->roles->first()->name}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

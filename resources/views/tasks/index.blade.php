@extends('layouts.app')

@section('style')
    <style>
        .anyClass {
            height:600px;
            overflow-y: scroll;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <span>Toate activitatile</span>
                        <a href="{{route('task.create')}}" class="btn btn-success float-right"> Creeaza activitate </a>
                    </div>

                    <div class="card-body nav-pills anyClass">
                        @if(!$users->isEmpty())
                            <div>
                                <form class="form-inline" style="margin-bottom: 20px;">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Responsabil</label>
                                    <select class="custom-select my-1 mr-sm-2" id="user-filter">
                                        <option selected value="0">Toti</option>
                                        @foreach($users as $single_user)
                                            <option value="{{$single_user->id}}">{{$single_user->name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        @endif
                        @if(!$tasks->isEmpty())
                            <div id="wrapper">
                                @include("tasks.partial")
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
            $(document).on("click", "#delete-task-btn", function (e) {
                e.preventDefault();

                let task_id = $(this).data('id');

                console.log('task_od', task_id);
                Swal.fire({
                    title: '',
                    text: "Sigur vrei sa stergi aceasta activitate?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Da',
                    cancelButtonText: 'Nu',
                }).then((result) => {
                    if (result.value) {
                        $('#delete-task-' + task_id).submit();
                    }
                })
            });

            function filter()
            {
                $.post("{{ URL::route('filter.user') }}",
                    {
                        resp_id: $("#user-filter").val(),
                        _token: "{{ csrf_token() }}"
                    }, function (data)
                    {
                        let obj = JSON.parse(data);

                        $("#wrapper").html(obj.data);
                    });
            }

            $(document).on('change', '#user-filter', function(e)
            {
                e.preventDefault();

                filter();
            });
        });
    </script>
@stop

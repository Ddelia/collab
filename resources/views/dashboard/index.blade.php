@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <span>Dashboard</span>
                    <a href="{{route('task.create')}}" class="btn btn-success float-right"> Creeaza activitate </a>
                </div>

                <div class="card-body">
                    <form class="form-inline" style="margin-bottom: 20px;">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Deadline</label>
                        <select class="custom-select my-1 mr-sm-2" id="deadline-filter">
                            <option selected value="0">ascendent</option>
                            <option value="1">descendent</option>
                        </select>

                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Prioritate</label>
                        <select class="custom-select my-1 mr-sm-2" id="priority-filter">
                            <option value="0" selected="selected">default</option>
                            @foreach($priorities as $single_priority)
                                <option value="{{$single_priority->code}}">
                                    {{$single_priority->name}}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    @if(!$tasks->isEmpty())
                        <div id="wrapper">
                            @include("dashboard.partial")
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
                $.post("{{ URL::route('filter') }}",
                    {
                        priority: $("#priority-filter").val(),
                        deadline: $("#deadline-filter").val(),
                        _token: "{{ csrf_token() }}"
                    }, function (data)
                    {
                        let obj = JSON.parse(data);

                        $("#wrapper").html(obj.data);
                    });
            }

            $(document).on('change', '#priority-filter', function(e)
            {
                e.preventDefault();

                filter();
            });

            $(document).on('change', '#deadline-filter', function(e)
            {
                e.preventDefault();

                filter();
            });
        });
    </script>
@stop

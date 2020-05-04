@foreach($tasks as $single_task)
    <div class="card @if($single_task->deadline <= date('Y-m-d', time())) border-danger @else border-success @endif nav-item">
        <div class="card-header">
            <p class="float-left font-weight-bold"><i class="fa fa-calendar"></i> Deadline: {{format_ro_date($single_task->deadline)}}</p>
            <p class="float-right ">Prioritate: {{$single_task->priority->name}}</p>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$single_task->title}}</h5>
            <p class="card-text">{{$single_task->description}}</p>

            @if(auth()->user()->id === $single_task->owner_id)
                <div>
                    <form id="delete-task-{{$single_task->id}}" method="POST" action="{{route('task.delete', array('id' => $single_task->id))}}" class="float-right">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" data-id="{{$single_task->id}}" id="delete-task-btn">Sterge</button>
                    </form>
                </div>
            @endif
            <h5><span class="badge badge-success text-white float-left">Responsabil: {{$single_task->resp->name}}</span></h5>
            <br>
            <h6><span class="badge badge-success text-white float-left">Owner: {{$single_task->owner->name}}</span></h6>
        </div>
    </div>
    <br>
@endforeach

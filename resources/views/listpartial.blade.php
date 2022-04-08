<h1 class="text-center">Task List</h1>
<table id="tasklist" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sr</th>
            <th>Title</th>
            <th>Description</th>
            <th>Deadline</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                @if(Carbon\Carbon::now()->timezone($timezone) <= $item->deadline)
                <td class="text-success">{{$item->deadline}}</td>
                @else
                <td class="text-danger">{{$item->deadline}}</td>
                <div class="alert alert-danger">
                   Task Deadline Expired : {{"Title: ".$item->title." Deadline: ".$item->deadline}}
                </div>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>

</head>
<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-10 mx-auto" id="list">
                    <h1 class="text-center">Task List</h1>
                    <div id="deadline_alert"> </div>
                    <table id="tasklist" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody id="task_body">
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        var row = '';
        var deadline_div = '';
        $.ajax({
                type: "get",
                url: "{{route('tasklistrendor')}}",
                success: function (response) {
                    
                    $.each(response,function(i,e){
                        moment.tz.setDefault(e.timezone);
                        console.log( moment(e.deadline).format('LLL')) ;
                        var deadline = moment(e.deadline).utc().local().format('LLL');
                        row += `<tr> <td>${e.id}</td><td>${e.title}</td><td>${e.description}</td>`;
                        if(new Date() <=new Date( moment(e.deadline).utc().local().format('YYYY-M-D h:m a')))
                        {
                            row += `<td class="text-success">${deadline} <button class="btn btn-success btn-sm float-right">Submit</button></td> </tr>`;
                        }
                        else
                        {
                            row += `<td class="text-danger">${deadline}</td> </tr>`;
                            deadline_div += `<div class="alert alert-danger">
                   Task Deadline Expired : Title: ${e.title} Deadline: ${e.deadline}
                </div>`;
                        }
                    })
                    $('#task_body').html(row);
                    $('#deadline_alert').html(deadline_div);
                }
            });
    })
</script>
</body>
</html>

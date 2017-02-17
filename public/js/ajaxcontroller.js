/**
 * Created by root on 2/17/17.
 */

var url = "api/task";
$.ajax({
    type: 'GET',
    url: url+'/all',
    dataType: 'json',
    success: function (data) {

        data.forEach(function(task) {
            var html = '<tr id="task' + task.id + '"><td>' + task.id + '</td><td>' + task.parent_id + '</td><td>' + task.status + '</td><td>' + task.created_at + '</td>';
            html+= '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + task.id + '">Edit</button>';
            html += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + task.id + '">Delete</button></td></tr>';
            $('#task-list').append(html);
        });

    },
    error: function (data) {
        console.log('Error:', data);
    }
});

$(document).ready(function(){


    $('#dataTables-example').DataTable({
        responsive: true
    });
    //display modal form for task editing
    $('.open-modal').click(function(){
        var task_id = $(this).val();

        $.get(url + '/' + task_id, function (data) {
            //success data
            console.log(data);
            $('#task_id').val(data.id);
            $('#task').val(data.task);
            $('#description').val(data.description);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        })
    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-task').click(function(){
        var task_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + task_id,
            success: function (data) {
                console.log(data);

                $("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();

        var formData = {
            task: $('#task').val(),
            description: $('#description').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var task_id = $('#task_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + task_id;
        }

        console.log(formData);
        console.log('aha');


    });
});
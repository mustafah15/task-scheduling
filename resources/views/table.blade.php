
@extends('base')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tasks Status</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="tasks-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Parent</th>
                        <th>Complete / In progress</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody id="task-list" >

                    </tbody>
                </table>
                <!-- /.table-responsive -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New Task</button>
                </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form id="new-task" >
                    <div class="form-group">
                        <label title="title">Task Tilte</label>
                        <input id="task_title" class="form-control" type="text" required name="title">
                    </div>
                    <div class="form-group">
                        <label title="parent_id">Task Parent</label>
                        <input id="parent_id" type="number" class="form-control" min="0"  value="0" name="parent_id">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" onclick="newtask()">submit</a>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>

        var tasks_table =$('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('get-all-tasks') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'parent_id', name: 'parent_id' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false}

            ]
        });


       function newtask() {
            $.ajax({
                url: '{!! route ('post-create-new-task') !!}',
                type: 'POST',
                data: {
                    parent_id:$('#parent_id').val(),
                    title: $('#task_title').val()
                },
                success: function () {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    tasks_table.ajax.url( '{!! route('get-all-tasks') !!}' ).load();
                }
            });
        }

        function done (id) {
            $.ajax({
                url:"{!! route('post-to-done') !!}",
                type: "POST",
                data:{
                    task_id:id
                },
                success:function(result){
                    tasks_table.ajax.url( '{!! route('get-all-tasks') !!}' ).load();
                }
            });

        }

        function inprogress(id) {
            $.ajax({
                url:"{!! route('post-to-inprogress') !!}",
                type: "POST",
                data:{
                    task_id:id
                },
                success:function(result){
                    tasks_table.ajax.url( '{!! route('get-all-tasks') !!}' ).load();
                }
            });
        }
</script>
@endpush
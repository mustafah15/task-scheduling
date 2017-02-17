
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

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>

<a class="btn  btn-success" href="task/create">create task</a><br>
<br>
<table id="table_id" class="table table-dark">
<thead>
<th>description</th>
<th>deadline</th>
<th>categories</th>
<th>assign</th>
<th>action</th>
</thead>
<tbody>
</tbody>
</table>


<script>
$(document).ready( function () {
    $('#table_id').DataTable(
	{
		processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('task-pagination') }}",
		},
        columns: [
            {data:'description'},
            {data:'deadline'},
            {data:'categories'},
            {data:'assign'},
            {data:'action'},
        ],
    })
} );
</script>

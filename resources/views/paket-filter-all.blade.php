<html>
<head>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <title>Laravel 5.8 Tutorial - Datatables Individual Column Searching using Ajax</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link   rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link   rel = "stylesheet" href = "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class = "container">
        <br />
            <h3 align = "center">Paket Filter</h3>
        <br />        
        <div class="">
            <select name  = "balai_filter" id = "balai_filter" class = "form-control">
                <option value = "">Select Balai</option>
                    @foreach($databalai as $row)
                        <option value = "{{ $row->id }}">{{ $row->nmbalai }}</option>
                    @endforeach
            </select>
        </div>
        <div   class = "table-responsive">
            <table class = "table table-bordered table-striped" id = "paket_table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Paket</th>
                        <th>Pagu</th>
                        {{-- <th>Keuangan</th> --}}
                        {{-- <th>Progres Fisik</th> --}}
                        {{-- <th>       
                        </th>       --}}
                    </tr>
                </thead>
            </table>
        </div>
        <br />
        <br />
    </div>
</body>
</html>
<script>

$(document).ready(function(){
fetch_data();
function fetch_data(databalai = '')
{
    $('#paket_table').DataTable({
        processing: true,
        serverSide: true,
        ajax      : {
            url : "{{ route('column-balai') }}",
            data: {databalai:databalai}
        },
        columns:[
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'nmbalai',
                name: 'nmbalai'
            },
            {
                data: 'nmsatker',
                name: 'nmsatker'
            }
            // {
            //     data: 'keuangan',
            //     name: 'keuangan'
            // },
            // {
            //     data: 'progres_fisik',
            //     name: 'progres_fisik'
            // }
            // {
                //  data: 'nmoutput',
                //  name: 'nmoutput',
                //  orderable: false
            // }
        ]
        });
}
$('#balai_filter').change(function(){
        var databalai = $('#balai_filter').val();
        $('#paket_table').DataTable().destroy();
        fetch_data(databalai);
    });
});
</script>
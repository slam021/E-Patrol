@inject('CorePatrolReport', 'App\Http\Controllers\CorePatrolReportController')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Image</title>
</head>
<body>
        <form action="{{ url('/patrol-report/upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image"> 
            <input type="submit" value="Upload"/>
        </form>
</body>
<div class="card-body">
    <div class="table-responsive">
        <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
            <thead>
                <tr>
                    <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                    <th width="3%" style='text-align:center'>No</th>
                    <th width="10%" style='text-align:center'>Foto</th>
                    <th width="7%" style='text-align:center'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patrolreports as $index => $patrol)
                <tr>
                    <td style='text-align:center'>{{ $index + 1 }}.</td>
                    {{-- <td>{{$patrol['photos']}}</td> --}}
                    <td><img width="150px" src="{{ url('/images/'.$patrol->photos) }}"></td>
                    <td>
                        <div class="text-center">
                            <a type="button" class="btn btn-warning btn-sm" href="" title="Edit"><i class="far fa-edit"></i> Edit</a>
                            <a type="button" class="btn btn-danger btn-sm" href="" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</html>
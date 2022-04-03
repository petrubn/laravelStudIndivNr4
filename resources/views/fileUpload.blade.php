<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 File Upload Step by Step Example - Nicesnippets.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
       
    <div class="panel panel-primary">
  
        <div class="panel-heading text-center mt-5">
            <h2>Laravel 9 File Upload Step by Step Example - Nicesnippets.com</h2>
        </div>
  
        <div class="panel-body mt-5">
       
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
      
            <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
      
                <div class="mb-3">
                    <label class="form-label" for="inputFile">Select File:</label>
                    <input 
                        type="file" 
                        name="file" 
                        id="inputFile"
                        class="form-control @error('file') is-invalid @enderror">
      
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
       
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
           
            </form>
      
        </div>
    </div>
</div>


    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Original Name</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file->id }}</td>
                <td>{{ $file->name }}</td>
                <td>{{ $file->originalName }}</td>
                <td>{{ $file->type }}</td>
                <td>
                    <form action="{{ route('file.destroy', $file->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('file.edit', $file->id) }}">Download</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


</body>
</html>
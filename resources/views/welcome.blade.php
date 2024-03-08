@extends('layouts.partials.master')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Display error messages -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaA6Dh" crossorigin="anonymous"></script>

<!-- Include Bootstrap JavaScript and Popper.js CDN links -->
<div class="row">
    <div class="col-md-12 d-flex justify-content-end p-3">
        <button type="button" onclick="openModal()" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Add New Blog
        </button>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('add-blog')}}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" name="name" class="form-control" id="username" placeholder="Enter User Name">
                    </div>
                    <div class="form-group">
                        <label for="user_status">Select Status</label>
                        <select name="status" id="user_status" class="form-control">
                            <option disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="submitForm()" id="adduser">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<div class="container">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">List of Blogs</h5>
        
        <!-- Your blog list code goes here -->
        <table class="table">
            <!-- Table headers and rows go here -->
        </table>
    </div>
</div>

<div class="row">
<div class="row">
    <div class="col-md-3">
    <form method="GET" action="{{ route('home') }}">
    <!-- <label for="status">Filter by Status:</label> -->
    <select name="status" id="status" onchange="this.form.submit()" class="form-control">
    <option selected >Apply filter</option>
        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
        <option value="1" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</form>
    </div>
    <div class="col-md-3">
    <form method="GET" action="{{ route('home') }}" class="form-inline">
    <!-- <label for="perPage">Items per page:</label> -->
    <select name="perPage" id="perPage" onchange="this.form.submit()" class="form-control">
    <Option selected disabled >Items Per Page</Option>
        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
        <!-- Add more options as needed -->
    </select>
</form>
    </div>
    <div class="col-md-6 d-flex">
        <!-- <form action="{{ url('/') }}" method="GET" class="form-inline w-100">
            @csrf
            <div class="d-flex">
                <input type="text" name="search" placeholder="Search..." class="form-control flex-grow-1 mr-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form> -->
        <form action="{{ url('/') }}" method="GET" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="search" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
    </div>
</div>

</div>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $key => $blog)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$blog->name}}</td>
                <td>
                    @if($blog->status == 1)
                    <span class="badge badge-success">Active</span>
                    <a href="{{ route('update.status', ['id' => $blog->id, 'status' => 0]) }}" class="btn btn-primary">Active</a>
                    @else
                    <span class="badge badge-secondary">Inactive</span>
                    <a href="{{ route('update.status', ['id' => $blog->id, 'status' => 1]) }}" class="btn btn-danger">Inactive</a>
                    @endif
                </td>
                <td><a href="{{ route('edit-blog', ['id' => $blog->id]) }}"><button class="btn btn-primary">Edit</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    // Function to open the modal
    function openModal() {
        // Get the modal element by its ID
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));

        // Open the modal
        myModal.show();
    }

    $(document).on('click', '.add-clouser', function(e) {
        e.preventDefault();
        var projetc_id = $(this).val();
        /* alert(projetc_id); */
        $('#username').val(projetc_id);
        $(".inputs input").val("")
        $('#clouser-add').modal('show');
    });

    $(document).ready(function() {
        function submitForm() {
            // Get form data
            var formData = {
                name: $('#username').val(),
                status: $('#user_status').val(),
                _token: $('input[name="_token"]').val(), // Laravel CSRF token
            };
            console.log(formData);

            // Ajax request
            $.ajax({
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function (data) {
                    // Handle success
                    console.log(data);

                    // Check the response and take appropriate action
                    if (data.success) {
                        // Successful submission
                        alert(data.message);
                    } else {
                        // Handle other cases
                        alert('Submission failed');
                    }
                },
                error: function (error) {
                    // Handle error
                    console.log(error);
                    alert('Error occurred during submission');
                }
            });
        }
    });

    function submitForm() {
        // Get form data
        var formData = {
            name: $('#username').val(),
            status: $('#user_status').val(),
            _token: $('input[name="_token"]').val(), // Laravel CSRF token
        };
        console.log(formData);

        // Ajax request
        $.ajax({
            type: 'POST',
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function (data) {
                // Handle success
                console.log(data);

                // Check the response and take appropriate action
                if (data.success) {
                    // Successful submission
                    alert(data.message);
                } else {
                    // Handle other cases
                    alert('Submission failed');
                }
            },
            error: function (error) {
                // Handle error
                console.log(error);
                alert('Error occurred during submission');
            }
        });
    }
</script>
@endsection

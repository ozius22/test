@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Room
                                <a href="{{url('admin/rooms')}}" class="float-right btn btn-success btn-sm">View All</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <form method="post" action="{{url('admin/rooms')}}">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Select Room Type</th>
                                            <td>
<input type="text" id="searchInput" placeholder="Search...">
<select name="rt_id" class="form-control" id="roomTypeSelect">
    <option value="0">--- Select ---</option>
    @foreach($roomtypes as $rt)
        <option value="{{ $rt->id }}">{{ $rt->title }}</option>
    @endforeach
</select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td><input name="title" type="text" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="submit" class="btn btn-primary" />
                                            </td> 
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->


<script>
    var roomTypes = @json($roomtypes);

    // Get the input field and select element
    var input = document.getElementById('searchInput');
    var select = document.getElementById('roomTypeSelect');

    // Add event listener for input changes
    input.addEventListener('input', function() {
        var filter = input.value.toLowerCase();

        // Clear all options except the default one
        for (var i = select.options.length - 1; i > 0; i--) {
            select.remove(i);
        }

        // Filter room types and add matching options
        roomTypes.forEach(function(rt) {
            if (rt.title.toLowerCase().includes(filter)) {
                var option = new Option(rt.title, rt.id);
                select.add(option);
            }
        });
    });

</script>
@endsection
@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Reservations
                                <a href="{{url('admin/reservation/create')}}" class="float-right btn btn-success btn-sm">Add New</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Guest</th>
                                            <th>Room No.</th>
                                            <th>Room Type</th>
                                            <th>CheckIn Date</th>
                                            <th>CheckOut Date</th>
                                            <th>Ref</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>Room No.</th>
                                            <th>Room Type</th>
                                            <th>CheckIn Date</th>
                                            <th>CheckOut Date</th>
                                            <th>Ref</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $reservation)
                                        <tr>
                                            <td>{{$reservation->id}}</td>
                                            <td>{{$reservation->guest->full_name}}</td>
                                            <td>{{$reservation->room->title}}</td>
                                            <td>{{$reservation->room->Roomtype->title}}</td>
                                            <td>{{$reservation->checkin_date}}</td>
                                            <td>{{$reservation->checkout_date}}</td>
                                            <td>{{$reservation->ref}}</td>
                                            <td><a href="{{url('admin/reservation/'.$reservation->id.'/delete')}}" class="text-danger" onclick="return confirm('Are you sure you want to delete this data?')"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@section('scripts')
<!-- Custom styles for this page -->
<link href="{{asset('')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="{{asset('')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('')}}/js/demo/datatables-demo.js"></script>

@endsection

@endsection
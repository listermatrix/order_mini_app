@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0 ">SYSTEM USERS</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('system.users.create')}}" class="btn btn-sm btn-neutral btn-round btn-icon" data-toggle="tooltip" data-original-title="ADD USERS">
                                <span class="btn-inner--icon"><i class="fas fa-user-edit"></i></span>
                                <span class="btn-inner--text">Add</span>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <br>
                            @if (\Session::has('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Great!</strong> {!! \Session::get('success') !!}!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    {!!$dataTable->table(['id'=>'datatable-buttons'])!!}
                    {{--{!!$dataTable->table()!!}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
@endpush


@push('datatables')

    <script src="{{asset('js/news.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
@endpush

@push('scripts')

    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {!! $dataTable->scripts() !!}




    <!--suppress JSJQueryEfficiency -->
    <script>
        $('#datatable-buttons').on('click','.link-delete',function (t) {
            t.preventDefault();
            let route = $(this).attr('href');

            swal({
                    title: "Are you sure?",
                    text: "Think about it. This data could be relevant in the future!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, keep it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                         window.location.replace(route);
                    } else {
                        swal("Whoa!", "That was close :)", "error");
                    }
                });


        });


    </script>
@endpush

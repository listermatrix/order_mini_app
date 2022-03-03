@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0 ">Exchange Rates</h3>
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

                            @if (count($errors) > 0)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong>.</li>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $currency)
                                <tr>
                                    <td> {{$currency->name ?? ''}}</td>
                                    <td> {{$currency->code ?? ''}}</td>
                                    <td> {{$currency->created_at}}</td>
                                    <td> {{$currency->updated_at}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href=""><i class="fas fa-pencil-alt"></i></a>
                                        <a class="btn btn-danger btn-sm" href=""><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">
                                    <i class="fas fa-angle-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-angle-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
    {{--<script src="{{asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>--}}
    {{--<script src="{{asset('vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>--}}
    {{--<script src="{{asset('vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>--}}
    {{--<script src="{{asset('vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>--}}
    <script src="{{asset('vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
@endpush

@push('scripts')

    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
{{--    {!! $dataTable->scripts() !!}--}}




    <!--suppress JSJQueryEfficiency -->
    <script>
        $('#datatable-buttons').addClass('table-flush');
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
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        $.get(route,function (data) {
                            console.log(data);
                        }).then(function () {
                            setTimeout(function () {
                                swal.close();
                            },2000)
                        }).then(function () {
                            reload()
                        })
                    } else {
                        swal("Whoa!", "That was close :)", "error");
                    }
                });

            function reload() {
                setTimeout(function () {
                    window.location.reload();
                },2000)
            }

        });
        $('#datatable-buttons').on('click','.link-archive',function (t) {
            t.preventDefault();
            let route = $(this).attr('href');

            swal({
                    title: "Are you sure?",
                    text: "You are about to archive this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, archive it!",
                    cancelButtonText: "No, keep it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("Archived!", "Record has been successfully archived", "success");
                        $.get(route,function (data) {
                            console.log(data);
                        }).then(function () {
                            setTimeout(function () {
                                swal.close();
                            },2000)
                        }).then(function () {
                            reload()
                        })
                    } else {
                        swal("Whoa!", "That was close :)", "error");
                    }
                });

            function reload() {
                setTimeout(function () {
                    window.location.reload();
                },2000)
            }

        })

    </script>
@endpush

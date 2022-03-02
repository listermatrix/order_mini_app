@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0 ">Applicant Report</h3>
                            <br>
                        </div>
                            <div class="col-lg-12">
                                <form method="get">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                        <label for="example-text-input" class="col-md-4 col-form-label form-control-label">ADMISSION TYPE</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control select" id="type">
                                                            <option></option>
                                                            <option value="masters">Masters</option>
                                                            <option value="undergraduate">Undergraduate</option>
                                                            <option value="diploma">Diploma</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 program">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="lead" class="col-md-4 col-form-label form-control-label">PROGRAM</label>
                                                    <div class="col-md-8">
                                                        @php $value = null @endphp
                                                        <select class="form-control select" id="program">
                                                            <option></option>
                                                            <option value="BSc. COMPUTER SCIENCE" {{$value == 'BSc. COMPUTER SCIENCE' ? 'selected' : ''}}>Bsc. COMPUTER SCIENCE</option>
                                                            <option value="BSc. INFORMATION SYSTEMS SCIENCES" {{$value == 'BSc. INFORMATION SYSTEMS SCIENCES' ? 'selected' : ''}}>Bsc. INFORMATION SYSTEMS SCIENCES</option>
                                                            <option value="BEng. APPLIED ELECTRONICS" {{$value == 'BEng. APPLIED ELECTRONICS' ? 'selected' : ''}}>BEng. APPLIED ELECTRONICS</option>
                                                            <option value="BSc. MANAGEMENT WITH COMPUTING" {{$value == 'BSc. MANAGEMENT WITH COMPUTING' ? 'selected' : ''}}>BSc. MANAGEMENT WITH COMPUTING</option>
                                                            <option value="BSc. BANKING AND FINANCE" {{$value == 'BSc. BANKING AND FINANCE' ? 'selected' : ''}}>BSc. BANKING AND FINANCE</option>
                                                            <option value="BSc. ECONOMICS WITH COMPUTING" {{$value == 'BSc. ECONOMICS WITH COMPUTING' ? 'selected' : ''}}>BSc. ECONOMICS WITH COMPUTING</option>
                                                            <option value="BSc. ACCOUNTING WITH INFORMATION SYSTEMS" {{$value == 'BSc. ACCOUNTING WITH INFORMATION SYSTEMS' ? 'selected' : ''}}>BSc. ACCOUNTING WITH INFORMATION SYSTEMS</option>
                                                            <option value="BBa. E-COMMERCE" {{$value == 'BBa. E-COMMERCE' ? 'selected' : ''}}>BBa. E-COMMERCE</option>
                                                            <option value="BSc. PSYCHOLOGY" {{$value == 'BSc. PSYCHOLOGY' ? 'selected' : ''}}>BSc. PSYCHOLOGY</option>
                                                            <option value="BSc. THEOLOGY" {{$value == 'BSc. THEOLOGY' ? 'selected' : ''}}>BSc. THEOLOGY</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="lead" class="col-md-4 col-form-label form-control-label">STATUS</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control select" id="status">
                                                            <option></option>
                                                            <option value="PENDING">PENDING</option>
                                                            <option value="REJECTED">REJECTED</option>
                                                            <option value="APPROVED">APPROVED</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="lead" class="col-md-4 col-form-label form-control-label">FROM</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="from" class="form-control datetime">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="lead" class="col-md-4  col-form-label form-control-label">TO</label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="to" class="form-control datetime">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <button class="btn btn-sm btn-default" id="generate">
                                                <i class="fa fa-book-open"></i>   Generate
                                            </button>
                                        </div>
                                    </div>



                                </form>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive py-4">
                                {!!$dataTable->table(['id'=>'datatable-buttons'])!!}
                            </div>
                        </div>
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

    <script>
        $('.datetime').datepicker();
        $('#datatable-buttons').addClass('table-flush');
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
    <script>
        $('#type').on('change',function () {
            let value = $(this).val();
            if (value === 'masters')
            {
                $('.program').hide()
            }
            else {
                $('.program').show()
            }

        })
    </script>
    <script>
        $('#datatable-buttons').on('preXhr.dt', function (e, settings, data) {
                data.type           = $('#type').val();
                data.program        = $('#program').val();
                data.status         = $('#status').val();
                data.from           = $('#from').val();
                data.to             = $('#to').val();
            });

          $('#generate').on('click',function (t) {
            t.preventDefault();
             $('#datatable-buttons').DataTable().ajax.reload();
            return false;

        })
    </script>
@endpush

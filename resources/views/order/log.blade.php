@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0 ">Logs for Order  #{{$order->order_no}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" href="{{url()->previous()}}" ><i class="fa fa-arrow-left"></i> Go back</a>
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
                    <div class="table-responsive">
                        <table id="dataTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">TIME</th>
                                <th scope="col">ORDER_NO</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">MESSAGE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->logs as $log)
                                <tr>
                                    <td> {{ $log->created_at->format('Y-m-d') .' at ' . $log->created_at->format('H:i:s')}}</td>
                                    <td># {{$log->order->order_no }}</td>
                                    <td> {{ $log->status}}</td>
                                    <td> {!! $log->message  !!}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endpush



@push('scripts')
    <script src="{{asset('js/news.js  ')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#dataTable').DataTable({
            "order": [[1, 'desc']]
        });
    </script>
@endpush

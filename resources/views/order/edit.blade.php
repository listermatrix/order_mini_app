@php $dep_id = (int)auth()->user()->department_id  @endphp
@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0 ">ORDER</h3>
                        </div>
                        <div class="col-6 text-right">
                        </div>
                        <div class="col-md-12">
                            <br>
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

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Great!</strong> {!! Session::get('success') !!}!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="user" class="col-md-4 col-form-label form-control-label">ORDER NO.</label>
                                            <div class="col-md-8">
                                                <input class="form-control"   value="#{{$order->order_no}}" readonly>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">DATE</label>
                                        <div class="col-md-8">
                                            <input class="form-control"   value="{{$order->date}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">AMOUNT</label>
                                        <div class="col-md-8">
                                            <input class="form-control"  id="amount"  value="{{number_format($order->amount,2)}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">SHIPPING COMPANY</label>
                                        <div class="col-md-8">
                                            <input class="form-control"  name="shipping_company"   value="{{old('shipping_company',$order->shipping_company)}}" {{$order->status == 'ORDER_READY_TO_SHIP' ? '' : 'readonly' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">SHIPPING TRACKING NUMBER</label>
                                        <div class="col-md-8">
                                            <input class="form-control"  name="shipping_tracking_number"  value="{{old('shipping_tracking_number',$order->shipping_tracking_number)}}" {{$order->status == 'ORDER_READY_TO_SHIP' ? '' : 'readonly' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">SHIPPING LABEL</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="file" accept="application/pdf" name="shipping_label"   {{$order->status == 'ORDER_READY_TO_SHIP' ? '' : 'readonly' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="amount" class="col-md-4 col-form-label form-control-label">STATUS</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="status"  value="{{$order->status}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="picking_product" class="col-md-4 col-form-label form-control-label">Picking products</label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="picking_product" data-toggle="select"  id="picking_product">
                                                <option {{$order->picking_product == "No"  ? "selected" : ''}}>No</option>
                                                <option {{$order->picking_product == "Yes"  ? "selected" : ''}}>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="input-group input-group-merge">
                                        <label for="box_id" class="col-md-4 col-form-label form-control-label">BOX ID</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="box_id" id="box_id" placeholder="INPUT OR IGNORE TO AUTO GENERATE"  value="{{$order->box_id}}" {{$order->status == 'ORDER_READY_TO_SHIP' ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>


                        <div class="table-responsive py-4">
                            <div class="table-responsive">
                                <table id="dataTable" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">NAME</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col">QUANTITY</th>
                                        <th scope="col">DESCRIPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(json_decode($order->items) as $item)
                                        <tr>
                                            <td> {{@$item->name }}</td>
                                            <td> {{ number_format(@$item->price,2)}}</td>
                                            <td> {{ @$item->quantity}}</td>
                                            <td> {{ @$item->description}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        @if($dep_id !== 3)
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  my-4">{{$order->status =='ORDER_READY_TO_SHIP' ? 'PROCESS SHIPMENT' : 'PROCEED'}} <i class="far fa-paper-plane"></i></button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endpush



@push('scripts')
    <script src="{{asset('js/news.js')}}"></script>
    <script src="{{asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#dataTable').DataTable({
            // "order": [[6, 'asc']]
        });
    </script>
@endpush



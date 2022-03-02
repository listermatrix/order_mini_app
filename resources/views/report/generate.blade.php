@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="mb-0 ">Applicant Report Generation</h3>
                        <hr>
                        </div>
                            <div class="col-lg-12">
                                <form method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="lead" class="col-md-4 col-form-label form-control-label">FROM</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control datetime" id="from" name="from" value="{{old('date')}}"  type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="input-group input-group-merge">
                                                    <label for="to" class="col-md-4 col-form-label form-control-label">TO</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control datetime" id="to" name="to" value="{{old('date')}}"  type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                                <button class="btn btn- btn-default" id="generate">
                                                    <i class="fa fa-book-open"></i>   Generate
                                                </button>
                                        </div>
                                    </div>



                                </form>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive py-4">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection

@push('scripts')
<script>
    $('.datetime').datepicker();
</script>


@endpush

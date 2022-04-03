@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                        <h3 class="mb-0 ">SEND MONEY</h3>
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
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="user" class="col-md-4 col-form-label form-control-label">RECEIVING USER</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="receiving_user[]" data-toggle="select"  id="user" multiple>
                                                    <option></option>
{{--                                                    @foreach($data->users as $user)--}}
{{--                                                        <option value="{{$user->id}}" {{ in_array($user->id,old('receiving_user')??[])  ? 'selected' : ''}}>{{$user->getFullNameAttribute()}}</option>--}}
{{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="account_id" class="col-md-4 col-form-label form-control-label">SOURCE ACCOUNT</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="account_id" data-toggle="select"  id="account_id">
                                                    <option></option>
{{--                                                    @foreach($data->accounts as $account)--}}
{{--                                                        <option value="{{$account->id}}" {{old('account_id') == $account->id ? 'selected' : ''}}>{{$account->name}} - {{$account->balance}}</option>--}}
{{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="amount" class="col-md-4 col-form-label form-control-label">TRANSFER AMOUNT</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="amount"  id="amount" min="1"  value="1" step="0.01" placeholder="Amount" type="number">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="currency" class="col-md-4 col-form-label form-control-label">TARGET CURRENCY</label>
                                            <div class="col-md-8">
                                                <select class="form-control" name="target_currency" data-toggle="select"  id="currency">
                                                    <option></option>
{{--                                                    @foreach($data->currencies as $currency)--}}
{{--                                                        <option value="{{$currency->id}}" {{old('target_currency') == $currency->id ? 'selected' : ''}}>{{$currency->code}}</option>--}}
{{--                                                    @endforeach--}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary  my-4">Proceed <i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#approval').on('change',function (e) {
            let value = $(this).val();

            if(value === 'Rejected')
            {
                $('#comment').removeClass('invisible')
            }
            else {
                $('#comment').addClass('invisible')
            }

        })
    </script>

    @endpush



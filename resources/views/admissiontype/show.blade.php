@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Apply To: <i>{{ $type->name }}</i></div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admission.apply', $type->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p id="name" type="text"  class="form-control-plaintext" name="name" >
                                    {{ $type->name }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <p id="description" name="description" class="form-control-plaintext">@php echo  nl2br($type->description) @endphp</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="datum" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="datum" name="datum" />
                                </div>
                            </div>

                            <div class="vreme">

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" >
        var today = new Date().toLocaleString('sr');
        window.onload = function() {
            $('#datum').datepicker({
                format: "dd.mm.yyyy.",
                weekStart: 1,
                maxViewMode: 2,
                todayBtn: "linked",
                daysOfWeekDisabled: "0,6",
                autoclose: true,
                todayHighlight: true,
                startDate: today,
            }).on('change Date', function(e) {
                var datum = e.currentTarget.value;
                $.ajax({
                    url: '{{ route('admission.ajax', $type->id) }}/' + datum,
                }).done(function(data) {
                    console.log(data);
                    var response = JSON.parse(data);
                    // check if we already have some values set
                    // if so, clear them
                    if ($('.vreme').length) {
                        $('.vreme').empty()
                    }
                    if ($('.invalid-feedback').length) {
                        $('.invalid-feedback').remove();
                    }
                    // append options to select appropriate time
                    if (response.datum.length > 0) {
                        $('.vreme').append("<div class=\"form-group row\"><label for=\"vreme\" class=\"col-md-4 col-form-label text-md-right\">Time<\/label><div class=\"col-md-2\"><select name=\"vreme\" id=\"vreme\" class=\"form-control\"><\/select><\/div><\/div>");
                        response.datum.forEach(function(option) {
                            $('#vreme').append('<option value="' + option.id + '">' + option.time + '</option>');
                           console.log(option.id + ' : ' + option.time);
                        });
                    } else {
                        $('.vreme').append("<div class=\"form-group row\"><label for=\"greska\" class=\"col-md-4 col-form-label text-md-right text-danger\">"+
                            "Error<\/label><div class=\"col-md-8\"><p class=\"form-control-plaintext text-danger\" id=\"greska\" name=\"greska\">All times are taken for "
                            + datum +", pelease choose other date<\/p><\/div><\/div>");
                    }
                });
            });

        };
    </script>
@endsection

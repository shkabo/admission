@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">My Applications</div>

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
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($applications as $app)
                                <tr>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->date }}</td>
                                    <td>{{ $app->time }}</td>
                                    <td>

                                        @if (is_null($app->status))
                                            Pending
                                        @elseif ($app->status === 0)
                                            Rejected
                                        @elseif ($app->status === 1)
                                            Confirmed
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $applications->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

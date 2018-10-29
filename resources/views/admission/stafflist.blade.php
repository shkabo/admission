@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Scheduled Applications</div>

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
                                <th scope="col">Admission</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Student</th>
                                <th scope="col">Students Phone</th>
                                <th scope="col">Students Email</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($applications as $app)
                                <tr>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->date }}</td>
                                    <td>{{ $app->time }}</td>
                                    <td>{{ $app->user }}</td>
                                    <td>{{ $app->phone }}</td>
                                    <td>{{ $app->email }}</td>
                                    <td id="status">
                                        @if (is_null($app->status))
                                            Pending
                                        @elseif ($app->status === 0)
                                            Rejected
                                        @elseif ($app->status === 1)
                                            Confirmed
                                        @endif
                                    </td>
                                    <td id="action">
                                        @if (is_null($app->status))
                                            <a class="btn btn-outline-success btn-sm approve" href="{{ route('admission.approve', ['id' => $app->id]) }}" data-toggle="tooltip" data-placement="top" title="Approve admission">
                                                <img src="/svg/check.svg" alt="Approve admission">
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm reject" href="{{ route('admission.reject', ['id' => $app->id]) }}" data-toggle="tooltip" data-placement="top" title="Reject admission">
                                                <img src="/svg/x.svg" alt="Reject admission">
                                            </a>
                                        @elseif ($app->status === 0)
                                            <a class="btn btn-outline-success btn-sm approve" href="{{ route('admission.approve', ['id' => $app->id]) }}" data-toggle="tooltip" data-placement="top" title="Approve admission">
                                                <img src="/svg/check.svg" alt="Approve admission">
                                            </a>
                                        @elseif ($app->status === 1)
                                            <a class="btn btn-outline-danger btn-sm reject" href="{{ route('admission.reject', ['id' => $app->id]) }}" data-toggle="tooltip" data-placement="top" title="Reject admission">
                                                <img src="/svg/x.svg" alt="Reject admission">
                                            </a>
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
    <script>
        window.onload = function() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Applications Stats</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Pending</th>
                                <th scope="col">Accepted</th>
                                <th scope="col">Rejected</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($applications as $app)
                                <tr>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->pending }}</td>
                                    <td>{{ $app->confirmed }}</td>
                                    <td>{{ $app->rejected }}</td>
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

@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Users List</div>

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
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->active === '1')
                                            Active
                                        @else
                                            Not Active
                                        @endif
                                    </td>
                                    <td>


                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('user.show.edit', ['id' => $user->id]) }}"><img src="/svg/pencil.svg" alt="pencil"></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

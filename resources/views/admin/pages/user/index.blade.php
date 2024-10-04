@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-3">Customer</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table dtTable table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Avatar</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Nomor SIM</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ $user->avatar() }}" class="img-fluid" alt="">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->nomor_telepon }}</td>
                                        <td>{{ $user->nomor_sim }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.customer.edit', $user->id) }}"
                                                class="btn btn-sm py-2 btn-info">Edit</a>
                                        </td>
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
<x-Admin.Sweetalert />
<x-Admin.Datatable />

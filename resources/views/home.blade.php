@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Total Reports</h5>
                <h2>25</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Verified Reports</h5>
                <h2>18</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Completed</h5>
                <h2>10</h2>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4 shadow-sm">
    <div class="card-body">

        <h4>Recent Flood Reports</h4>

        <table class="table table-bordered mt-3">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Location</th>
                    <th>Water Height</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Kendari</td>
                    <td>70 cm</td>
                    <td>
                        <span class="badge bg-warning">
                            Pending
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Anduonohu</td>
                    <td>120 cm</td>
                    <td>
                        <span class="badge bg-success">
                            Verified
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>
</div>

@endsection
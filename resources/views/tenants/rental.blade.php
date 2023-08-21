@extends('layouts.app')


@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top:10%" class="card">
                    <div class="text-center col-md-12 p-4">
                        <h2>Your Rental</h2>
                    </div>


                    <div class="col-md-6 m-4">
                        <div class="input-group" style="width:45%">
                            <div class="input-group-prepend">
                                <label  class="input-group-text" for="sort-by">Select Month:</label>
                            </div>

                            <select id="sort-by" class="form-select form-select-sm">
                                <option value=""></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                    </div>


                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Total Rent</th>
                                    <th>Rental Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <th>August</th>
                                    <td>6500.00</td>
                                    <td>Paid</td>
                                    <td><a href="">Details</a></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

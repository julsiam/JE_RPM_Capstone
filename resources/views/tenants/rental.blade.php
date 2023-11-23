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
                <div class="modal-header p-2" style="background-color:red; color: black;">
                    <div class="text-center col-md-12">
                        <h2>Your Rental</h2>
                    </div>

                </div>
                <div class="col-md-6 m-4">
                    <div class="input-group" style="width:45%">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="sort-by">Month</label>
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


                <div class="card mt-5 p-2 m-2 mb-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Total Rent</th>
                                <th>Rental Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>August</th>
                                <td>6500.00</td>
                                <td>Paid</td>
                                <td>
                                    <button class="btn btn-primary btn-sm detailsBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
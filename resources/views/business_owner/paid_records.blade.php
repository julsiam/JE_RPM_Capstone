@extends('layouts.owner')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="card mt-5">
                    <div class="row justify-content-center p-4">
                        <div class="col-md-8 text-start">
                            <h2>J and E Payment Records: PAID RECORDS</h2>
                        </div>

                        <div class="col-md-4 text-end btn-group btn-group-sm" role="group"
                            aria-label="Basic mixed styles example">
                            <a href="{{url('/paid_records')}}" class="btn btn-outline-success active" aria-current="page">Paid</a>
                            <a href="{{url('/notyetpaid_records')}}" class="btn btn-outline-warning"> Not Yet Paid</a>
                            <a href="#" class="btn btn-outline-primary"> Not Fully Paid</a>
                        </div>
                    </div>

                    <div class="container mt-4">
                        <div class="row justify-content-md-center">
                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">Select Month</label>
                                <select id="month" name="month" class="form-select form-select-sm">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">Year</label>
                                <select id="year" name="year" class="form-select form-select-sm">
                                    <option value="2024">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2024">2025</option>
                                    <option value="2024">2026</option>
                                </select>
                            </div>
                            <div class="col col-lg-2 mt-3">
                                <a type="btn" id="searchBtn" class="btn btn-outline-success me-2 searchBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="container">

                        </div>

                        <div class="card mt-5 p-2 mb-2">
                            <table id="paidRecordsTable" class="table">
                                <thead>
                                    <tr>
                                        <th hidden scope="col">ID</th>
                                        <th scope="col">Tenant</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Room Unit</th>
                                        <th scope="col">Total Rent</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Date Paid</th>
                                    </tr>
                                </thead>

                                <tbody id="paidRecord">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

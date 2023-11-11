@extends('layouts.owner')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="card mt-5">
                    <div class="row justify-content-center p-4">
                        <div class="col-md-8 text-start">
                            <h2>J and E Payment Records: NOT FULLY PAID HISTORY</h2>
                        </div>

                        <div class="col-md-4 text-end btn-group btn-group-sm" role="group"
                            aria-label="Basic mixed styles example">
                            <a href="{{ url('/paid_reports') }}" class="btn btn-outline-success">Paid</a>
                            <a href="{{ url('/unpaid_reports') }}" class="btn btn-outline-warning"
                                aria-current="page"> Not Yet Paid</a>
                            <a href="{{url('/notfullypaid_reports')}}" class="btn btn-outline-primary active"> Not Fully Paid</a>
                        </div>
                    </div>

                    <div class="container mt-4">
                        <div class="row justify-content-md-center">
                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">Location</label>

                                <select id="nfpLocation" class="form-select form-select-sm"
                                    @error('nfpLocation') is-invalid @enderror name="nfpLocation"
                                    autocomplete="nfpLocation" required>
                                </select>

                                @error('nfpLocation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">Start Month:</label>
                                <select id="nfpStartMonth" name="nfpStartMonth" class="form-select form-select-sm">
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

                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">End Month:</label>
                                <select id="nfpEndMonth" name="nfpEndMonth" class="form-select form-select-sm">
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

                            <div class="col col-lg-2">
                                <label style="color: rgb(128, 128, 128)">Year:</label>
                                <select id="nfpYear" name="recordYear" class="form-select form-select-sm">
                                    <option value="2024">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2024">2025</option>
                                    <option value="2024">2026</option>
                                </select>
                            </div>
                            <div class="col col-lg-2 mt-3">
                                <a type="btn" id="searchIcon" class="btn btn-outline-success me-2 searchIcon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="card mt-5 p-2 mb-2">
                            <table id="notFullyPaidTable" class="table">
                                <thead>
                                    <tr>
                                        <th hidden scope="col">ID</th>
                                        <th scope="col">Tenant</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Room Unit</th>
                                        <th scope="col">Total Rent</th>
                                        <th scope="col">Amount Paid</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Date Paid</th>
                                        <th scope="col">Due Date</th>

                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="container text-end">
                        <span class="total-balance">Total Balance: 0.00 </span> <br>
                        {{-- <span class="total-initialPayment">Total Initial Payment:</span> --}}
                    </div>


                </div>

                <div class="modal fade" id="nfpModal" tabindex="-1" aria-labelledby="noDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="noDataModalLabel">No Data Found</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                No records were found based on filtered details!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

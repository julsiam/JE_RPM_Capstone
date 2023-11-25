@extends('layouts.owner')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mt-5" style="border-radius: 10px;">
                <div class="row justify-content-center"
                    style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px; margin-bottom: 10px;">
                    <div class="col-md-8 text-start">
                        <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">J and E
                            Payment Records: PAID HISTORY</h2>
                    </div>

                    <div class="col-md-4 text-end btn-group btn-group-sm p-3" role="group"
                        aria-label="Basic mixed styles example">
                        <a href="{{ url('/paid_reports') }}" class="btn" aria-current="page"
                            style="background-color: #28a745; color: black; text-decoration: none;"
                            onmouseover="this.style.backgroundColor='#28a745'; this.style.color='white';"
                            onmouseout="this.style.backgroundColor='#28a745'; this.style.color='black';">Paid</a>
                        <a href="{{ url('/unpaid_reports') }}" class="btn btn-outline-warning" aria-current="page"> Not
                            Yet Paid</a>
                        <a href="{{ url('/notfullypaid_reports') }}" class="btn btn-outline-danger"> Not Fully Paid</a>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-2">
                            <label style="color: rgb(128, 128, 128)">Location:</label>

                            <select id="locationSelect" class="form-select form-select-sm" @error('locationSelect')
                                is-invalid @enderror name="locationSelect" autocomplete="locationSelect">

                            </select>

                            @error('locationSelect')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="col col-lg-2">
                            <label style="color: rgb(128, 128, 128)">Start Month:</label>
                            <select id="startMonth" name="month" class="form-select form-select-sm">
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
                            <select id="endMonth" name="month" class="form-select form-select-sm">
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
                            <select id="yearSelection" name="year" class="form-select form-select-sm">
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                        </div>
                        <div class="col col-lg-2 mt-3">
                            <a type="btn" id="searchBtn" class="btn btn-warning me-2 searchBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="card mt-5 p-2 mb-2">
                        <table id="paidHistory" class="table">
                            <thead>
                                <tr>
                                    <th hidden scope="col">ID</th>
                                    <th scope="col">Tenant</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Room Unit</th>
                                    <th scope="col">Total Rent</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Date Paid</th>
                                    <th scope="col">Amount Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container text-end">
                    <span class="income_span">Total Income: 0.00</span>
                </div>

                <div class="col-md-12 p-4">
                    {{-- <div class="row" style=" float:left;">
                            <label class="col-form-label">Total Maintenance</label>
                            <input style="width: 25%" type="text" class="form-control" id="totalProperties" disabled
                                value="{{ $totalMaintenance }}">
                </div> --}}

                <div class="row mt-4" style=" float:right;">
                    <a href="#" class="btn btn btn-outline-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-file type-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg>
                    </a>
                </div>
            </div>


        </div>

        <div class="modal fade" id="noReportModal" tabindex="-1" aria-labelledby="noDataModalLabel" aria-hidden="true">
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
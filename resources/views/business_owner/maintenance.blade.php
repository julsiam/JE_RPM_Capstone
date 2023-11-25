@extends('layouts.owner')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mt-5" style="border-radius: 10px;">
                <div class="text-center col-md-12" style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px; margin-bottom: 10px;">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">J and E Rental Maintenance</h2>
                </div>
                <div style="padding: 10px;">
                {{-- <div class="row p-2">
                        <div class="col-md-6 d-flex justify-content-start mt-2 mt-md-0">
                            <div class="input-group" style="width:50%">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="sort-by">Sort by:</label>
                                </div>

                                <select id="sort-by" class="form-select form-select-sm">
                                    <option value=""></option>
                                    <option value="status">Status</option>
                                    <option value="priority">Priority</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <div>
                        <table id="maintenanceData" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Schedule</th>
                                    <th>Date Created</th>
                                    <th>Category</th>
                                    {{-- <th>Priority</th> --}}
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($maintenance as $maintenance)
                                    <tr>
                                        <td>
                                            @if ($maintenance->schedule)
                                                {{ $maintenance->schedule->format('F d, Y | g:i A') }}
                                            @else
                                               Not Yet Scheduled
                                            @endif
                                        </td>
                                        <td scope="row">{{ $maintenance->date_requested->format('F d, Y') }}</td>
                                        <td>{{ $maintenance->category }}</td>
                                        {{-- <td>{{ $maintenance->priority }}</td> --}}
                                        <td> {{ $maintenance->user->first_name }} {{ $maintenance->user->last_name }} </td>

                                <td>{{ $maintenance->status }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm maintenance-details-button"
                                        data-maintenance-id='{{ $maintenance->id }}' data-bs-toggle="modal"
                                        data-bs-target="#maintenanceModal"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12 p-4">
                    {{-- <div class="row" style=" float:left;">
                            <label class="col-form-label">Total Maintenance</label>
                            <input style="width: 25%" type="text" class="form-control" id="totalProperties" disabled
                                value="{{ $totalMaintenance }}">
                </div> --}}

                <div class="row mt-4" style=" float:right;">
                    <a style="cursor: pointer; margin-left: 10px; width: 140px;color:#fff;"
                        class="btnH30 btn btn-danger" onclick="history.back()">BACK
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #A9CCE8;">
                <h5 class="modal-title" style="color: #135083; font-weight:700; letter-spacing: 2px;" id="maintenanceModalLabel">Maintenance Request Details</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maintenance.editMaintenanceStatus') }}" method="POST">
                    @csrf

                    <div class="p-2">
                        <input id="modal_id" required style="border-color: rgb(166, 166, 166)" type="hidden"
                            class="form-control" name="modal_id" value="" readonly>
                        <h6 id="modal_author_header" class="card-title"></h6>
                    </div>

                    <div class="card p-4">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: rgb(128, 128, 128); font-size:18px">Location:</label>

                                    <span id="modal_location" style="border-color: rgb(166, 166, 166); font-size:18px"
                                        class="form-control-static"></span>
                                </div>

                                <div class="form-group mt-2">
                                    <label style="color: rgb(128, 128, 128); font-size:18px">Room Unit:</label>
                                    <span id="modal_room_unit" style="border-color: rgb(166, 166, 166); font-size:18px"
                                        class="form-control-static"></span>
                                </div>

                                <div class="form-group mt-2">
                                    <label style="color: rgb(128, 128, 128)">Category: </label>
                                    <input id="modal_category" required style="border: 1px solid #ced4da;"
                                        type="text" class="form-control" name="category" value="" readonly>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="status">Status:
                                        &nbsp;</label>
                                    <div class="input-group">
                                        <select style="height:2.3rem; border-color: rgb(166, 166, 166)" id="modal_maintenance_status"
                                            name="modal_maintenance_status" class="form-select form-select-sm">
                                            <option value="Pending">PENDING</option>
                                            <option value="On Going">ON GOING</option>
                                            <option value="Done">DONE</option>
                                            <option value="Disapproved">DISAPPROVED</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="color: rgb(128, 128, 128); font-size:18px">Author:</label>
                                    <span id="modal_author" style="border-color: rgb(166, 166, 166); font-size:18px"
                                        class="form-control-static"></span>
                                </div>
                                <div class="form-group mt-2">
                                    <label style="color: rgb(128, 128, 128); font-size:18px">Date Requested:</label>
                                    <span id="modal_date_requested"
                                        style="border-color: rgb(166, 166, 166); font-size:18px"
                                        class="form-control-static"></span>
                                </div>

                                <div class="form-group mt-2">
                                    <label style="color: rgb(128, 128, 128)">Priority</label>
                                    <input id="modal_priority" style="border: 1px solid #ced4da;" type="text"
                                        class="form-control" name="priority" value="" readonly>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="schedule">Schedule:
                                        &nbsp;</label>
                                    <div class="input-group">
                                        <input id="modal_schedule" style="border-color: rgb(166, 166, 166)"
                                            type="datetime-local" class="form-control" name="modal_schedule" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2" style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px;">
                            <label style="color: rgb(128, 128, 128)">Description</label>
                            <h5 id="modal_description" class="card-text"></h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="updateRequestButton" type="submit" class="btn btn-outline-dark"  style="background-color: #FFA500;">Update</button>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
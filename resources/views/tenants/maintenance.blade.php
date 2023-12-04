@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mt-5" style="border-top-left-radius: 10px;
    border-top-right-radius: 10px;">

                <div class="row justify-content-between p-2"
                    style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px; margin-bottom: 10px;">
                    <div class="col-6">
                        <h2 style="color: #135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">Maintenance
                            Request </h2>
                    </div>
                    <div class="col-6 text-end" style="margin-top: 10px;">
                        <a href="#" class="btn btn-success me-2" data-bs-toggle="modal"
                            data-bs-target="#addRequestModal">
                            {{-- <a href="{{url('req ')}}" class="btn btn-success me-2"> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                <path
                                    d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <table id="maintenanceData" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Category</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Schedule</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($maintenanceRequests as $maintenance)
                            <tr>
                                <td>{{ $maintenance->date_requested->format('F d, Y') }}</td>
                                <td>{{ $maintenance->category }}</td>
                                <td>{{ $maintenance->priority }}</td>
                                <td>{{ $maintenance->status }}</td>
                                <td></td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm detailsBtn" data-bs-toggle="modal"
                                        data-bs-target="#detailsModal" data-request-id='{{ $maintenance->id }}'><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between p-3">
                    <div class="col-form-label">Total Requests: {{ $totalRequests }}</div>
                </div>

            </div>
        </div>

        <!--Details Modal -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="maintenanceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div style="background-color:#A9CCE8;" class="modal-header">
                        <h5 class="modal-title" id="maintenanceModalLabel"
                            style="color:#135083; font-weight: 700; letter-spacing:2px;">Maintenance Request Details
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color:#F8FAFC;">
                        <form action="#" method="#">
                            @csrf

                            <div class="p-2">
                                <input id="details_id" required style="border-color: rgb(166, 166, 166)" type="hidden"
                                    class="form-control" name="details_id" value="" readonly>
                            </div>

                            <div class="card p-4" style="background-color:white">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: #135083; font-size:20px">Location: </label>

                                            <b> <span id="details_location"
                                                    style="border-color: rgb(166, 166, 166); font-size:20px; color:#135083;"
                                                    class="form-control-static"></span></b>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: #135083; font-size:20px">Room Unit: </label>
                                            <b> <span id="details_room_unit"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px; color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: #135083; font-size:20px">Category:
                                            </label>

                                            <b> <span id="details_category"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px; color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: #135083; font-size:20px">Status: </label>
                                            <b> <span id="details_status"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px; color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: #135083; font-size:20px">Author: </label>
                                            <b> <span id="details_author"
                                                    style="border-color: #135083; font-size:18px; color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: #135083; font-size:20px">Date
                                                Requested: </label>
                                            <b> <span id="details_date_requested"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px;color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: #135083; font-size:20px">
                                                Priority: </label>
                                            <b> <span id="details_priority"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px;color:#135083;"
                                                    class="form-control-static"></span> </b>
                                        </div>

                                    </div>

                                    <div class="form-group mt-2">
                                        <label style="color: #135083; font-size:20px">Description:
                                        </label> <br>

                                        <b> <span id="details_description"
                                                style="border-color: rgb(166, 166, 166); font-size:20px; color:#135083;"
                                                class="form-control-static"></span> </b>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">

                                <button id="followUpBtn" type="submit" class="btn"
                                    style="background-color:#135083; color:white"
                                    onmouseover="this.style.backgroundColor='#A9CCE8'; this.style.color='black';"
                                    onmouseout="this.style.backgroundColor='#135083'; this.style.color='white';">Follow
                                    Up
                                </button>
                                <button type="button" class="btn" data-bs-dismiss="modal"
                                    style="background-color:#FE8900;"
                                    onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                                    onmouseout="this.style.backgroundColor='#FE8900'; this.style.color='black';">Close</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Request Modal -->
        <div class="modal fade" id="addRequestModal" tabindex="-1" aria-labelledby="maintenanceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#A9CCE8; color:#135083">
                        <h4 class="modal-title" id="maintenanceModalLabel"
                            style="color: #135083; font-weight: 700;padding-left: 23px;">Create Maintenance Request</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="background-color: #F2F2F3;">
                        <form action="{{ route('maintenance.submit') }}" method="POST">
                            @csrf
                            <div class="card p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Author:</label>
                                            <span id="request_author"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static">{{ Auth::check() ? Auth::user()->first_name : '' }}
                                                {{ Auth::check() ? Auth::user()->last_name : '' }}</span>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Date
                                                Requested:</label>
                                            <input type="hidden" name="hidden_request_date_requested"
                                                id="hidden_request_date_requested">
                                            <span id="request_date_requested"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static">
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Location: </label>

                                            <span id="request_location"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static">{{ Auth::check() ? Auth::user()->property->location : '' }}</span>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Room Unit:</label>
                                            <span id="request_room_unit"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static">{{ Auth::check() ? Auth::user()->property->room_unit : '' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="form-group px-0">
                                        <label style="color: rgb(128, 128, 128)">Category</label>
                                        {{-- <input id="request_type" style="border-color: rgb(166, 166, 166)"
                                                type="text" class="form-control" name="request_type"
                                                value="{{ old('request_type') }}" required> --}}

                                        <select id="request_category" name="request_category"
                                            class="form-select form-select-sm" required>
                                            <option value="">Select category...</option>
                                            <option value="CR">Comfort Room</option>
                                            <option value="Door">Door</option>
                                            <option value="Drainage">Drainage</option>
                                            <option value="Electricity">Electricity</option>
                                            <option value="Garbage">Garbage</option>
                                            <option value="Roof">Roof</option>
                                            <option value="Water">Water</option>
                                            <option value="Windows">Windows</option>
                                            <option value="Other">Other (Describe the Issue)</option>
                                        </select>

                                        @error('request_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2">
                                        <label style="color: rgb(128, 128, 128); font-size:15px" for="status">Priority
                                            &nbsp;</label>
                                        <select name="request_priority" id="request_priority" required
                                            class="form-select form-select-md">
                                            <option value=""></option>
                                            <option value="High">High</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Low">Low</option>
                                        </select>

                                        @error('request_priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row card-body">
                                        <label style="color: rgb(128, 128, 128)">Description: Please describe the issue
                                            well</label>
                                        <textarea id="request_description" name="request_description"
                                            class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            required></textarea>

                                        @error('request_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn" style="background-color:#135083; color:white"
                                    onmouseover="this.style.backgroundColor='#A9CCE8'; this.style.color='black';"
                                    onmouseout="this.style.backgroundColor='#135083'; this.style.color='white';">Submit
                                    Request</button>

                                <button type="button" class="btn" data-bs-dismiss="modal"
                                    style="background-color:#FE8900;"
                                    onmouseover="this.style.backgroundColor='red'; this.style.color='white';"
                                    onmouseout="this.style.backgroundColor='#FE8900'; this.style.color='black';">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
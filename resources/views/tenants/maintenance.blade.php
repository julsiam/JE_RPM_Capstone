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
                <div class="card mt-5">

                    <div class="row justify-content-between p-2">
                        <div class="col-6">
                            <h2>Maintenance Request </h2>
                        </div>
                        <div class="col-6 text-end">
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

                        <div>
                            <table id="maintenanceData" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Type</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($maintenanceRequests as $maintenance)
                                        <tr>
                                            <td>{{ $maintenance->date_requested->format('F d, Y') }}</td>
                                            <td>{{ $maintenance->request_type }}</td>
                                            <td>{{ $maintenance->priority }}</td>
                                            <td>{{ $maintenance->status }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm detailsBtn" data-bs-toggle="modal"
                                                    data-bs-target="#detailsModal"
                                                    data-request-id='{{ $maintenance->id }}'>Details</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="col-form-label">Total Requests: {{ $totalRequests }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Details Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="maintenanceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div style="background-color:rgba(255, 166, 0, 0.357)" class="modal-header">
                            <h5 class="modal-title" id="maintenanceModalLabel">Maintenance Request Details</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="#">
                                @csrf

                                <div class="p-2">
                                    <input id="details_id" required style="border-color: rgb(166, 166, 166)" type="hidden"
                                        class="form-control" name="details_id" value="" readonly>
                                </div>

                                <div class="card p-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Location: </label>

                                                <span id="details_location"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Room Unit: </label>
                                                <span id="details_room_unit"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Request Type:
                                                </label>

                                                <span id="details_request_type"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>

                                                <span id="details_request_type"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Status: </label>
                                                <span id="details_status"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Author: </label>
                                                <span id="details_author"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">Date
                                                    Requested: </label>
                                                <span id="details_date_requested"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                            <div class="form-group mt-2">
                                                <label style="color: rgb(128, 128, 128); font-size:18px">
                                                    Priority: </label>
                                                <span id="details_priority"
                                                    style="border-color: rgb(166, 166, 166); font-size:18px"
                                                    class="form-control-static"></span>
                                            </div>

                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Description:
                                            </label> <br>

                                            <span id="details_description"
                                                style="border-color: rgb(166, 166, 166); font-size:15px"
                                                class="form-control-static"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">

                                    <button id="followUpBtn" type="submit" class="btn btn-primary">Follow Up
                                    </button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="maintenanceModalLabel">Create Maintenance Request</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
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
                                            <label style="color: rgb(128, 128, 128)">Request Type:</label>
                                            <input id="request_type" style="border-color: rgb(166, 166, 166)"
                                                type="text" class="form-control" name="request_type"
                                                value="{{ old('request_type') }}" required>

                                            @error('request_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:15px"
                                                for="status">Priority:
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
                                            <label style="color: rgb(128, 128, 128)">Description:</label>
                                            <textarea id="request_description" name="request_description" class="form-control" id="exampleFormControlTextarea1"
                                                rows="3" required></textarea>

                                            @error('request_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit
                                        Request</button>

                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

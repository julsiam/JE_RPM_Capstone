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
                <div class="card mt-5">
                    <div class="text-center col-md-12 p-2">
                        <h2>J and E Rental Maintenance</h2>
                    </div>
                    <div class="row p-2">
                        <div class="col-md-6 d-flex justify-content-start mt-2 mt-md-0">
                            <div class="input-group" style="width:50%">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="sort-by">Sort by:</label>
                                </div>

                                <select id="sort-by" class="form-select form-select-sm">
                                    <option value=""></option>
                                    <option value="status">Status</option>
                                    <option value="location">Priority</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table id="maintenanceData" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Type</th>
                                    <th>Priority</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($maintenance as $maintenance)
                                    <tr>
                                        <td scope="row">{{ $maintenance->created_at->format('F d, Y | g:i A') }}</td>
                                        <td>{{ $maintenance->request_type }}</td>
                                        <td>{{ $maintenance->priority }}</td>
                                        <td>
                                            @if ($maintenance->user)
                                                {{ $maintenance->user->first_name }} {{ $maintenance->user->last_name }}
                                            @else
                                                No Tenant
                                            @endif
                                        </td>
                                        <td>{{ $maintenance->status }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm maintenance-details-button" data-maintenance-id ='{{ $maintenance->id }}' data-bs-toggle="modal"
                                            data-bs-target="#maintenanceModal">Details</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 p-4">
                        <div class="row" style=" float:left;">
                            <label class="col-form-label">Total Maintenance</label>
                            <input style="width: 25%" type="text" class="form-control" id="totalProperties" disabled
                                value="{{ $totalMaintenance }}">
                        </div>

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
        <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="maintenanceModalLabel">Maintenance Request Details</h5>

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Location:</label>

                                            <span id="modal_location"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static"></span>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:18px">Room Unit:</label>
                                            <span id="modal_room_unit"
                                                style="border-color: rgb(166, 166, 166); font-size:18px"
                                                class="form-control-static"></span>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label style="color: rgb(128, 128, 128); font-size:18px" for="status">Status:
                                                &nbsp;</label>
                                            <div class="input-group">
                                                <select id="modal_maintenance_status" name="modal_maintenance_status"
                                                    class="form-select form-select-sm">
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
                                    </div>
                                </div>



                                <div class="row card-body">
                                    <label style="color: rgb(128, 128, 128)">Request Type</label>
                                    <input id="modal_request_type" required style="border-color: rgb(166, 166, 166)"
                                        type="text" class="form-control" name="request_type" value="" readonly>
                                </div>

                                <div class="form-group px-0">
                                    <label style="color: rgb(128, 128, 128)">Priority</label>
                                    <input id="modal_priority" style="border-color: rgb(166, 166, 166)" type="text"
                                        class="form-control" name="priority" value="" readonly>
                                </div>

                                <div class="row card-body">
                                    <label style="color: rgb(128, 128, 128)">Description</label>
                                    <p id="modal_description" class="card-text"></p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="" class="btn btn btn-outline-danger me-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                    </svg>
                                </a>
                                <button id="updateRequestButton" type="submit" class="btn btn-primary">Update
                                    Request</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        {{-- <div class="modal fade" id="maintenanceModal{{ $maintenance->id }}" tabindex="-1"
            aria-labelledby="maintenanceModalLabel{{ $maintenance->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="maintenanceModalLabel{{ $maintenance->id }}">Maintenance Request Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update_maintenance_request', $maintenance->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ $maintenance->location }}" disabled>
                            </div>
                            <!-- Add other input fields here: room_unit, date_Requested, author, etc. -->

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="PENDING" {{ $maintenance->status == 'PENDING' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="ON GOING" {{ $maintenance->status == 'ON GOING' ? 'selected' : '' }}>On
                                        Going</option>
                                    <option value="DONE" {{ $maintenance->status == 'DONE' ? 'selected' : '' }}>Done
                                    </option>
                                    <option value="DISAPPROVED"
                                        {{ $maintenance->status == 'DISAPPROVED' ? 'selected' : '' }}>Disapproved</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary">Update Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
@endsection

@extends('layouts.owner')


@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container" style="margin-top: 10%">
        <div class="card p-2 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 p-4">
                    <h2>J and E Rental Inactive Tenants</h2>
                </div>

                <div class="col-md-6 text-end">
                    {{-- INACTIVE --}}
                    <a href="{{ route('tenants') }}" class="btn btn btn-outline-warning me-2">Active Tenants
                        {{-- <svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-file type-pdf"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg> --}}
                    </a>

                    {{-- SHEET --}}
                    <a href="{{ route('tenants_export') }}" class="btn btn-outline-success me-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filetype-xls" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z" />
                        </svg></a>

                    {{-- REFRESH --}}
                    <a href="" class="btn btn-outline-secondary me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg></a>

                    {{-- ADD TENANT --}}
                    <a href="{{ route('add_tenant_form') }}" class="btn btn-success me-2" class="btn btn-success me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                    </a>

                    {{-- EDIT TENANT --}}
                    {{-- <a href="{{ url('edit_tenant') }}" class="btn btn-dark me-2" class="btn btn-success me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                    </a> --}}

                    {{-- BACK --}}
                    <a onclick="history.back()" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg></a>
                </div>
            </div>


            <div class="card p-2">
                <table id="inactiveTenantsData" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th hidden class="text-start">ID</th>
                            <th class="text-start">NAME</th>
                            <th class="text-start">EMAIL</th>
                            <th class="text-start">LOCATION</th>
                            <th class="text-start">ROOM UNIT</th>
                            <th class="text-center">DUES</th>
                            <th class="text-center">STATUS</th>
                            {{-- <th class="text-center">DETAILS</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactiveTenants as $inactive_tenant)
                            <tr>
                                <td hidden class="text-start" scope="row">{{ $inactive_tenant->id }}</td>

                                <td class="text-start">{{ $inactive_tenant->first_name }} {{ $inactive_tenant->last_name }}
                                </td>

                                <td class="text-start">{{ $inactive_tenant->email }}</td>

                                <td class="text-start">
                                    @if ($inactive_tenant->tenantProperty)
                                        {{ $inactive_tenant->tenantProperty->location }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-start">
                                    @if ($inactive_tenant->tenantProperty)
                                        {{ $inactive_tenant->tenantProperty->room_unit }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td
                                    class="text-center
                                @if ($inactive_tenant->rental && $inactive_tenant->rental->due_date->isToday()) text-danger fw-bold @endif">
                                    @if ($inactive_tenant->rental)
                                        {{ $inactive_tenant->rental->due_date->format('F d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $inactive_tenant->rental->status }}
                                </td>

                                {{-- <td class="text-center">
                                    <button class="btn btn-primary btn-sm inactiveDetailsBtn"
                                        data-inactiveTenant-id='{{ $inactive_tenant->id }}' data-bs-toggle="modal"
                                        data-bs-target="#inactiveTenantProfileModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </button>
                                </td> --}}

                                {{-- <button class="btn btn-primary btn-sm inactiveDetailsBtn"
                                        data-inactiveTenant-id='{{ $inactive_tenant->id }}' data-bs-toggle="modal"
                                        data-bs-target="#inactiveTenantProfileModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </button> --}}

                                {{-- <button class="btn btn-primary btn-sm inactiveDetailsBtn"
                                        data-inactiveTenant-id='{{ $inactive_tenant->id }}' data-bs-toggle='modal'
                                        data-bs-target='#inactiveTenantProfileModal'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </button> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- MODAL --}}
            <div class="modal fade" id="inactiveTenantProfileModal" tabindex="-1" aria-labelledby="tenantProfileModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="inactiveTenantProfileModal">{{ __('Tenant Profile') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body m-2">
                            <div class="mb-3">
                                <div class="">
                                    <input id="inactive_tenant_id" required style="border-color: rgb(166, 166, 166)"
                                        type="" class="form-control" name="inactive_tenant_id" value=""
                                        readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 p-2">
                                    <h5>PERSONAL INFORMATION</h5>
                                    <div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    {{-- <img style="width: 200px;" id="inactive_profile" src=""
                                                    alt="Profile Picture"> --}}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">First Name</label>
                                                <input id="inactive_inactive_first_name"
                                                    style="border-color: rgb(166, 166, 166)" type="text"
                                                    class="form-control" name="inactive_inactive_first_name" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Last Name</label>
                                                <input id="inactive_last_name" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_last_name"
                                                    readonly value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Email</label>
                                                <input id="inactive_email" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_email"
                                                    value="" readonly>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Phone Number</label>
                                                <input id="inactive_phone_number" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_phone_number"
                                                    readonly value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Permanent Address</label>
                                                <input id="inactive_address" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_address" readonly
                                                    value="">
                                            </div>


                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Birthdate</label>
                                                <input id="inactive_birthdate" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_birthdate"
                                                    readonly value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Age</label>
                                                <input id="inactive_age" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_age" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Gender</label>
                                                <input id="inactive_gender" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_gender" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Occupation</label>
                                                <input id="inactive_occupation" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_occupation"
                                                    readonly value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Work Address</label>
                                                <input id="inactive_work_address" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="inactive_work_address"
                                                    readonly value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 p-2 mt-4"
                                    style="height:80mm; border: 0.5px solid #ced4da60; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)">
                                    <div>
                                        <div class="col-md-8 p-2">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <img style="width: 200px;" id="inactive_idPhoto"
                                                        src="{{ asset('image/default_photo.png') }}" alt="ID Photo">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <a href="" id="inactive_contractLink" target="_blank">Contract of
                                                    Agreement</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 p-2 m-2">
                                        <h5>RENTAL INFORMATION</h5>
                                        <div>
                                            <div class="row align-items-start">
                                                <div class="form-group col md-5">
                                                    <label style="color: rgb(128, 128, 128)">Location</label>
                                                    <input id="inactive_location" style="border-color: rgb(166, 166, 166)"
                                                        type="text" class="form-control" name="inactive_location"
                                                        readonly value="">
                                                </div>
                                                <div class="form-group col md-5">
                                                    <label style="color: rgb(128, 128, 128)">Room Unit</label>
                                                    <input id="inactive_room_unit"
                                                        style="border-color: rgb(166, 166, 166)" type="text"
                                                        class="form-control" name="inactive_room_unit" readonly
                                                        value="">
                                                </div>
                                                <div class="form-group col md-5">
                                                    <label style="color: rgb(128, 128, 128)">Move-in Data</label>
                                                    <input id="inactive_movein_date"
                                                        style="border-color: rgb(166, 166, 166)" type="text"
                                                        class="form-control" name="inactive_movein_date" readonly
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 p-2 m-2">
                                        <h5>PAYMENT HISTORY</h5>
                                        <div>
                                            <table id="inactive_payment_history" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th scope="col">Total Rent</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Date Paid</th>
                                                        <th scope="col">Amount Paid</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>

                            {{-- <button type="button" class="btn btn-danger deleteTenantBtn">
                                {{ __('Delete Tenant') }}
                            </button>


                            <a href="{{ url('edit_tenant') }}" type="button"
                                class="btn btn-primary">{{ __('Update') }}</a> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

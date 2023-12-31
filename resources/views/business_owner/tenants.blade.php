@extends('layouts.owner')


@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container" style="margin-top: 7%">
        <div class="row justify-content-center" style="padding-left: 12px;font-size: medium;">
            <div style=" color: #135083;font-weight: 700;">Note: Add the properties first before adding any tenants.</div>
        </div>
        <div class="card mt-2" style="border-radius: 25px;">
            <div class="row justify-content-center"
                style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px;">
                <div class="col-md-6 ">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">J and E Rental Tenants
                    </h2>
                </div>

                <div class="col-md-6 text-end p-2">
                    {{-- INACTIVE --}}
                    <a href="{{ route('inactive-tenants') }}" class="btn btn btn-outline-warning me-2"
                        style="color:#135083;">Inactive Tenants</a>

                    {{-- SHEET --}}

                    <a href="{{ route('tenants_export') }}" class="btn btn-outline-success me-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filetype-xls" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z" />
                        </svg>
                    </a>


                    {{-- REFRESH --}}

                    <a href="" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg>
                    </a>

                    {{-- ADD TENANT --}}
                    <a href="{{ url('add_tenant_form') }}" class="btn btn-warning me-2" class="btn btn-success me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                    </a>

                    {{-- BACK --}}

                    <a onclick="history.back()" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                    </a>

                </div>
            </div>

            <div class="card p-2">
                <table id="tenantsData" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th hidden class="text-start">ID</th>
                            <th class="text-start">NAME</th>
                            <th class="text-start">EMAIL</th>
                            <th class="text-start">LOCATION</th>
                            <th class="text-start">ROOM UNIT</th>
                            <th class="text-center">DUES</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tenants as $tenant)
                            <tr>
                                <td hidden class="text-start" scope="row">{{ $tenant->id }}</td>

                                <td class="text-start">{{ $tenant->first_name }} {{ $tenant->last_name }}</td>

                                <td class="text-start">{{ $tenant->email }}</td>

                                <td class="text-start">
                                    @if ($tenant->property)
                                        {{ $tenant->property->location }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="text-start">
                                    @if ($tenant->property)
                                        {{ $tenant->property->room_unit }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <!--To change the color if mag due date na si tenant-->
                                <td class="text-center @if ($tenant->rental && $tenant->rental->due_date->isToday()) text-danger fw-bold @endif">
                                    @if ($tenant->rental)
                                        {{ $tenant->rental->due_date->format('F d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $tenant->rental->status }}
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-outline-primary btn-sm detailsBtn"
                                        data-tenant-id='{{ $tenant->id }}' data-bs-toggle='modal'
                                        data-bs-target='#tenantProfileModal'><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor"
                                            class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="tenantProfileModal" tabindex="-1" aria-labelledby="editAnnouncementModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #A9CCE8;">
                            <h4 class="modal-title" id="addAnnouncementModalLabel"
                                style="color: #135083; font-weight:700; letter-spacing: 2px;">{{ __('Tenant Profile') }}
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body m-2" style="background-color: #F2F2F3;">
                            <div class="mb-3">
                                <div class="">
                                    <input id="tenant_id" required style="border-color: rgb(166, 166, 166)"
                                        type="hidden" class="form-control" name="tenant_id" value="" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 p-2">
                                    <h5>PERSONAL INFORMATION</h5>
                                    <div>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-auto">
                                                    {{-- <img style="width: 200px;" id="tenant_profile" src=""
                                                    alt="Profile Picture"> --}}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">First Name</label>
                                                <input id="tenant_first_name" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_first_name" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Last Name</label>
                                                <input id="tenant_last_name" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_last_name" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Email</label>
                                                <input id="tenant_email" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_email"
                                                    value="" readonly>
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Phone Number</label>
                                                <input id="tenant_phone_number" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_phone_number"
                                                    readonly value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Permanent Address</label>
                                                <input id="tenant_address" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="permanent_tenant_address"
                                                    readonly value="">
                                            </div>


                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Birthdate</label>
                                                <input id="tenant_birthdate" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_birthdate" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Age</label>
                                                <input id="tenant_age" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_age" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Gender</label>
                                                <input id="tenant_gender" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_gender" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Occupation</label>
                                                <input id="tenant_occupation" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_occupation" readonly
                                                    value="">
                                            </div>

                                            <div class="form-group col-md-5">
                                                <label style="color: rgb(128, 128, 128)">Work Address</label>
                                                <input id="tenant_work_address" style="border-color: rgb(166, 166, 166)"
                                                    type="text" class="form-control" name="tenant_work_address"
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
                                                    <img style="width: 200px;" id="tenant_idPhoto"
                                                        src="{{ asset('image/default_photo.png') }}" alt="ID Photo">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <a href="" id="tenant_contractLink" target="_blank">Contract of
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
                                                    <input id="tenant_location" style="border-color: rgb(166, 166, 166)"
                                                        type="text" class="form-control" name="tenant_location"
                                                        readonly value="">
                                                </div>
                                                <div class="form-group col md-5">
                                                    <label style="color: rgb(128, 128, 128)">Room Unit</label>
                                                    <input id="tenant_room_unit" style="border-color: rgb(166, 166, 166)"
                                                        type="text" class="form-control" name="tenant_room_unit"
                                                        readonly value="">
                                                </div>
                                                <div class="form-group col md-5">
                                                    <label style="color: rgb(128, 128, 128)">Move-in Data</label>
                                                    <input id="tenant_movein_date"
                                                        style="border-color: rgb(166, 166, 166)" type="text"
                                                        class="form-control" name="tenant_movein_date" readonly
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
                                            <table id="payment_history" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Total Rent</th>
                                                        {{-- <th scope="col">Date Paid</th> --}}
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

                            <button type="button" class="btn btn-danger deleteTenantBtn">
                                {{ __('Delete Tenant') }}
                            </button>

                            {{-- @if (isset($tenant))
                                <a href="#" onclick="updateTenantDetails('{{ $tenant->id }}')"
                        class="btn btn-primary updateDetailsBtn">{{ __('Update') }}</a>
                        @endif --}}

                            @if (isset($tenant))
                                <a href="#" class="btn btn-primary updateDetailsBtn">{{ __('Update') }}</a>
                            @endif
                        </div>


                        {{-- DELETE CONFIRMATION MODAL --}}

                        <div class="modal fade bg-outline-danger" id="confirmDeleteTenantModal" tabindex="-1"
                            aria-labelledby="confirmDeleteTenantModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form id="deleteForm" method="POST" action="{{ route('tenant.delete_tenant') }}">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title" id="confirmDeleteTenantModalLabel">Confirm Deletion
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="tenant_delete_id" id="delete_tenant_id" readonly>

                                            Are you sure you want to delete this tenant. All its details will be lost!
                                            Please delete with caution'!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

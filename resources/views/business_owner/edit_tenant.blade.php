@extends('layouts.owner')
{{-- <style>
    /* Remove default input styling */
    input.form-control {
        border: none;
        box-shadow: none;
        background-color: transparent;
    }

    /* Custom table row styles */
    #rentalTable tbody tr {
        background-color: #f8f9fa; /* Set the background color of table rows */
    }

    #rentalTable tbody tr:nth-child(even) {
        background-color: #e9ecef; /* Set the background color of even rows (alternate row colors) */
    }
</style> --}}

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="margin-top:5%" class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div style="margin:1px auto" class="col-md-12">

                    <form class="row g-3 mt-4" action="{{ route('tenant.editTenant') }}" method="POST"
                        style="border: 0.5px solid #ced4da60; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding:5px">
                        @csrf
                        <div>
                            <h3>EDIT TENANT</h3>
                        </div>

                        <div class="col-md-8 p-2">
                            <h5>PERSONAL INFORMATION</h5>
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Email</label>
                                        <input id="email" style="border-color: rgb(166, 166, 166)" type="email"
                                            class="form-control" name="email" value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <a style="cursor: pointer; margin-top:20px; width: 75px;color:#fff;" href="#"
                                            class="btn btn-success me-2" class="btn btn-success me-2"
                                            onclick="fetchTenantsList()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Phone Number</label>
                                        <input id="phone_number" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="phone_number" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Permanent Address</label>
                                        <input id="address" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="permanent_address" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">First Name</label>
                                        <input id="first_name" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="first_name" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Last Name</label>
                                        <input id="last_name" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="last_name" readonly value="">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Birthdate</label>
                                        <input id="birthdate" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="birthdate" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Age</label>
                                        <input id="age" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="age" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Gender</label>
                                        <input id="gender" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="gender" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Occupation</label>
                                        <input id="occupation" style="border-color: rgb(166, 166, 166)" type="text"
                                            class="form-control" name="occupation" readonly value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 p-3"
                            style="border: 0.5px solid #ced4da60; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)">
                            <div>
                                <div class="col-md-10 p-2">
                                    <div class="row">
                                        PHOTO
                                    </div>
                                    {{-- <div class="col-auto">
                                        <img style="width: 175px;" src="{{ asset('image/gwapo1.jpg') }}" alt="">
                                    </div> --}}
                                    {{-- <div class="mt-2">
                                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        {{-- <div class="div">
                            <h5>PERSONAL INFORMATION</h5>
                            <div class="table-responsive">
                                <table id="InventoryData" class="table">
                                    <thead class="thead-dark ">
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>ADDRESS</th>
                                            <th>ROOM UNIT</th>
                                            <th>DETAILS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>First Name + Last Name</td>
                                            <td>juls@gmail.com</td>
                                            <td>Cebu City</td>
                                            <td>RJAE001</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> --}}

                        <div class="div mt-5">
                            <h5>RENTAL INFORMATION</h5>
                            <div class="table-responsive mt-4">
                                <table id="rentalTable" class="table">
                                    <thead class="thead-dark ">
                                        <tr>
                                            <th>ID</th>
                                            <th>LOCATION</th>
                                            <th>ROOM UNIT</th>
                                            <th>RENT STARTED</th>
                                            <th>ROOM RENT</th>
                                            <th>WATER BILL</th>
                                            <th>ELECTRIC BILL</th>
                                            <th>TOTAL RENT</th>
                                            <th>DUES</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="rental_id" type="text"
                                                    class="form-control @error('rental_id') is-invalid @enderror"
                                                    name="rental_id" value="" required autocomplete="rental_id"
                                                    autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="location" type="text"
                                                    class="form-control @error('location') is-invalid @enderror"
                                                    name="location" value="" required autocomplete="location"
                                                    autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="room_unit" type="text"
                                                    class="form-control @error('room_unit') is-invalid @enderror"
                                                    name="room_unit" value="" required autocomplete="room_unit"
                                                    autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="rent_started" type="text"
                                                    class="form-control @error('rent_started') is-invalid @enderror"
                                                    name="rent_started" value="" required
                                                    autocomplete="rent_started" autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="room_rent" type="text"
                                                    class="form-control @error('room_rent') is-invalid @enderror"
                                                    name="room_rent" value="" required autocomplete="room_rent"
                                                    autofocus readonly oninput="calculateTotalBill()">
                                            </td>
                                            <td>
                                                <input id="water_bill" type="text"
                                                    class="form-control @error('water_bill') is-invalid @enderror"
                                                    name="water_bill" value="" required autocomplete="water_bill"
                                                    autofocus oninput="calculateTotalBill()">
                                            </td>
                                            <td>
                                                <input id="electric_bill" type="text"
                                                    class="form-control @error('electric_bill') is-invalid @enderror"
                                                    name="electric_bill" value="" required
                                                    autocomplete="electric_bill" autofocus oninput="calculateTotalBill()">
                                            </td>
                                            <td>
                                                <input id="total_bill" type="text"
                                                    class="form-control @error('total_bill') is-invalid @enderror"
                                                    name="total_bill" value="" required autocomplete="total_bill"
                                                    autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="due_date" type="date"
                                                    class="form-control @error('due_date') is-invalid @enderror"
                                                    name="due_date" value="" required autocomplete="due_date"
                                                    autofocus>
                                            </td>
                                            <td>
                                                <select id="status" name="status" class="form-select">
                                                    <option value=""></option>
                                                    <option value="On Going">On Going</option>
                                                    <option value="Not Yet Paid">Not Yet Paid</option>
                                                    <option value="Paid">Paid</option>
                                                    <option value="Not Fully Paid">Not Fully Paid</option>
                                                </select>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div style="margin-bottom: 5mm" class="col-12">
                            <div class="d-flex justify-content-end">
                                <button style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff;"
                                    class="btnH30 btn btn-success">DETAILS</button>
                                <button type="submit"
                                    style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff;"
                                    class="btnH30 btn btn-primary">UPDATE</button>
                                <button type="reset"
                                    style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff;"
                                    class="btnH30 btn btn-warning">CLEAR</button>

                                <a style="cursor: pointer; margin-left: 10px; width: 100px;color:#fff;"
                                    class="btnH30 btn btn-danger" onclick="history.back()">BACK
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- The Modal -->
                <div class="modal fade" id="tenantModal" tabindex="-1" role="dialog"
                    aria-labelledby="tenantModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tenantModalLabel">Select Tenant</h5>
                                <button type="button" class="btn btn-outline-dark   " data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table" id="tenantTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Tenant data will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

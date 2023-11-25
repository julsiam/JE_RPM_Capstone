@extends('layouts.owner')

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
                            <h3 style="color:#135083; font-weight: 700 ">EDIT RENTAL</h3>
                        </div>

                        <div class="col-md-8 p-2">
                            <h5 style="color:#135083; font-weight: 700">PERSONAL INFORMATION</h5>
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Email</label>
                                        <input id="email" style="border-color: rgb(166, 166, 166)" type="email"
                                            class="form-control" name="email" value="" readonly>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <a style="cursor: pointer; margin-top:20px; width: 120px;color:#fff; background-color: #135083;"
                                            class="btn btn-success me-2" onclick="fetchTenantsList()"> Tenant List
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

                        <div class="col-md-2 p-3" style="border: 0.5px solid #ced4da60; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1)">
                            <div>
                                <div class="p-2">
                                    <div class="row">
                                        <div class="d-flex justify-content-center col-auto p-2">
                                            <img class="p-2" style="width: 200px;" id="idPhoto"
                                                src="{{ asset('image/default_photo.png') }}" alt="ID Photo">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center row">
                                        <a href="" id="contractLink" target="_blank">Contract of Agreement</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="div mt-5">
                            <h5 style="color:#135083; font-weight: 700" >RENTAL INFORMATION</h5>
                            <div class="table-responsive mt-4">
                                <table id="rentalTable" class="table">
                                    <thead class="thead-dark ">
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>LOCATION</th>
                                            <th>ROOM UNIT</th>
                                            <th>MOVE IN DATE</th>
                                            <th>RENT FROM</th>
                                            <th>DUE DATE</th>
                                            <th>DATE UPDATED</th>
                                            <th></th> <!--para mapantay ang table-->
                                            {{-- <th>ROOM RENT</th>
                                            <th>WATER BILL</th>
                                            <th>ELECTRIC BILL</th>
                                            <th>TOTAL RENT</th>
                                            <th>AMOUNT PAID</th>
                                            <th>BALANCE</th>
                                            <th>STATUS</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td hidden>
                                                <input id="rental_id" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('rental_id') is-invalid @enderror"
                                                    name="rental_id" value="" required autocomplete="rental_id"
                                                    autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="edit_location" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_location') is-invalid @enderror"
                                                    name="edit_location" value="" required
                                                    autocomplete="edit_location" autofocus readonly>
                                            </td>
                                            <td>
                                                <input id="edit_room_unit" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_room_unit') is-invalid @enderror"
                                                    name="edit_room_unit" value="" required
                                                    autocomplete="edit_room_unit" autofocus readonly>
                                            </td>

                                            <td>
                                                <input id="edit_rent_started" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_rent_started') is-invalid @enderror"
                                                    name="edit_rent_started" value="" required
                                                    autocomplete="edit_rent_started" autofocus readonly>
                                            </td>

                                            {{-- RENT FROM --}}
                                            <td>
                                                <input id="edit_rent_from" type="date"
                                                    class="form-control @error('edit_rent_from') is-invalid @enderror"
                                                    name="edit_rent_from" value="" required
                                                    autocomplete="edit_rent_from" autofocus>

                                                @error('edit_rent_from')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input id="edit_due_date" type="date"
                                                    class="form-control @error('edit_due_date') is-invalid @enderror"
                                                    name="edit_due_date" value="" required
                                                    autocomplete="edit_due_date" autofocus>

                                                @error('edit_due_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input id="edit_date_updated" type="date" style="background-color: #d3d3d3;"
                                                    class="form-control @error('due_date') is-invalid @enderror"
                                                    name="edit_date_updated"
                                                    value="{{ old('edit_date_updated', date('Y-m-d')) }}" required
                                                    autocomplete="edit_date_updated" autofocus readonly>

                                                @error('edit_date_updated')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td></td> <!--para mapantay ang table-->
                                        </tr>
                                    </tbody>

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ROOM RENT</th>
                                            <th>WATER BILL</th>
                                            <th>ELECTRIC BILL</th>
                                            <th>TOTAL RENT</th>
                                            <th>AMOUNT PAID</th>
                                            <th>BALANCE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="edit_room_rent" type="text" name="edit_room_rent" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_room_rent') is-invalid @enderror"
                                                    name="edit_room_rent" value="" required
                                                    autocomplete="edit_room_rent" autofocus readonly>

                                            </td>
                                            <td>
                                                <input id="edit_water_bill" type="text"
                                                    class="form-control @error('edit_water_bill') is-invalid @enderror"
                                                    name="edit_water_bill" value="" required
                                                    autocomplete="edit_water_bill" autofocus>

                                                @error('edit_water_bill')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input id="edit_electric_bill" type="text" name="edit_electric_bill"
                                                    class="form-control @error('edit_electric_bill') is-invalid @enderror"
                                                    name="edit_electric_bill" value="" required
                                                    autocomplete="edit_electric_bill" autofocus>

                                                @error('edit_electric_bill')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input id="edit_total_bill" type="text" name="edit_total_bill" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_total_bill') is-invalid @enderror"
                                                    name="edit_total_bill" value="" required
                                                    autocomplete="edit_total_bill" autofocus readonly>
                                            </td>



                                            <td>
                                                <input id="edit_amount_paid" type="text"
                                                    class="form-control @error('edit_amount_paid') is-invalid @enderror"
                                                    name="edit_amount_paid" value="" required
                                                    autocomplete="edit_amount_paid" autofocus
                                                    oninput="calculateEditTotalBillAndStatus()">

                                                @error('edit_amount_paid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                            <td>
                                                <input id="edit_balance" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_balance') is-invalid @enderror"
                                                    name="edit_balance" value="" required
                                                    autocomplete="edit_balance" autofocus readonly
                                                    oninput="calculateEditTotalBillAndStatus()">
                                            </td>

                                            <td>
                                                <input id="edit_status" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_status') is-invalid @enderror"
                                                    name="edit_status" value="" required autocomplete="edit_status"
                                                    autofocus readonly>
                                                @error('edit_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div style="margin-bottom: 5mm" class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff; background-color: #FFA500;"
                                    class="btnH30 btn">UPDATE</button>
                                <button type="reset"
                                    style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff; background-color: gray;"
                                    class="btnH30 btn">CLEAR</button>

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

                            <div class="input-group m-2" style="width:30%">
                                <input id="searchTenant" name="searchTenant" type="text"
                                    class="form-control form-control-sm" placeholder="Search">
                                <span class="input-group-text">
                                    &nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>

                            <div class="modal-body">
                                <table class="table" id="tenantTable">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var tenantData = {!! json_encode($tenant) !!};
</script>

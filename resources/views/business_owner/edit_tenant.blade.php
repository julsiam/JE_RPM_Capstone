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

                    <form class="row g-3 mt-4" action="#"
                        style="border: 0.5px solid #ced4da60; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding:5px">

                        <div>
                            <h3>EDIT TENANT</h3>
                        </div>



                        <div class="col-md-8 p-2">
                            <h5>PERSONAL INFORMATION</h5>
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Email</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="email" class="form-control"
                                            name="email" value="juls@gmail.com">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <a style="cursor: pointer; margin-top:20px; width: 75px;color:#fff;" href="#"
                                            class="btn btn-success me-2" class="btn btn-success me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Phone Number</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="phone_number" readonly value="09514791515">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Permanent Address</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="permanent_address" readonly value="Cebu City">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">First Name</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="first_name" readonly value="Juls">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Last Name</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="last_name" readonly value="Estorco">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Birthdate</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="first_name" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Age</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="last_name" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Gender</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="first_name" readonly value="">
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label style="color: rgb(128, 128, 128)">Occupation</label>
                                        <input style="border-color: rgb(166, 166, 166)" type="text" class="form-control"
                                            name="last_name" readonly value="">
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
                                <table id="InventoryData" class="table">
                                    <thead class="thead-dark ">
                                        <tr>
                                            {{-- <th>ID</th> --}}
                                            <th>LOCATION</th>
                                            <th>ROOM UNIT</th>
                                            <th>ROOM RENT</th>
                                            <th>WATER BILL</th>
                                            <th>ELECTRIC BILL</th>
                                            <th>TOTAL RENT</th>
                                            <th>DUES</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <th scope="row">01</th> --}}
                                            <td>Danao City, Cebu</td>
                                            <td>RJAE001</td>
                                            <td>5000.00</td>
                                            <td>6000.00</td>
                                            <td>08/01/2023</td>
                                            <td>6000.00</td>
                                            <td>08/01/2023</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div style="margin-bottom: 5mm" class="col-12">
                            <div class="d-flex justify-content-end">
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
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')


@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>
<div class="row p-5">

    <div class="col-md-7 p-4">
        <div style="margin-top:10%" class="card">
            <div class="modal-header p-2"
                style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px;">
                <div class="text-center col-md-12">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">Payment History
                    </h2>
                </div>

            </div>
            <div class="col-md-8 m-4">
                <div class="input-group" style="width:45%">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="sort-by">Month</label>
                    </div>

                    <select id="sort-by" class="form-select form-select-sm">
                        <option value=""></option>
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
            </div>

            <div class="card mt-5 p-2 m-2 mb-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Rent</th>
                            <th>Rental Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th>August</th>
                            <td>6500.00</td>
                            <td>Paid</td>
                            <td>
                                <button class="btn btn-primary btn-sm detailsBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5 p-5">
        <div style="margin-top: 10%;" class="card">
            <div class="modal-header p-2"
                style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px;">
                <div class="text-center col-md-12">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">Payment
                        Information
                    </h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8 justify-content-center">
                    <div style="background-color: yellow;">
                        <div class="mb-0 text-center p-2">
                            <h5 class="mb-0 text-center">J and E Rentals Property</h5>
                            <a href="">je.rentals2023@gmail.com</a>
                            <p class="text-center">09635294204</p>
                        </div>
                        <div class="p-2">
                            <p class="mb-0">Payment Instructions:</p>
                            <p class="mb-5">Please make the payment using one of the following methods.</p>
                            <h6>Bank Transfer</h6>
                            <p class="mb-0">Bank Name: Union Bank</p>
                            <p class="mb-0">Account Name: Christine Toledo</p>
                            <p class="mb-0">Account Number: 109664541244</p>
                            <h6>Online Payment</h6>
                            <p>To make an online payment, please scan the QR code on the right side or visit the
                                following
                                secure payment portal</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 justify-content-center">
                    <div class="text-center p-2">
                        <h5>Scan to Pay</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
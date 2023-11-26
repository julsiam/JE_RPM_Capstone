@extends('layouts.owner')

<style>
.form-section {
    display: none;
}

.form-section.current {
    display: inline;
}

.parsley-errors-list {
    color: red;
}
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="margin-top:15%" class="card">
                <div class="card-header"
                    style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px;">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 10px;padding-left: 23px;">
                        {{ __('Add Tenant') }}</h2>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.addTenant') }}" class="tenant_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="nav nav-fill my-3" style="background-color: #135083;">
                            <label class="nav-link shadow-sm border ml-2 text-white">Personal Information</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!--Left Column-->
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text col-md-4 text-md-end">{{ __('First Name') }}</span>

                                        <input id="first_name" type="text"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            name="first_name" value="{{ old('first_name') }}" required
                                            autocomplete="first_name" autofocus>

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text col-md-4 text-md-end">{{ __('Email Address') }}</span>

                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <!-- <div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> -->

                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Birthday') }}</span>

                                        <input id="birthdate" type="date"
                                            class="form-control @error('birthdate') is-invalid @enderror"
                                            name="birthdate" value="{{ old('birthdate') }}" required
                                            autocomplete="birthdate" placeholder="Year-Month-Day">

                                        @error('birthdate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Gender') }}</span>

                                        <div class="col-md-8">
                                            <select id="gender"
                                                class="form-select @error('gender') is-invalid @enderror" name="gender"
                                                required autocomplete="gender">
                                                <option value="" selected>Choose Gender</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="Female"
                                                    {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text col-md-4 text-md-end">{{ __('Occupation') }}</span>

                                        <input id="occupation" type="occupation"
                                            class="form-control @error('occupation') is-invalid @enderror"
                                            name="occupation" value="{{ old('occupation') }}" required
                                            autocomplete="occupation">

                                        @error('occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Password') }}</span>

                                        <div class="col-md-8">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!--Right Column-->
                                <div class="mb-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Last Name') }}</span>
                                        <input id="last_name" type="text"
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            name="last_name" value="{{ old('last_name') }}" required
                                            autocomplete="last_name" autofocus>

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text col-md-4 text-md-end">{{ __('Phone Number') }}</span>
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            placeholder="09XXXX" name="phone_number" value="{{ old('phone_number') }}"
                                            required autocomplete="phone_number" autofocus>

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Age') }}</span>
                                        <input id="age" type="age"
                                            class="form-control @error('age') is-invalid @enderror" name="age"
                                            value="{{ old('age') }}" required autocomplete="age" readonly>

                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text col-md-4 text-md-end">{{ __('Address') }}</span>
                                        <input id="address" type="address"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" required autocomplete="address">

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text col-md-4 text-md-end">{{ __('Work Address') }}</span>
                                        <input id="work_address" type="work_address"
                                            class="form-control @error('work_address') is-invalid @enderror"
                                            name="work_address" value="{{ old('work_address') }}" required
                                            autocomplete="work_address">

                                        @error('work_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="property_id" type="hidden"
                                    class="form-control @error('property_id') is-invalid @enderror" name="property_id"
                                    value="{{ old('property_id') }}" autocomplete="property_id" autofocus readonly>

                                @error('property_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!--Accomodation-->
                        <div class="nav nav-fill my-3" style="background-color: #135083;">
                            <label class="nav-link shadow-sm border ml-2 text-white">Accomodation Information</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!--Left Column-->
                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Location') }}</span>
                                    <div class="col-md-8">
                                        <select id="location"
                                            class="form-select @error('location') is-invalid @enderror" name="location"
                                            required autocomplete="location">
                                            <option value="" selected>Choose location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{ $location->location }}"
                                                {{ old('location') == $location->location ? 'selected' : '' }}>
                                                {{ $location->location }}</option>
                                            @endforeach
                                        </select>

                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Rent From') }}</span>
                                    <div class="col-md-8">
                                        <input id="rent_from" type="date"
                                            class="form-control @error('rent_from') is-invalid @enderror"
                                            name="rent_from" value="{{ old('rent_from', date('Y-m-d')) }}" required
                                            autocomplete="rent_from" autofocus>

                                        @error('rent_from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Room Fee') }}</span>
                                    <div class="col-md-8">
                                        <input id="room_fee_display" type="text"
                                            class="form-control @error('room_fee_display') is-invalid @enderror"
                                            name="room_fee_display" value="" required autocomplete="room_fee_display"
                                            autofocus readonly>
                                        @error('room_fee_display')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Electric Bill') }}</span>
                                    <div class="col-md-8">
                                        <input id="electric_bill" type="text"
                                            class="form-control @error('electric_bill') is-invalid @enderror"
                                            name="electric_bill" value="0.00" required autocomplete="electric_bill"
                                            autofocus>
                                        @error('electric_bill')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- value="{{ old('amount_paid') }}" --}}

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Amount Paid') }}</span>
                                    <div class="col-md-8">
                                        <input id="amount_paid" type="text"
                                            class="form-control @error('amount_paid') is-invalid @enderror"
                                            name="amount_paid" value="{{ old('amount_paid') }}" required
                                            autocomplete="amount_paid" autofocus
                                            oninput="calculateTotalBillAndStatus()">
                                        @error('amount_paid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Rental Status') }}</span>
                                    <div class="col-md-8">
                                        <input id="rentalStatus" type="text" name="rentalStatus"
                                            class="form-control @error('rentalStatus') is-invalid @enderror"
                                            name="rentalStatus" value="{{ old('rentalStatus') }}" required
                                            autocomplete="rentalStatus" autofocus readonly>

                                        @error('rentalStatus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!--Right Column-->
                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Room unit') }}</span>
                                    <div class="col-md-8">
                                        <select id="room_unit" class="form-select" name="room_unit" required>
                                            <option value="" selected>Choose room unit</option>
                                        </select>

                                        @error('room_unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('To/Due Date') }}</span>
                                    <div class="col-md-8">
                                        <input id="due_date" type="date"
                                            class="form-control @error('due_date') is-invalid @enderror" name="due_date"
                                            value="{{ old('due_date') }}" required autocomplete="due_date" autofocus>

                                        @error('due_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Water Bill') }}</span>
                                    <div class="col-md-8">
                                        <input id="water_bill" type="text"
                                            class="form-control @error('water_bill') is-invalid @enderror"
                                            name="water_bill" value="0.00" required autocomplete="water_bill" autofocus>
                                        @error('water_bill')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Total Bill') }}</span>
                                    <div class="col-md-8">
                                        <input id="total_bill" type="text"
                                            class="form-control @error('total_bill') is-invalid @enderror"
                                            name="total_bill" required autocomplete="total_bill" autofocus readonly>
                                        @error('total_bill')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Balance') }}</span>
                                    <div class="col-md-8">
                                        <input id="balance" type="text"
                                            class="form-control @error('balance') is-invalid @enderror" name="balance"
                                            value="{{ old('balance') }}" required autocomplete="balance" autofocus
                                            readonly oninput="calculateTotalBillAndStatus()">
                                        @error('balance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text col-md-4 text-md-end">{{ __('Move In Date') }}</span>
                                    <div class="col-md-8">
                                        <input id="rent_started" type="date"
                                            class="form-control @error('rent_started') is-invalid @enderror"
                                            name="rent_started" value="{{ old('rent_started', date('Y-m-d')) }}"
                                            required autocomplete="rent_started" autofocus>

                                        @error('rent_started')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!--Others-->
                        <div class="nav nav-fill my-3" style="background-color: #135083;">
                            <label class="nav-link shadow-sm  border ml-2 text-white">Other Information</label>
                        </div>
                        {{-- FILE UPLOAD --}}
                        <div class="row mb-3">
                            <label for="id_photo"
                                class="col-md-4 col-form-label text-md-end">{{ __('ID Photo') }}</label>

                            <div class="col-md-6">
                                <input id="id_photo" type="file" name="id_photo"
                                    class="form-control @error('id_photo') is-invalid @enderror"
                                    value="{{ old('id_photo') }}" required autocomplete="id_photo">

                                <!-- Hidden input to specify the file type -->
                                <input type="hidden" name="id_photo_file_type" value="id_photo">
                                <!-- Specify the type of the file -->

                                @error('id_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contract_pdf"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contract/MOA') }}</label>

                            <div class="col-md-6">
                                <input id="contract_pdf" type="file"
                                    class="form-control @error('contract_pdf') is-invalid @enderror" name="contract_pdf"
                                    value="{{ old('contract_pdf') }}" required autocomplete="contract_pdf"
                                    placeholder="Year-Month-Day">

                                <!-- Hidden input to specify the file type -->
                                <input type="hidden" name="contract_file_type" value="contract_pdf">
                                <!-- Specify the type of the file -->

                                @error('contract_pdf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 d-flex justify-content-center mt-4">
                            <button type="submit" class="btn" data-toggle="modal" data-target="#successModal" style="background-color: #FFA500; color:#135083;"> 
                                {{ __('Add Tenant') }}
                            </button>
                            <button type="reset"
                                style="cursor: pointer; margin-left: 10px; width: 100px; color: #fff; background-color: gray;"
                                class="btnH30 btn">Clear
                            </button>
                        </div>

                    </form>
                </div>

                {{-- FOR MODAL --}}
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                    aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Success</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Tenant added successfully!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
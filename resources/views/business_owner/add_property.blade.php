@extends('layouts.owner')

@section('content')
    <div class="container">
        {{-- @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top:10%" class="card">
                    <div class="text-center col-md-12 p-2 mb-2" style="background-color: #A9CCE8;">
                        <h2 style="color: #135083; font-weight:700; letter-spacing: 2px;">J and E Add Property</h2>
                    </div>

                    <form id="addPropertyForm" action="{{ route('property.addProperty') }}" method="POST">
                        @csrf
                        <div class="form-section">
                            <div class="row mb-3">
                                <label for="location"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>
                                <div class="col-md-6">
                                    <input id="location" type="text"
                                        class="form-control @error('location') is-invalid @enderror" name="location"
                                        value="{{ old('location') }}" required autocomplete="location" autofocus>
                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="room_unit"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Room Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="room_unit" type="text"
                                        class="form-control @error('room_unit') is-invalid @enderror" name="room_unit"
                                        value="{{ old('room_unit') }}" required autocomplete="room_unit" autofocus>

                                    @error('room_unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inclusion"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Inclusion') }}</label>

                                <div class="col-md-6">
                                    <input id="inclusion" type="text"
                                        class="form-control @error('inclusion') is-invalid @enderror" name="inclusion"
                                        value="{{ old('inclusion') }}" required autocomplete="inclusion" autofocus>

                                    @error('inclusion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="room_rent"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Room Fee') }}</label>

                                <div class="col-md-6">
                                    <input id="room_rent" type="text"
                                        class="form-control @error('room_rent') is-invalid @enderror" name="room_rent"
                                        value="{{ old('room_rent') }}" required autocomplete="room_rent">

                                    @error('room_rent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="status" type="text"
                                        class="form-control @error('status') is-invalid @enderror" name="status"
                                        value="Available" required autocomplete="status" readonly>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-8 offset-md-4">
                                <a style="cursor: pointer; width: 100px;color:#fff;" class="btn btn-sm btn-danger"
                                    onclick="history.back()">BACK
                                </a>
                                <button id="confirmAddPropertyBtn" type="button" class="btn btn-outline-dark btn-sm "
                                    style="background-color: #FFA500;">
                                    {{ __('ADD PROPERTY') }}
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- CONFIRM ADD PROPERTY MODAL --}}

        <div class="modal fade" id="confirmAddPropModal" tabindex="-1" aria-labelledby="confirmAddPropModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Add Property</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to add this property?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning confirmAdd">Confirm Add</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUCCESS ADD PROP MODAL --}}

        <div class="modal fade" id="successAddPropModal" tabindex="-1" aria-labelledby="confirmAddPropModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Successful!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Property Added Succcessfully!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

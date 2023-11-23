@extends('layouts.owner')

@section('content')
    <section style="background-color: #eee; margin-top: 5%">
        <div class="container py-5 mt-5">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <form method="POST" action="{{ route('edit_profile_pic') }}" enctype="multipart/form-data">
                                @csrf
                                 <img id="profilePicturePreview" src="{{ Auth::user()->profile_picture }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                <img id="profilePicturePreview"
                                    src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}"
                                    alt="Profile Picture" class="rounded-circle img-fluid" style="width: 150px;">

                                @if (Storage::disk('s3')->exists(Auth::user()->profile_picture))
                                    <img id="profilePicturePreview"
                                        src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}"
                                        alt="Profile Picture" class="rounded-circle img-fluid" style="width: 150px;">
                                @else
                                    <img id="profilePicturePreview" src="{{ Auth::user()->profile_picture }}" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 150px;">
                                @endif

                                <h5 class="my-3">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                                <p class="text-muted mb-1">J and E RPM Business Owner</p>
                                <p class="text-muted mb-4">{{ Auth::user()->address }}</p>

                                <div class="d-flex justify-content-center mb-2">
                                    <label for="profilePictureInput" class="btn btn-outline-primary ms-1">
                                        Edit Profile Picture
                                    </label>
                                    <input type="file" id="profilePictureInput" name="profilePictureInput"
                                        style="display: none;">

                                    <button class="btn btn-outline-primary ms-1" type="submit" id="saveButton"
                                        style="display: none;">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="mx-3 p-2">
                            <button type="button" class="btn btn-outline-dark profile_edit_btn mb-3" style="float:right;"
                                data-profile-id='{{ Auth::user()->id }}' data-bs-toggle="modal"
                                data-bs-target="#editProfile">Edit
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </div>
                        <div class="card-body">

                            <div class="row mt-2">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p id="first_name" class="text-muted mb-0">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->phone_number }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Birthdate</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->birthdate->format('F d, Y') }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Age</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->age }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ Auth::user()->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- EDIT PROFILE --}}

                <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileModal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAnnouncementModalLabel">{{ __('Edit Profile') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('edit_profile') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="p-2">
                                            <input id="edit_profile_id" required style="border-color: rgb(166, 166, 166)"
                                                type="hidden" class="form-control" name="edit_profile_id"
                                                value="{{ Auth::user()->id }}" readonly>
                                        </div>

                                        <label for="edit_firstname" class="form-label">{{ __('First Name') }}</label>
                                        <input id="edit_firstname" name="edit_firstname" type="text"
                                            class="form-control @error('edit_firstname') is-invalid @enderror"
                                            value="{{ Auth::user()->first_name }}" required autofocus>
                                        @error('edit_firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_lastname" class="form-label">{{ __('Last Name') }}</label>
                                        <input id="edit_lastname" name="edit_lastname" type="text"
                                            class="form-control @error('edit_lastname') is-invalid @enderror"
                                            value="{{ Auth::user()->last_name }}" required autofocus>
                                        @error('edit_lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_email" class="form-label">{{ __('Email') }}</label>
                                        <input id="edit_email" name="edit_email" type="text"
                                            class="form-control @error('edit_email') is-invalid @enderror"
                                            value="{{ Auth::user()->email }}" required autofocus>
                                        @error('edit_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_phone" class="form-label">{{ __('Phone Number') }}</label>
                                        <input id="edit_phone" name="edit_phone" type="text"
                                            class="form-control @error('edit_phone') is-invalid @enderror"
                                            value="{{ Auth::user()->phone_number }}" required autofocus>
                                        @error('edit_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_birthdate" class="form-label">{{ __('Birthdate') }}</label>
                                        <input id="edit_birthdate" name="edit_birthdate" type="date"
                                            class="form-control @error('edit_birthdate') is-invalid @enderror"
                                            value="{{ Auth::user()->birthdate }}" required autofocus>
                                        @error('edit_birthdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_age" class="form-label">{{ __('Age') }}</label>
                                        <input id="edit_age" name="edit_age" type="text"
                                            class="form-control @error('edit_age') is-invalid @enderror"
                                            value="{{ Auth::user()->age }}" required autofocus readonly>
                                        @error('edit_age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <label for="edit_address" class="form-label">{{ __('Address') }}</label>
                                        <input id="edit_address" name="edit_address" type="text"
                                            class="form-control @error('edit_address') is-invalid @enderror"
                                            value="{{ Auth::user()->address }}" required autofocus>
                                        @error('edit_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

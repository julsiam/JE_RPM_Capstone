@extends('layouts.owner')

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div style="margin-top:8%;" class="col-md-10">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items">
                        <h2>{{ __('Announcement') }}</h2>


                        <div class="input-group" style="width:30%">
                            <input id="search" name="search" type="text" class="form-control form-control-sm"
                                placeholder="Search announcement">
                            <button class="btn btn-primary btn-sm" type="button"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-search"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>

                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addAnnouncementModal"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                <path
                                    d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                            </svg>+</button>
                    </div>

                    <div id="announcementData" class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($announcements as $announcement)
                            <div class="card mb-4">
                                <div class="card-header d-flex">
                                    <h4 class="card-title">{{ $announcement->subject }}</h4> &nbsp; &nbsp; &nbsp;
                                    <button type="button" class="btn btn-outline-danger deleteBtn"
                                        value="{{ $announcement->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-trash3-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button> &nbsp; &nbsp;  
                                    <button type="button" class="btn btn-outline-dark deleteBtn"
                                        value="{{ $announcement->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </button>
                                </div>



                                <div class="card-body">
                                    <p class="card-text">{{ $announcement->details }}</p>
                                </div>

                                <div class="card-footer text-muted">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img style="width: 75px" src="{{ asset('image/gwapo1.jpg') }}" alt=""
                                                class="rounded-circle">
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title">{{ $announcement->user->first_name }}
                                                {{ $announcement->user->last_name }}</h5>
                                            <p style="font-size: 14px">J and E Rentals and Property Owner</p>
                                            <p style="font-size: 12px">
                                                {{ $announcement->date_created->format('F d, Y | g:i A') }} | Visible to:
                                                {{ $announcement->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Announcement Modal -->

    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnouncementModalLabel">{{ __('Add Announcement') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('announcement.addAnnouncement') }}"
                        onsubmit="return confirmAnnouncement()">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">{{ __('Subject') }}</label>
                            <input id="subject" type="text"
                                class="form-control @error('subject') is-invalid @enderror" name="subject"
                                value="{{ old('subject') }}" required autofocus>
                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">{{ __('Details') }}</label>
                            <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details" rows="4"
                                required>{{ old('details') }}</textarea>
                            @error('details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="visibleLocation"
                                class="form-label">{{ __('Choose LOCATION announcement is visible to:') }}</label>
                            <div class="col-md-6">
                                <select id="visibleLocation"
                                    class="form-select @error('visibleLocation') is-invalid @enderror"
                                    name="visibleLocation" autocomplete="visibleLocation">
                                    {{-- @foreach ($availableLocations as $location)
                                        <option value="{{ $location }}">{{ $location }}</option>
                                    @endforeach --}}
                                </select>

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- DELETE CONFIRMATION MODAL --}}

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="POST" action="{{ route('announcement.delete') }}">
                @csrf
                {{-- @method('DELETE') --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="announcement_delete_id" id="announcement_id">
                        Are you sure you want to delete this announcement?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>

                        {{-- <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



<script>
    function confirmAnnouncement() {
        return confirm("Are you sure you want to save this announcement?");
    }
</script>

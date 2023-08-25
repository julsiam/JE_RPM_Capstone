@extends('layouts.owner')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="margin-top:8%;" class="col-md-10">
                <div class="card">
                    <form action="{{ route('announcements.search') }}" method="GET" class="mb-3 p-4">
                        <div class="input-group">
                            <input type="text"id="keyword" name="keyword" class="form-control"
                                placeholder="Search by subject or details">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Announcement') }}</span>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addAnnouncementModal">{{ __('Add Announcement') }}</button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($announcements as $announcement)
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">{{ $announcement->subject }}</h4>
                                    {{-- <form action="{{ route('announcement.delete', $announcement) }}" method="post">
                                        @csrf
                                        @method('DELETE') --}}

                                    {{-- <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('announcement.delete', ['announcement'=>$announcement->id]) }}"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </button> --}}
                                    {{-- </form> --}}

                                    <button type="button" class="btn btn-outline-danger deleteBtn"
                                        value="{{ $announcement->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-trash3-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
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
                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                                name="subject" value="{{ old('subject') }}" required autofocus>
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
                                <select id="visibleLocation" class="form-select @error('visibleLocation') is-invalid @enderror"
                                    name="visibleLocation" autocomplete="visibleLocation">
                                    @foreach ($availableLocations as $location)
                                        <option value="{{ $location }}">{{ $location }}</option>
                                    @endforeach
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
            <form id="deleteForm" method="POST" action="{{ route('announcement.delete')}}">
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

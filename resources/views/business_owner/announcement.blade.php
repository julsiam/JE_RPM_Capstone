@extends('layouts.owner')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="margin-top:8%;" class="col-md-10">
                <div class="card">
                    <form action="{{ route('announcements.search') }}" method="GET" class="mb-3 p-4">
                        <div class="input-group">
                            <input type="text"id="keyword" name="keyword" class="form-control" placeholder="Search by subject or details">
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
                                <div class="card-header">
                                    <h4 class="card-title">{{ $announcement->subject }}</h4>
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
                                                {{ $announcement->date_created->format('F d, Y | g:i A') }}</p>
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
@endsection

<script>
    function confirmAnnouncement() {
        return confirm("Are you sure you want to save this announcement?");
    }
</script>

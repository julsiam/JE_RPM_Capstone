@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 mt-5">
            <div class="card mt-2">
                <div class="card-header">{{ __('Announcement') }}</div>

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
                                        <h5 class="card-title">{{ $announcement->user->first_name }} {{ $announcement->user->last_name }}</h5>
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
@endsection

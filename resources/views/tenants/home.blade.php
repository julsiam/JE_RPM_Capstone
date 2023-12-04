@extends('layouts.app')

@section('content')
<style>
    .annoucement_text {
    color: #135083;
    font-weight: 700;
    padding-top: 4px;
}
.card-header {
    background-color: #A9CCE8;
    letter-spacing: 2px;
}
.card-title {
    margin-bottom: 0;
    font-weight: 700;
    margin-top: auto;
}
.card {

color: #DC582A;
margin-bottom: 4%;
}
.card-text {
    color: #253031;
    font-weight: 600;

}

</style>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10 mt-5">
            <div class="card mt-2">
       
                <div class="card-header" style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8">
                    <h2 class="annoucement_text">Announcement</h2>
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

                            <div class="card-body" style="background: #EFEFEF;padding-bottom: 1px;padding-top: 30px;">
                                <p class="card-text">{!! nl2br(e($announcement->details)) !!}</p>
                            </div>

                            <div class="card-footer text-muted"style="height: 105px;background-color: #EFEFEF;border-style: none;">
                            <hr>
                                <div class="row align-items-center">
                                
                                    <div class="col-auto">
                                        <img style="max-width: 60px" src="{{ $announcement->user->profile_picture }}" alt=""
                                            class="rounded-circle">
                                    </div>
                                    <div class="col md-8">
                                        <h5 class="card-title" style="font-size: small;">{{ $announcement->user->first_name }} {{ $announcement->user->last_name }}</h5>
                                        <p style="font-size: smaller; margin-bottom: 0;">J and E Rentals and Property Owner</p>
                                        <p style="font-size: smaller; margin-bottom: 0;">
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

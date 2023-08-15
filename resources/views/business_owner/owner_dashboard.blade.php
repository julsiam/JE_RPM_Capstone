@extends('layouts.owner')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="margin-top:10%;" class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-group">
                    <div class="card border-primary mb-3" style="max-width: 18rem; margin-right: 10px; margin-bottom: 10px;">
                        <div class="card-header">Tenants</div>
                        <div class="card-body text-primary">
                            <h1 class="card-title text-center">50</h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>

                    <div class="card border-primary mb-3" style="max-width: 18rem; margin-right: 10px; margin-bottom: 10px;">
                        <div class="card-header">Maintenance Requests</div>
                        <div class="card-body text-primary">
                            <h1 class="card-title text-center">50</h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>

                    <div class="card border-primary mb-3" style="max-width: 18rem; margin-right: 10px; margin-bottom: 10px;">
                        <div class="card-header">Properties</div>
                        <div class="card-body text-primary">
                            <h1 class="card-title text-center">50</h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>

                    <div class="card border-primary mb-3" style="max-width: 18rem; margin-right: 10px;">
                        <div class="card-header">Dues</div>
                        <div class="card-body text-primary">
                            <h1 class="card-title text-center"></h1>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

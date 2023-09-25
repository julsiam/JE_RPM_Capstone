@extends('layouts.owner')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div style="margin-top:7%;" class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-group row d-flex align-items-center justify-content-center gap-3 mx-2">
                    <div class="card border-primary mb-3 shadow-sm p-3 mb-5 rounded col-12 col-md-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <select style="width: 35mm; height: 9mm" id="locs" class="form-select"
                                    @error('locs') is-invalid @enderror name="locs" autocomplete="locs">

                                </select>
                            </div>

                            <h3 id="tenantCount" class="card-title">{{ $totalTenants }}</h3>

                            <h4 class="card-name">Tenants</h4>
                        </div>
                    </div>

                    <div class="card border-dark mb-3 shadow-sm p-3 rounded col-12 col-md-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <select style="width: 35mm; height: 9mm" id="prop_locs" class="form-select"
                                    @error('prop_locs') is-invalid @enderror name="prop_locs" autocomplete="prop_locs">

                                </select>
                            </div>
                            <h3 id="propertyCount" class="card-title">Rooms: {{ $totalProperties }}</h3>
                            <h5 id="availPropertyCount" class="card-title">Available: {{ $availProperties }}</h5>
                            <h5 id="occupiedPropertyCount" class="card-title">Occupied: {{ $occupiedProperties }}</h5>

                            <h4 class="card-name">Properties</h4>
                        </div>
                    </div>

                    <div class="card border-light mb-3 shadow-sm p-3 mb-5 bg-warning rounded col-12 col-md-4 mb-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
                                    <path
                                        d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z" />
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z" />
                                </svg>
                            </div>
                            <h3 class="card-title">{{ $totalMaintenance }}</h3>
                            <h4 class="card-name">Maint. Request</h4>
                        </div>
                    </div>

                    <div class="card border-light mb-3 shadow-sm p-3 mb-5 bg-success rounded col-12 col-md-4 mb-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-calendar3" viewBox="0 0 16 16">
                                    <path
                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                    <path
                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                            </div>
                            <h3 class="card-title">50</h3>
                            <h4 class="card-name">Monthly Total Income</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-group row d-flex align-items-center justify-content-center gap-3 mx-3">
        <div class="container md-10">
            <div id="calendar">
            </div>

        </div>
        {{-- <div class="card border-light shadow-sm bg-light rounded col-3">
            <div class="card-body">
                <div class="card-header bg-light">
                    <div class="card-title">
                        <h5>Total Earnings for Rentals</h5>
                    </div>
                </div>
                <div class="class-description m-2">
                        <h6 style="color: #FFA500">Month of </h6>
                        <h5>Cebu City:</h5>
                        <h5>Concolacion:</h5>
                        <h5>Danao:</h5>
                </div>
                <div class="total m-2">
                    <h2>&#8369;</h2>
                </div>
            </div>
        </div>

        <div class="db_box card border-light  shadow-sm bg-light rounded col-6">
            <div class="card-body">
                <div class="card-header bg-light">
                    <div class="card-title">
                        <h5>Upcoming Birthdays</h5>
                    </div>
                </div>
                <div class="class-description m-2">
                    <h6 style="color: #FFA500">Month of </h6>
                </div>
            </div>
        </div>

        <div class="db_box card border-light shadow-sm  bg-light rounded col-3">
            <div class="card-body">
                <div class="card-header bg-light">
                    <div class="card-title">
                        <h5>Rooms Available</h5>
                    </div>
                </div>
                <div class="class-description m-2">
                    <h5>Cebu City</h5>
                    <h5>Concolacion</h5>
                    <h5>Danao</h5>

                </div>
            </div>
        </div> --}}
    </div>
@endsection

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
                    <div class="card border-light mb-3 shadow-sm p-3 mb-5 bg-primary rounded col-12 col-md-4 mb-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-people" viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                            </div>
                            <h3 class="card-title">50</h3>
                            <h4 class="card-name">Tenants</h4>
                        </div>
                    </div>

                    <div class="card border-light mb-3 shadow-sm p-3 mb-5 bg-secondary rounded col-12 col-md-4 mb-4">
                        <div class="card-body text-black">
                            <div class="svg-cont d-flex justify-content-md-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-houses" viewBox="0 0 16 16">
                                    <path
                                        d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z" />
                                </svg>
                            </div>
                            <h3 class="card-title">50</h3>
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
                            <h3 class="card-title">50</h3>
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
                            <h4 class="card-name">Rental Dues</h4>
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

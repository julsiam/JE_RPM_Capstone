@extends('layouts.owner')

<style>
.card-title {
    color: #003057;
    font-weight: 600;
}

option {
    color: #003057;
    font-weight: 600;
}

.card-name {
    color: #003057;
    font-weight: 700;
}

/*for scribbling effect*/

</style>

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
                <div class="card border-primary mb-3 shadow-sm p-1 mb-3 rounded col-12 col-md-4"
                    style="height: 170px;border-style: none;background-color:  #135083;">
                    <div class="card-body text-black">
                        <div class="svg-cont d-flex justify-content-md-end">
                            <select style="width: 35mm; height: 9mm" id="locs" class="form-select" @error('locs')
                                is-invalid @enderror name="locs" autocomplete="locs"> </select> &nbsp; 
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312
                                    10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0
                                    1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0
                                    0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042
                                    1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636
                                    1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                            </svg>
                        </div>
                        <h3 id="tenantCount" class="card-title" style="color: #FFFFFF;">{{ $totalTenants }}</h3>
                        <h4 class="card-name" style="color: #FFFFFF;">Tenants</h4>

                    </div>
                </div>

                <div class="card border-dark mb-3 shadow-sm p-2 mb-1 rounded col-12 col-md-4"
                    style="height: 170px;border-style: none;background-color: #A9CCE8;">
                    <div class="card-body text-black">
                        <div class="svg-cont d-flex justify-content-md-end">
                            <select style="width: 35mm; height: 9mm" id="prop_locs" class="form-select"
                                @error('prop_locs') is-invalid @enderror name="prop_locs" autocomplete="prop_locs">
                            </select>
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-houses" viewBox="0 0 16 16">
                                <path
                                    d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z" />
                            </svg>
                        </div>


                        <h3 id="propertyCount" class="card-title"  style="color: #003057;"> {{ $totalProperties }}</h3>
                        <h4 class="card-name">Properties</h4>
                        <div class="row">
                            <div class="col-6">
                                <h6 id="availPropertyCount" class="card-title"  style="color: #003057;">Available:
                                    {{ $availProperties }}</h6>
                            </div>
                            <div class="col-6">
                                <h6 id="occupiedPropertyCount" class="card-title" style="color: #003057;">Occupied:
                                    {{ $occupiedProperties }}
                                </h6>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border-warning mb-3 shadow-sm p-2 mb-1 rounded col-12 col-md-4"
                    style="height: 170px;border-style: none;background-color: #135083;">
                    <a style="text-decoration: none" href="{{ url('maintenance') }}">
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
                            <h3 class="card-title" style="color: #ffffff;">{{ $totalMaintenance }}</h3>
                            <h4 class="card-name" style="color: #ffffff;">Maint. Request</h4>
                        </div>
                    </a>
                </div>

                <div class="card border-success mb-3 shadow-sm p-2 mb-1 rounded col-12 col-md-4 "
                    style="height: 170px;border-style: none;background-color: #A9CCE8;">
                    <div class="card-body text-black">
                        <div class="svg-cont d-flex justify-content-md-end">
                            <select style="width: 35mm; height: 9mm" id="month_select" name="month_select"
                                class="form-select form-select-sm">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-cash-stack" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                <path
                                    d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                            </svg>
                        </div>
                        <h3 id="totalIncome" class="card-title" style="color: #003057;">₱ {{$totalMonthIncome}} </h3>
                        <h4 class="card-name" style="color: #003057;">Monthly Total Income</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>



<div class="row p-3">
    <div class="col-md-5 ">

    <div class="card mb-3 shadow-sm p-1 mb-3 rounded">
            <!-- Chart container -->
            <canvas id="lineChart" width="400" height="200"></canvas>
        </div>
        <div class="card mb-3 shadow-sm p-1 mb-3 rounded">
          
            <canvas id="lineChart" width="400" height="200"></canvas>
        </div>
</div>


    <div class="col-md-7">
    <div class="container md-10 mb-5">
        <div id="calendar"></div>
    </div>
    
    </div>
</div>





<div class="card-group col-md-4 row gap-3 mx-2">
        
    </div>
<div class="card-group row d-flex align-items-center justify-content-center gap-3 mx-3">
    
</div>
<!-- this is animate counter file -->
<!-- <script src="{{ asset('js/animateCounter.js') }}"></script> -->


<!-- Include the Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include your custom JavaScript file -->
<script src="{{ asset('js/lineChart.js') }}"></script>
@endsection
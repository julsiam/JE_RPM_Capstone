@extends('layouts.owner')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top:10%" class="card">
                    <div class="text-center col-md-12 p-2">
                        <h2>J and E Rental Properties</h2>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Room Unit</th>
                                    <th scope="col">Room Fee</th>
                                    <th scope="col">Inclusions</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Occupant</th>
                                </tr>
                            </thead>

                            <tbody id="tenantListBody">
                                @foreach ($properties as $property)
                                    <tr>
                                        <th>{{ $property->id }}</th>
                                        <td>{{ $property->location }}</td>
                                        <td>{{ $property->room_unit }}</td>
                                        <td>{{ $property->room_fee }}</td>
                                        <td>{{ $property->inclusion }}</td>
                                        <td>{{ $property->status }}</td>
                                        <td>
                                            @if ($property->user)
                                                {{ $property->user->first_name }} {{ $property->user->last_name }}
                                            @else
                                                No Tenant
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 p-4">
                        <div class="row" style=" float:left;">
                            <label class="col-form-label">Total Property</label>
                            <input style="width: 25%" type="text" class="form-control" id="totalProperties" disabled
                                value="{{ $totalProperties }}">

                        </div>

                        <div class="row mt-4" style=" float:right;">
                            <a style="cursor: pointer; margin-left: 10px; width: 140px;color:#fff;"
                                href="{{ url('add_property_form') }}" class="btn btn-success me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-house-add" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h4a.5.5 0 1 0 0-1h-4a.5.5 0 0 1-.5-.5V7.207l5-5 6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                    <path
                                        d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 1 0 1 0v-1h1a.5.5 0 1 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z" />
                                </svg> Add Property
                            </a>

                            <a style="cursor: pointer; margin-left: 10px; width: 140px;color:#fff;"
                                class="btnH30 btn btn-danger" onclick="history.back()">BACK
                            </a>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

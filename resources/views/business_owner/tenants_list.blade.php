@extends('layouts.owner')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="margin-top:15%" class="card">
                    <div class="text-center col-md-12 p-4">
                        <h2>J and E Rental Tenants</h2>
                    </div>
                    <div id="tenantListTable" style="display: none;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tenant ID</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            
                            <tbody id="tenantListBody">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

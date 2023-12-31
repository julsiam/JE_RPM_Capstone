@extends('layouts.owner')


@section('content')
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="container" style="margin-top: 7%">
    <div class="row justify-content-center" style="padding-left: 12px;font-size: medium;">
        <div style=" color: #135083;font-weight: 700;">Note: Add the properties first before adding anytenants.</div>
    </div>
    <div class="card mt-2" style="border-radius: 25px;">
        <div class="row justify-content-center"
            style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8; border-top-left-radius:10px; border-top-right-radius:10px;">
            <div class="col-md-6 ">
                <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">J and E Rental
                    Inactive Tenants
                </h2>
            </div>

            <div class="col-md-6 text-end p-2">
                {{-- INACTIVE --}}
                <a href="{{ route('tenants') }}" class="btn btn btn-outline-warning me-2" style="color:#135083;">Active Tenants
                </a>

                {{-- SHEET --}}
                <a href="{{ route('tenants_export') }}" class="btn btn-outline-success me-2"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-filetype-xls" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z" />
                    </svg></a>

                {{-- REFRESH --}}
                <a href="" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path
                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg></a>

                {{-- ADD TENANT --}}
                <a href="{{ route('add_tenant_form') }}" class="btn btn-warning me-2" class="btn btn-success me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                </a>

                {{-- BACK --}}
                <a onclick="history.back()" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                </a>
            </div>
        </div>


        <div class="card p-2">
            <table id="inactiveTenantsData" class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th hidden class="text-start">ID</th>
                        <th class="text-start">NAME</th>
                        <th class="text-start">EMAIL</th>
                        <th class="text-start">LOCATION</th>
                        <th class="text-start">ROOM UNIT</th>
                        <th class="text-center">DUES</th>
                        <th class="text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inactiveTenants as $inactive_tenant)
                    <tr>
                        <td hidden class="text-start" scope="row">{{ $inactive_tenant->id }}</td>

                        <td class="text-start">{{ $inactive_tenant->first_name }} {{ $inactive_tenant->last_name }}
                        </td>

                        <td class="text-start">{{ $inactive_tenant->email }}</td>

                        <td class="text-start">
                            @if ($inactive_tenant->tenantProperty)
                            {{ $inactive_tenant->tenantProperty->location }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="text-start">
                            @if ($inactive_tenant->tenantProperty)
                            {{ $inactive_tenant->tenantProperty->room_unit }}
                            @else
                            N/A
                            @endif
                        </td>

                        <td
                            class="text-center
                                @if ($inactive_tenant->rental && $inactive_tenant->rental->due_date->isToday()) text-danger fw-bold @endif">
                            @if ($inactive_tenant->rental)
                            {{ $inactive_tenant->rental->due_date->format('F d, Y') }}
                            @else
                            N/A
                            @endif
                        </td>

                        <td class="text-center">
                            {{ $inactive_tenant->rental->status }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

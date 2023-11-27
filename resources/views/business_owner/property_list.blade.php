@extends('layouts.owner')

@section('content')
<div class="container" style="margin-top: 10%">
    <div class="row justify-content-center" style="padding-left: 12px;font-size: medium;">
        <div class="" style=" color: #135083;font-weight: 700;">Note: Add the properties first before adding any
            tenants.</div>
    </div>
    <div class="container" style="margin-top: 10px">
        @if (Session::has('message'))
        <script>
        swal("Message", "{{ Session::get('message') }}", 'success', {
            button: true,
            button: 'OK'
        });
        </script>
        @endif

        <div class="card mt-2 mb-3">
            <div class="row justify-content-center"
                style="margin-left: inherit; margin-right: inherit; background-color:#A9CCE8">
                <div class="col-md-6 p-1">
                    <h2 style="color:#135083; font-weight: 700;padding-top: 15px;padding-left: 23px;">J and E Rental
                        Properties</h2>
                </div>

                <div class="col-md-6 text-end p-3">
                    {{-- PDF --}}
                    {{-- <a href="" class="btn btn btn-outline-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-file type-pdf"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                        </svg></a> --}}
                    {{-- SHEET --}}
                    <a href="{{route('properties_export')}}" class="btn btn-success me-2"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filetype-xls" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z" />
                        </svg></a>

                    {{-- REFRESH --}}
                    <a href="" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg></a>

                    {{-- ADD PROPERTY --}}
                    <a href="{{ url('add_property_form') }}" class="btn btn-success me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house-add" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h4a.5.5 0 1 0 0-1h-4a.5.5 0 0 1-.5-.5V7.207l5-5 6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                            <path
                                d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 1 0 1 0v-1h1a.5.5 0 1 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </a>

                    {{-- BACK --}}
                    <a onclick="history.back()" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg></a>
                </div>
            </div>
            <div class="p-2">
                <div class="d-flex justify-content-between" style="font-size: 110%">
                    <div class="col-form-label" style="color: #003057;font-weight: 700;">Total Properties:
                        {{ $totalProperties }}</div>
                </div>

                <div class="d-flex justify-content-between" style="font-size: 110%">
                    <div class="col-form-label" style="color: #003057;font-weight: 700;">Total <span class=" p-1"
                            style="background-color:#FFA500; border-radius: 10px;">Occupied</span>
                        : {{ $totalOccupiedProperties }}</div>
                </div>

                <div class="d-flex justify-content-between" style="font-size: 110%">
                    <div class="col-form-label" style="color: #003057;font-weight: 700;">Total
                        <span class=" p-1" style="background-color:#A9CCE8; border-radius: 10px;">Available</span>
                        : {{ $totalAvailProperties }}
                    </div>
                </div>
            </div>


            <div class="card p-2">
                <table id="propertyTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th hidden scope="col">ID</th>
                            <th scope="col">Location</th>
                            <th scope="col">Room Unit</th>
                            <th scope="col">Room Fee</th>
                            <th scope="col">Inclusions</th>
                            <th scope="col">Status</th>
                            <th scope="col">Occupant</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>

                    <tbody id="tenantListBody">
                        @foreach ($properties as $property)
                        <tr>
                            <th hidden>{{ $property->id }}</th>
                            <td>{{ $property->location }}</td>
                            <td>{{ $property->room_unit }}</td>
                            <td>{{ $property->room_fee }}</td>
                            <td>{{ $property->inclusion }}</td>
                            <td>
                                <!--change color when prompted-->
                                @if ($property->status == 'Occupied')
                                <span class="text-black p-1"
                                    style="background-color:#FFA500; border-radius: 10px;">Occupied</span>
                                @elseif ($property->status == 'Available')
                                <span class="text-black p-1"
                                    style="background-color:#A9CCE8; border-radius: 10px;">Available</span>
                                @else
                                {{ $property->status }}
                                @endif
                            </td>
                            <td>
                                @if ($property->user)
                                {{ $property->user->first_name }} {{ $property->user->last_name }}
                                @else
                                No Tenant
                                @endif
                            </td>
                            <td> <button class="btn btn-outline-primary  btn-sm propertyDetailsBtn"
                                    data-property-id='{{ $property->id }}' data-bs-toggle='modal'
                                    data-bs-target='#propertyModal'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    </svg></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- EDIT PROPERTY --}}

            <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="editProfileModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #A9CCE8;">
                            <h3 class="modal-title" id="addAnnouncementModalLabel" style="letter-spacing: 2px; color: #003057; font-weight: 700;">{{ __('Edit Property') }}</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color:#F2F2F3;">
                            <form method="POST" action="{{ route('edit_property') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="p-2">
                                        <input id="edit_property_id" required style="border-color: rgb(166, 166, 166)"
                                            type="hidden" class="form-control" name="edit_property_id" value=""
                                            readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <!--Left column-->
                                                <label for="edit_location"
                                                    class="form-label">{{ __('Location') }}</label>
                                                <input id="edit_location" name="edit_location" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_location') is-invalid @enderror"
                                                    value="{{ old('edit_location') }}" readonly>
                                                @error('edit_location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror


                                                <label for="edit_room_unit"
                                                    class="form-label">{{ __('Room Unit') }}</label>
                                                <input id="edit_room_unit" name="edit_room_unit" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_room_unit') is-invalid @enderror"
                                                    value="{{ old('edit_room_unit') }}" readonly>
                                                @error('edit_room_unit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <label for="edit_room_fee"
                                                    class="form-label">{{ __('Room Fee') }}</label>
                                                <input id="edit_room_fee" name="edit_room_fee" type="text"
                                                    class="form-control @error('edit_room_fee') is-invalid @enderror"
                                                    value="{{ old('edit_room_fee') }}" required autofocus>
                                                @error('edit_room_fee')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <!--Right Column-->
                                                <label for="edit_inclusions"
                                                    class="form-label">{{ __('Inclusions') }}</label>
                                                <input id="edit_inclusions" name="edit_inclusions" type="text"
                                                    class="form-control @error('edit_inclusions') is-invalid @enderror"
                                                    value="{{ old('edit_inclusions') }}" required autofocus>
                                                @error('edit_inclusions')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <label for="edit_occupant"
                                                    class="form-label">{{ __('Occupant') }}</label>
                                                <input id="edit_occupant" name="edit_occupant" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_occupant') is-invalid @enderror"
                                                    value="" required autofocus readonly>
                                                @error('edit_occupant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <label for="edit_status" class="form-label">{{ __('Status') }}</label>
                                                <input id="edit_status" name="edit_status" type="text" style="background-color: #d3d3d3;"
                                                    class="form-control @error('edit_status') is-invalid @enderror"
                                                    value="{{old('edit_status')}}" required autofocus readonly>
                                                @error('edit_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-dark"
                                        style="background-color: #FFA500;">{{ __('Update') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
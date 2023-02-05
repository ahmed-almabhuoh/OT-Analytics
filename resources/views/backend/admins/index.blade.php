@extends('backend.layouts.admin')

@section('title', 'Show all admins')

@section('styles')
    <style>
        #admin-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid rgb(115, 115, 248);
        }
    </style>
@endsection

@section('content')
    {{-- {{ dd($admins[0]->admin_status) }} --}}
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">Admins
                    <span class="d-block text-muted pt-2 font-size-sm">This table shows all admins in the system</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                        fill="#000000" opacity="0.3"></path>
                                    <path
                                        d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose
                                an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{ route('admins.create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>New Admin</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-checkable dataTable no-footer dtr-inline" id="kt_datatable"
                            role="grid" aria-describedby="kt_datatable_info" style="width: 1112px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 38px;" aria-sort="descending"
                                        aria-label="Order ID: activate to sort column ascending">Admin ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 54px;"
                                        aria-label="Country: activate to sort column ascending">Photo</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 41px;"
                                        aria-label="Ship City: activate to sort column ascending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 54px;"
                                        aria-label="Ship Address: activate to sort column ascending">E-mail</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 66px;"
                                        aria-label="Company Agent: activate to sort column ascending">Joined at</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 66px;"
                                        aria-label="Company Name: activate to sort column ascending">Last update</th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                        colspan="1" style="width: 73px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 125px;"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $admin->id }}</td>
                                        <td><img src="{{ Storage::url($admin->img) }}" alt="Admin Photo" id="admin-img">
                                        </td>
                                        <td>{{ $admin->fname . ' ' . $admin->lname }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                                        <td>{{ $admin->updated_at->diffForHumans() }}</td>
                                        <td style=""><span
                                                class="{{ $admin->admin_status }}">{{ ucfirst($admin->status) }}</span>
                                        </td>
                                        <td nowrap="nowrap" style="">
                                            <div class="dropdown dropdown-inline"> <a href="javascript:;"
                                                    class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
                                                    <span class="svg-icon svg-icon-md"> <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                    height="24"></rect>
                                                                <path
                                                                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                                                                    fill="#000000"></path>
                                                            </g>
                                                        </svg> </span> </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="navi flex-column navi-hover py-2">
                                                        <li
                                                            class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                                            Choose an action: </li>
                                                        <li class="navi-item"> <a href="#" class="navi-link"> <span
                                                                    class="navi-icon"><i class="la la-print"></i></span>
                                                                <span class="navi-text">Print</span> </a> </li>
                                                        <li class="navi-item"> <a href="#" class="navi-link"> <span
                                                                    class="navi-icon"><i class="la la-copy"></i></span>
                                                                <span class="navi-text">Copy</span> </a> </li>
                                                        <li class="navi-item"> <a href="#" class="navi-link"> <span
                                                                    class="navi-icon"><i
                                                                        class="la la-file-excel-o"></i></span> <span
                                                                    class="navi-text">Excel</span> </a> </li>
                                                        <li class="navi-item"> <a href="#" class="navi-link"> <span
                                                                    class="navi-icon"><i
                                                                        class="la la-file-text-o"></i></span>
                                                                <span class="navi-text">CSV</span> </a> </li>
                                                        <li class="navi-item"> <a href="#" class="navi-link"> <span
                                                                    class="navi-icon"><i
                                                                        class="la la-file-pdf-o"></i></span>
                                                                <span class="navi-text">PDF</span> </a> </li>
                                                    </ul>
                                                </div>
                                            </div> <a href="{{ route('admins.edit', Crypt::encrypt($admin->id)) }}"
                                                class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"> <span
                                                    class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24"></rect>
                                                            <path
                                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                                            </path>
                                                            <rect fill="#000000" opacity="0.3" x="5"
                                                                y="20" width="15" height="2"
                                                                rx="1">
                                                            </rect>
                                                        </g>
                                                    </svg> </span> </a> <button
                                                onclick="confirmDestroy('{{ Crypt::encrypt($admin->id) }}', this)"
                                                class="btn btn-sm btn-clean btn-icon" title="Delete"> <span
                                                    class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24"></rect>
                                                            <path
                                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                                fill="#000000" fill-rule="nonzero"></path>
                                                            <path
                                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                                fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg> </span> </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">
                            Showing 1 to 10 of 50 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7 dataTables_pager">
                        <div class="dataTables_length" id="kt_datatable_length"><label>Display <select
                                    name="kt_datatable_length" aria-controls="kt_datatable"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select></label></div>
                        <div class="dataTables_paginate paging_simple_numbers" id="kt_datatable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="kt_datatable_previous"><a
                                        href="#" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0"
                                        class="page-link"><i class="ki ki-arrow-back"></i></a></li>
                                <li class="paginate_button page-item active"><a href="#"
                                        aria-controls="kt_datatable" data-dt-idx="1" tabindex="0"
                                        class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="kt_datatable"
                                        data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="kt_datatable"
                                        data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="kt_datatable"
                                        data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="kt_datatable"
                                        data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item next" id="kt_datatable_next"><a href="#"
                                        aria-controls="kt_datatable" data-dt-idx="6" tabindex="0" class="page-link"><i
                                            class="ki ki-arrow-next"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}

                {{ $admins->links() }}
            </div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function add() {
            const formData = new FormData();
            formData.append('fname', document.getElementById('fname').value);
            formData.append('lname', document.getElementById('lname').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('status', document.getElementById('status').checked ? 1 : 0);
            axios.post('/ot/admins', formData)
                .then(function(response) {
                    // console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('creation-form').reset();
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    // console.log(error);
                });
        }

        function confirmDestroy(id, refrance) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({

                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    destoy(id, refrance);
                }
            })
        }

        function destoy(id, refrance) {
            axios.delete('/ot/admins/' + id)
                .then(function(response) {
                    // handle success
                    refrance.closest('tr').remove();
                    showDeletingMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    showDeletingMessage(error.response.data);
                })
                .then(function() {
                    // always executed
                });
        }

        function showDeletingMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection

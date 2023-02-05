@extends('backend.layouts.admin')

@section('title', 'Add new admin')

@section('styles')
    <style>
        .checkbox input[type="checkbox"] span {
            margin: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Add New Admin
            </h3>
        </div>
        <!--begin::Form-->
        <form id="creation-form">
            <div class="card-body">
                <div class="form-group mb-8">
                    <div class="alert alert-custom alert-default" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                        <div class="alert-text">
                            After adding new admin <code>Super-Admin</code> all permissions will given for new admin
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">First name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="fname"
                            placeholder="Enter admin first name ..." />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Last name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="lname"
                            placeholder="Enter admin last name ..." />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="" id="email"
                            placeholder="Enter admin email: almadar@ot.com.sa" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Phone no.</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" id="phone"
                            placeholder="Enter admin phone ..." />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Password</label>
                    <div class="col-10">
                        <input class="form-control" type="password" value="" id="password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Account Status</label>
                    <div class="col-10">
                        <label class="checkbox">
                            <input type="checkbox" checked="checked" name="status" id="status">
                            <span></span>Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Admin Image Profile</label>
                    <div></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose image</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="button" onclick="add()" class="btn btn-success mr-2">Insert</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>


        </form>
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
                    window.location.href = '/ot/admins';
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    // console.log(error);
                });
        }
    </script>
@endsection

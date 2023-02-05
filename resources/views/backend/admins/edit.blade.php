@extends('backend.layouts.admin')

@section('title', 'Add new admin')

@section('styles')
    <style>
        .checkbox input[type="checkbox"] span {
            margin: 15px;
        }

        .admin-photo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            gap: 100px;
        }

        .admin-photo img {
            border-radius: 50%;
            border: 2px solid blue;
            padding: 5px;
        }

        .admin-photo li {
            font-size: 17px;
            list-style: none;
            margin: 15px;
            font-weight: bold;
        }

        .admin-photo ul li .admin-info {
            color: gray;
            font-weight: normal;
        }
    </style>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Admin Details: {{ $admin->fname . ' ' . $admin->lname }}
            </h3>
        </div>
        <!--begin::Form-->
        <form id="creation-form">
            <div class="card-body">
                <div class="admin-photo">
                    <img src="{{ Storage::url($admin->img) }}" alt="Admin Photo">
                    <ul>
                        <li>Joined at <p class="admin-info">{{ $admin->created_at->diffForHumans() ?? '-' }}</p>
                        </li>
                        <li>Last update <p class="admin-info">{{ $admin->updated_at->diffForHumans() ?? '-' }}</p>
                        </li>
                        <li>Last login <p class="admin-info">{{ $admin->last_login ?? '-' }}</p>
                        </li>
                    </ul>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">First name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $admin->fname }}" id="fname"
                            placeholder="Enter admin first name ..." />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Last name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $admin->lname }}" id="lname"
                            placeholder="Enter admin last name ..." />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="{{ $admin->email }}" id="email"
                            placeholder="Enter admin email: almadar@ot.com.sa" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Phone no.</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $admin->phone }}" id="phone"
                            placeholder="Enter admin phone ..." />
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-2 col-form-label">Password</label>
                    <div class="col-10">
                        <input class="form-control" type="password" value="" id="password" />
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Account Status</label>
                    <div class="col-10">
                        <label class="checkbox">
                            <input type="checkbox" name="status" id="status"
                                @if ($admin->status === 'active') checked="checked" @endif>
                            <span></span>Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Change Admin Photo</label>
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
                        <button type="button" onclick="update('{{ Crypt::encrypt($admin->id) }}')"
                            class="btn btn-success mr-2">Update</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function update(id) {
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('fname', document.getElementById('fname').value);
            formData.append('lname', document.getElementById('lname').value);
            formData.append('email', document.getElementById('email').value);
            // formData.append('password', document.getElementById('password').value);
            formData.append('phone', document.getElementById('phone').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('status', document.getElementById('status').checked ? 1 : 0);
            axios.post('/ot/admins/' + id, formData)
                .then(function(response) {
                    // console.log(response);
                    toastr.success(response.data.message);
                    // document.getElementById('creation-form').reset();
                    window.location.href = '/ot/admins';
                })
                .catch(function(error) {
                    toastr.error(error.response.data.message);
                    // console.log(error);
                });
        }
    </script>
@endsection

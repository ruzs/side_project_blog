<div id="modal-new-user-form" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-user-form-label" aria-hidden="true">
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h3 id="modal-user-form-label" class="modal-title">Create user</h3>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Name</label>
                                <input name="name" class="form-control" placeholder="Name" type="text">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Account</label>
                                <input name="account" class="form-control" placeholder="Account" type="text">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Password</label>
                                <input name="password" class="form-control" placeholder="Password" type="password">
                            </div>
                        </div>
                        <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPassword()">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Password Confirmation</label>
                                <input name="password_confirmation" class="form-control" placeholder="Password" type="password">
                            </div>
                        </div>
                        <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPasswordConfirmation()">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100 justify-content-between">
                        <button type="button" class="btn btn-danger p-2 col-auto col-lg-auto" data-dismiss="modal">Close</button>
                        <div class="col-8 col-lg-5">
                            <div class="row justify-content-between">
                                <input type="reset" value="Reset" class="btn btn-success p-2 col-auto">
                                <input type="submit" value="Submit" class="btn btn-primary p-2 col-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- user All Modal -->
<div id="modal-all-user-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-user-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-user-form-label" class="modal-title">All user</h3>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 table-responsive">
                    <table id='user_edit_table' class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width:10%">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Account</th>
                                <th scope="col" style="width:10%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$user->id == 1)

                            @if (@$users && count($users))
                            @foreach ($users as $key => $user)
                            <tr>
                                <td scope="row" >{{$key+1}}</td>
                                <td class="font-weight-bold">{{$user->name}}</td>
                                <td class="font-weight-bold">{{$user->account}}</td>
                                <td><button class="btn btn-outline-primary btn-sm m-1 p-2 user_edit_btn" data-toggle="modal" data-target="#modal-edit-user-form" data-id='{{$user->id}}' data-url='{{ route('user.update', $user->id) }}'><i class="fa-solid fa-pen-to-square"></i></button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan='4'>
                                    <a href="javascript:void(0)" class="nav-link disabled">Your user not found</a>
                                </td>
                            </tr>
                            @endif
                            @else
                            @if (@$user)
                            <tr>
                                <td scope="row" >1</td>
                                <td class="font-weight-bold">{{$user->name}}</td>
                                <td class="font-weight-bold">{{$user->account}}</td>
                                <td><button class="btn btn-outline-primary btn-sm m-1 p-2 user_edit_btn" data-toggle="modal" data-target="#modal-edit-user-form" data-id='{{$user->id}}' data-url='{{ route('user.update', $user->id) }}'><i class="fa-solid fa-pen-to-square"></i></button></td>
                            </tr>
                            @else
                            <tr>
                                <td colspan='4'>
                                    <a href="javascript:void(0)" class="nav-link disabled">Your user not found</a>
                                </td>
                            </tr>
                            @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100 justify-content-between">
                    <button type="button" class="btn btn-danger p-2 col-4 col-lg-1" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- user Form Modal -->
<div id="modal-edit-user-form" class="modal fade shadow-sm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-user-form-label" aria-hidden="true">
    <form action="#" method="post">
        @csrf
        @if (@$rows)
            <input name="_method" type="hidden" value="PATCH">
        @endif
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h3 id="modal-edit-user-form-label" class="modal-title">Edit user</h3>
                    <button id="edit_user_delete" type="button" class="btn-delete-event btn btn-outline-secondary btn-sm ml-auto">
                        <i class="fa fa-solid fa-trash"></i> Delete
                    </button>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Name</label>
                                <input name="name" class="form-control" placeholder="Name" type="text" value="">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Account</label>
                                <input name="account" class="form-control" placeholder="Account" type="text" value="">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="New Password" value="">
                            </div>
                        </div>
                        <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPassword()">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Password Confirmation</label>
                                <input type="password" name="password_confirmation"  class="form-control" placeholder="Password"  value="">
                            </div>
                        </div>
                        <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPasswordConfirmation()">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Role</label>
                                <select class="form-control" name="role">
                                    @foreach ($user_roles as$key => $role)
                                        <option value="{{$role->id}}" >{{$role->name}}-{{$role->guard_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100 justify-content-between">
                        <button type="button" class="btn btn-danger p-2 col-4 col-lg-auto" data-dismiss="modal">Close</button>
                        <div class="col-8 col-lg-3">
                            <div class="row justify-content-end">
                                <input type="submit" value="Submit" class="btn btn-primary p-2 col-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function showPassword() {
        let type = $("input[name='password']").attr('type');
        
        if (type ==='password') {
            $("input[name='password']").attr('type', 'text');
        } else {
            $("input[name='password']").attr('type', 'password');
        }
    }
    function showPasswordConfirmation() {
        let type2 = $("input[name='password_confirmation']").attr('type');

        if (type2 ==='password') {
            $("input[name='password_confirmation']").attr('type', 'text');
        } else {
            $("input[name='password_confirmation']").attr('type', 'password');
        }
    }
</script>
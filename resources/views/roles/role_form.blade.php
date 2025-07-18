<div id="modal-new-role-form" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-role-form-label" aria-hidden="true">
    <form action="{{ route('role.store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h3 id="modal-role-form-label" class="modal-title">Create role</h3>
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
                                <label class="font-weight-bold">Protect</label>
                                <input name="protect" class="form-control" placeholder="Protect" type="number">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>guard_name</label>
                                <input name="guard_name" class="form-control" placeholder="guard_name" type="text">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold">remark</label>
                                <input name="remark" class="form-control" placeholder="" type="text">
                            </div>
                        </div>
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

<!-- role All Modal -->
<div id="modal-all-role-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-role-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-role-form-label" class="modal-title">All role</h3>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 table-responsive">
                    <table id='role_edit_table' class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width:10%">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Protect</th>
                                <th scope="col">Guard Name</th>
                                <th scope="col" style="width:10%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(@auth()->user()->id == 1)
                            @if (@$roles && count($roles))
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td scope="row" >{{$key+1}}</td>
                                <td class="font-weight-bold">{{$role->name}}</td>
                                <td class="font-weight-bold">{{$role->protect}}</td>
                                <td class="font-weight-bold">{{$role->guard_name}}</td>
                                <td><button class="btn btn-outline-primary btn-sm m-1 p-2 role_edit_btn" data-toggle="modal" data-target="#modal-edit-role-form" data-id='{{$role->id}}' data-url='{{ route('role.update', $role->id) }}'><i class="fa-solid fa-pen-to-square"></i></button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan='4'>
                                    <a href="javascript:void(0)" class="nav-link disabled">Your role not found</a>
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

<!-- role Form Modal -->
<div id="modal-edit-role-form" class="modal fade shadow-sm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-role-form-label" aria-hidden="true">
    <form action="#" method="post">
        @csrf
        @if (@$rows)
            <input name="_method" type="hidden" value="PATCH">
        @endif
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h3 id="modal-edit-role-form-label" class="modal-title">Edit role</h3>
                    <button id="edit_role_delete" type="button" class="btn-delete-event btn btn-outline-secondary btn-sm ml-auto">
                        <i class="fa fa-solid fa-trash"></i> Delete
                    </button>
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
                                <label class="font-weight-bold">Protect</label>
                                <input name="protect" class="form-control" placeholder="Protect" type="number">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>guard_name</label>
                                <input name="guard_name" class="form-control" placeholder="guard_name" type="text">
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold">remark</label>
                                <input name="remark" class="form-control" placeholder="" type="text">
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
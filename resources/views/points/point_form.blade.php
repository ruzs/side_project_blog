<!-- Point All Modal -->
<div id="modal-all-shareholder-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-shareholder-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-shareholder-form-label" class="modal-title">All Point</h3>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 table-responsive">
                    <table id='shareholder_edit_table' class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width:10%">#</th>
                                <th scope="col">Count</th>
                                <th scope="col">Total Point</th>
                                <th scope="col">Created At</th>
                                <th scope="col" style="width:10%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$points && count($points))
                                @foreach ($points as $key => $point)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td class="font-weight-bold">{{$point->count}}</td>
                                    <td>{{$point->total_point}}</td>
                                    <td>{{date('Y/m/d H:i:s',strtotime($point->created_at))}}
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm m-1 p-2 shareholder_edit_btn" data-toggle="modal" data-target="#modal-edit-shareholder-form" data-id='{{$point->count}}' data-url='{{ route('shareholder.update', $point->count) }}'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan='4'>
                                    <a href="javascript:void(0)" class="nav-link disabled">Your Point not found</a>
                                </td>
                            </tr>
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

<!-- Point Form Modal -->
<div id="modal-edit-shareholder-form" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-shareholder-form-label" aria-hidden="true">
    {{-- <form action="#" method="shareholder"> --}}
    <form action="#" method="POST">
        @csrf
        @if (@$shareholders)
            {{-- <input name="_method" type="hidden" value="POST"> --}}
            @method('PATCH')
            <input type="hidden" name="count" value="">
        @endif
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-edit-shareholder-form-label" class="modal-title">Edit Point</h3>
                    {{-- <button id="edit_shareholder_delete" type="submit" class="btn-delete-event btn btn-outline-secondary btn-sm ml-auto">
                        <i class="fa fa-solid fa-trash"></i> Delete
                    </button> --}}
                    <button id='edit_shareholder_close_top' type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($shareholders->sortByDesc('last_month_point')  as $key => $shareholder)
                        @if (count($shareholder->hasRoles) != 0)
                            <div class="col-xl-12 mb-2">
                                <div class="form-group">
                                    <label class="text-success">{{ $shareholder->name }} : </label>
                                    <input name="point{{$shareholder->id}}" data-id="{{$shareholder->id}}" class="point border-info form-control font-weight-bold text-danger" placeholder="Point" type="number" value="">
                                </div>
                            </div>
                        @endif
                        @endforeach
                        {{-- <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Title</label>
                                <input name="title" class="form-control" placeholder="Title" type="text" value="">
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100 justify-content-between">
                        <button id='edit_shareholder_close' type="button" class="btn btn-danger p-2 col-4 col-lg-1" data-dismiss="modal">Close</button>
                        <div class="col-8 col-lg-3">
                            <div class="row justify-content-end">
                                <input type="submit" value="Submit" class="btn btn-primary p-2 col-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

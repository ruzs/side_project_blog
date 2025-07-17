{{-- @section('post-form-modal') --}}
<!-- Post Form Modal -->
<div id="modal-new-post-form" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-post-form-label" aria-hidden="true">
    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-post-form-label" class="modal-title">Create Post</h3>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Title</label>
                                <input name="title" class="form-control" placeholder="Title" type="text">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Subtitle</label>
                                <input name="subtitle" class="form-control" placeholder="Subtitle" type="text">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Category</label>
                                <select name="category_id" id="select_category" class="form-select rounded select2bt4" >
                                    <option value="0">無分類</option>
                                    @foreach ($posts as  $key => $post)
                                        <option value="{{$post->id}}">{{$post->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Content</label>
                                <textarea id="new_textarea" name="content" class="form-control" placeholder="Content" cols="30" rows="15"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100 justify-content-between">
                        <button type="button" class="btn btn-danger p-2 col-auto col-lg-auto" data-dismiss="modal">Close</button>
                        <div class="col-8 col-lg-3">
                            <div class="row justify-content-between">
                                <input type="reset" value="Reset" class="btn btn-success p-2 col-5">
                                <input type="submit" value="Submit" class="btn btn-primary p-2 col-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- <script>
    $('#select_category').select2({
        theme: 'bootstrap4',
        tags: true,
    });
    console.log($('title').val());

</script> --}}
{{-- @endsection --}}

<!-- Post All Modal -->
<div id="modal-all-post-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-post-form-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-post-form-label" class="modal-title">All Post</h3>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 table-responsive">
                    <table id='post_edit_table' class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width:10%">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Subtitle</th>
                                @if (auth()->user()->id==1)
                                <th scope="col">Poster</th>
                                @endif
                                <th scope="col">Last Update At</th>
                                <th scope="col" style="width:10%">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (@$rows && count($rows))
                                @foreach ($rows as $key => $row)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td class="font-weight-bold">{{$row->title}}</td>
                                    <td>{{$row->subtitle}}</td>
                                    @if (auth()->user()->id==1)
                                    <td>{{$row->creator->name}}</td>
                                    @endif
                                    <td>{{date('M d, Y H:i',strtotime($row->updated_at))}}
                                    <td><button class="btn btn-outline-primary btn-sm m-1 p-2 post_edit_btn" data-toggle="modal" data-target="#modal-edit-post-form" data-id='{{$row->id}}' data-url='{{ route('post.update', $row->id) }}'><i class="fa-solid fa-pen-to-square"></i></button></td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan='4'>
                                    <a href="javascript:void(0)" class="nav-link disabled">Your Post not found</a>
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

<!-- Post Form Modal -->
<div id="modal-edit-post-form" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal-post-form-label" aria-hidden="true">
    <form action="#" method="post">
        @csrf
        @if (@$rows)
            <input name="_method" type="hidden" value="PATCH">
        @endif
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal-edit-post-form-label" class="modal-title">Edit Post</h3>
                    <button id="edit_post_delete" type="submit" class="btn-delete-event btn btn-outline-secondary btn-sm ml-auto">
                        <i class="fa fa-solid fa-trash"></i> Delete
                    </button>
                    <button id='edit_post_close_top' type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
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
                                <label class="font-weight-bold"><span class="required">*</span>Title</label>
                                <input name="title" class="form-control" placeholder="Title" type="text" value="">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Subtitle</label>
                                <input name="subtitle" class="form-control" placeholder="Subtitle" type="text">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Category</label>
                                <select name="category_id" id="select_edit_category" class="form-select rounded select2bt4" >
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label class="font-weight-bold"><span class="required">*</span>Content</label>
                                <textarea id="edit_textarea" name="content" class="form-control" placeholder="Content" cols="30" rows="15"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100 justify-content-between">
                        <button id='edit_post_close' type="button" class="btn btn-danger p-2 col-4 col-lg-1" data-dismiss="modal">Close</button>
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




{{-- @section('reminder-form-modal')
<!-- Reminder Form Modal -->
<div class="modal fade" id="modal-reminder-form" tabindex="-1" role="dialog" aria-labelledby="modal-reminder-form-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-reminder-form-label">Create Reminder</h5>
                <button type="button" class="btn-delete-event btn btn-outline-secondary btn-sm ml-auto">
                    <i class="fa fa-solid fa-trash"></i> Delete
                </button>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><span class="required">*</span>Title</label>
                    <input id="reminder-title" type="text" class="form-control">
                    <input type="hidden" id="reminder-id">
                    <p class="error invalid-feedback"></p>
                </div>
                <div class="form-group">
                    <label><span class="required">*</span>Type</label>
                    <select id="reminder-type" class="form-control select2bs4-nSearch">
                        <option value="0">--{{ config('messages.Select_an_option') }}--</option>
                        @foreach (config('constants.dayoff_types') as $dayoff_type)
                        <option value="{{ $dayoff_type['value'] }}">{{ $dayoff_type['label'] }}</option>
                        @endforeach
                    </select>
                    <p class="error invalid-feedback"></p>
                </div>
                <div class="form-group">
                    <label><span class="required">*</span>Person</label>
                    <select id="reminder-person" class="form-control select2bs4-nSearch">
                        <option value="0">--{{ config('messages.Select_an_option') }}--</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <p class="error invalid-feedback"></p>
                </div>
                <div class="form-group">
                    <label><span class="required">*</span>Date</label>
                    <div class="row">
                        <div class="col-11 col-sm">
                            <input id="reminder-start" type="date" class="form-control" value="">
                            <p class="error invalid-feedback"></p>
                        </div>
                        <div class="col-auto">
                            <span class="align-middle">~</span>
                        </div>
                        <div class="col-11 col-sm mt-2 mt-sm-0">
                            <input id="reminder-end" type="date" class="form-control" value="">
                            <p class="error invalid-feedback"></p>
                        </div>
                    </div>
                    <p class="error invalid-feedback"></p>
                </div>
                <div class="form-group">
                    <label>Remark</label>
                    <input id="reminder-remark" type="text" class="form-control" value="">
                    <p class="error invalid-feedback"></p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="modal-reminder-form-submit" data-action="create" class="btn btn-primary ml-auto">
                    <div class="spinner-border spinner-border-sm m-1 command-loader" role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('reminder-view-modal')
<!-- Reminder View Modal -->
<div class="modal fade" id="modal-reminder-view" tabindex="-1" role="dialog" aria-labelledby="modal-reminder-view-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-reminder-view-label">View Reminder</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Title</label>
                    <div id="reminder-view-title" class="form-control-show"></div>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <div id="reminder-view-type" class="form-control-show"></div>
                </div>
                <div class="form-group">
                    <label>Person</label>
                    <div id="reminder-view-person" class="form-control-show"></div>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <div class="row">
                        <div class="col-11 col-sm">
                            <div id="reminder-view-start" class="form-control-show"></div>
                        </div>
                        <div class="col-auto">
                            <span class="align-middle">~</span>
                        </div>
                        <div class="col-11 col-sm mt-2 mt-sm-0">
                            <div id="reminder-view-end" class="form-control-show"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Remark</label>
                    <div id="reminder-view-remark" class="form-control-show"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('task-form-modal')
<!-- Task Form Modal -->
<div class="modal fade" id="modal-task-form" tabindex="-1" role="dialog" aria-labelledby="modal-task-form-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-task-form-label">Edit Task</h5>
                <button type="button" class="btn-delete-task btn btn-outline-secondary btn-sm ml-auto">
                    <i class="fa fa-solid fa-trash"></i> Delete
                </button>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="layout_form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="continue" value="0" />
                    <div id="task-form-content"></div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="modal-task-form-close" class="btn btn-default ml-auto" data-dismiss="modal" style="display: none;">Close</button>
                <button type="button" id="modal-task-form-cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="modal-task-form-submit" data-action="create" class="btn btn-primary ml-auto">
                    <div class="spinner-border spinner-border-sm m-1 command-loader" role="status" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('reminder-form-js')
<script>
    /** common function **/
    // event types
    const EVENT_TYPE_WORK = "{{ config('constants.task_types.work.value') }}";
    const EVENT_TYPE_REMINDER = "{{ config('constants.task_types.reminder.value') }}";
    const EVENT_TYPE_DAYOFF = "{{ config('constants.task_types.dayoff.value') }}";
    const EVENT_TYPE_PHILIPPINES = "{{ config('constants.holiday_types.philippines') }}";
    const EVENT_TYPE_TAIWAN = "{{ config('constants.holiday_types.taiwan') }}";

    // modal process status
    var eventStatus = {
        status: 1, // now processing
        normal: 1, // showing reminder form
        delete_checking: 2, // checking delete reminder 
        delete_checked: 3,
    };

    // Uppercase capital letter of string
    function ucfirst(str) {
        let newStr = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return newStr;
    }

    /* loading */
    var loading_svg = `<svg viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-60 mx-auto block" style="width: 50px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>`;

    // show calendar loading
    function showCalendarLoading() {
        let $card = $('#calendar').closest('.card');
        let loading_html = `<div class="overlay" style="color: #b4b4b4; background: #fff;">${loading_svg}</div>`; // div.overlay need to set color style
        $card.append(loading_html);
    }

    // remove calendar loading
    function removeCalendarLoading() {
        let $card = $('#calendar').closest('.card');
        $card.find('.overlay').remove();
    }

    // show modal loading
    var showModalLoading = function ($modal) {
        let loading_html = `<div class="overlay" style="color: #b4b4b4; background: #fff;">${loading_svg}</div>`; // div.overlay need to set color style
        $modal.find('.modal-content').prepend(loading_html);
    }

    // remove modal loading
    var removeModalLoading = function ($modal) {
        $modal.find('.overlay').remove();
    }

    // show card loading
    function showCardLoading($card) {
        let loading_html = `<div class="overlay" style="color: #b4b4b4; background: #fff;">${loading_svg}</div>`; // div.overlay need to set color style
        $card.append(loading_html);
    }

    // remove card loading
    function removeCardLoading($card) {
        $card.find('.overlay').remove();
    }
    /* /.loading */

    // disabled buttons of a modal form
    function disabledFormButtons($modal, disabled) {
        $modal.find('button').prop('disabled', disabled);

        if (disabled) {
            $('.btn-file-delete').addClass('disabled');
        }
        else {
            $('.btn-file-delete').removeClass('disabled');
        }
    }
    /** common function **/


    /** calendar event function **/
    function reloadCalendar() {
        calendarObj.refetchEvents();
    }

    function createEvent(event_data) {
        calendarObj.addEvent(event_data);
    }

    function editEvent(event_data) {
        let event_id = event_data.id;
        let calEvent = calendarObj.getEventById(event_id);
        // setEventProperties(calEvent, event_data);
        // 透過 setEventProperties 修改，若時間 start = end 時，無法正確顯示 event
        // 改為先刪除再新增到 calendar 上
        deleteEvent(event_data);
        createEvent(event_data);
    }

    function deleteEvent(event_data) {
        let event_id = event_data.id;
        let calEvent = calendarObj.getEventById(event_id);
        if (calEvent) {
            calEvent.remove();
        }
    }

    function editEventByDrop(event) {
        let event_type = event.extendedProps.type;

        if (event_type == EVENT_TYPE_WORK) {
            editTaskByDrop(event);
        }
        else {
            let start_date = moment(event.start).format('YYYY-MM-DD');
            let end_date = moment(event.end ?? event.start).format('YYYY-MM-DD');
            if (event.end && start_date != end_date) {
                end_date = moment(end_date).subtract(1, 'days').format('YYYY-MM-DD');
            }

            let info_data = {
                id: event.id,
                type: event_type,
                dayoff_type: event.extendedProps.dayoff_type,
                title: event.title,
                person: event.extendedProps.assignee,
                start_date: start_date,
                end_date: end_date,
                remark: event.extendedProps.remark,
            };
            editReminder(info_data);
        }
    }

    // [not use]
    function setEventProperties(calEvent, event_data) {
        let propList = [
            'id', 'title',
        ];
        $.each(event_data, (key, value) => {
            if (propList.includes(key)) {
                calEvent.setProp(key, value);
            }
            else if (key === 'start') {
                calEvent.setStart(value);
            }
            else if (key === 'end') {
                calEvent.setEnd(value);
            }
            else {
                calEvent.setExtendedProp (key, value);
            }
        });
    }
    /** /.calendar event function **/


    /** event handler **/
    // click create event button
    $('.btn-create-event').on('click', function() {
        let event_type = $(this).data('type');
        showCreateFormHandler(event_type);
    });

    $('#modal-reminder-form-submit').on('click', function() {
        let action = $(this).data('action');
        if (action === 'edit') {
            editReminder();
        }
        else if (action === 'create') {
            createReminder();
        }

        // disabled buttons to prevent from duplicated submission
        disabledFormButtons($(this).closest('.modal'), true);
    });

    // reminder form modal is showing
    $('#modal-reminder-form').on('show.bs.modal', function () {
        eventStatus.status = eventStatus.normal;
    });

    // reminder form modal is hidden
    $('#modal-reminder-form').on('hidden.bs.modal', function () {
        // check device downgrade
        if (eventStatus.status == eventStatus.delete_checking) {
            showDeleteCheking();
        }
    });

    // click delete event button
    $(document).on('click', '.btn-delete-event', function() {
        eventStatus.status = eventStatus.delete_checking;
        hideReminderForm();
    });
    /** /.event handler **/


    /** form handler **/
    function showViewFormHandler(event_type, event) {
        $('#modal-reminder-view').find('#reminder-view-person, #reminder-view-type').closest('.form-group').show();

        if (event_type == EVENT_TYPE_WORK) {
            showTaskViewForm(event);
        }
        else if (event_type == EVENT_TYPE_DAYOFF) {
            showDayOffViewForm(event);
        }
        else {
            // reminder or default
            $('#modal-reminder-view').find('#reminder-view-person, #reminder-view-type').closest('.form-group').hide();
            showReminderViewForm(event);

            // holidays event
            if (event_type == EVENT_TYPE_PHILIPPINES || event_type == EVENT_TYPE_TAIWAN) {
                $('#modal-reminder-view-label').text('View Holiday');
            }
        }
    }

    function showCreateFormHandler(event_type) {
        $('#modal-reminder-form').find('#reminder-person, #reminder-type').closest('.form-group').show();

        if (event_type == EVENT_TYPE_WORK) {
            showTaskCreateForm();
        }
        else if (event_type == EVENT_TYPE_DAYOFF) {
            showDayOffCreateForm(event_type);
        }
        else {
            // reminder or default
            $('#modal-reminder-form').find('#reminder-person, #reminder-type').closest('.form-group').hide();
            showReminderCreateForm(event_type);
        }
    }

    function showEditFormHandler(event_type, event) {
        $('#modal-reminder-form').find('#reminder-person, #reminder-type').closest('.form-group').show();

        if (event_type == EVENT_TYPE_WORK) {
            showTaskEditForm(event);
        }
        else if (event_type == EVENT_TYPE_DAYOFF) {
            showDayOffEditForm(event_type, event);
        }
        else {
            // reminder or default
            $('#modal-reminder-form').find('#reminder-person, #reminder-type').closest('.form-group').hide();
            showReminderEditForm(event_type, event);
        }
    }
    /** /.form handler **/


    /** reminder form modal function **/
    // reset form: clear input and select
    function resetReminderForm() {
        let $modal = $('#modal-reminder-form');
        $modal.find('.is-invalid').removeClass('is-invalid');
        $modal.find('p.error').text('');
    }

    function showReminderFormModal(show) {
        if (show) {
            $('#modal-reminder-form').modal('show');
        }
        else {
            $('#modal-reminder-form').modal('hide');
        }
    }

    function showReminderViewModal(show) {
        if (show) {
            $('#modal-reminder-view').modal('show');
        }
        else {
            $('#modal-reminder-view').modal('hide');
        }
    }

    // show view mode
    function showReminderViewForm(event) {
        let dayoff_type = event.extendedProps.dayoff_type_label;
        let assignee = event.extendedProps.assignee_name;
        let start_date = moment(event.start).format('YYYY/MM/DD');
        let end_date = moment(event.extendedProps.end_date).format('YYYY/MM/DD');
        let remark = event.extendedProps.remark;

        $('#reminder-view-title').text(event.title);
        $('#reminder-view-type').text(dayoff_type);
        $('#reminder-view-person').text(assignee);
        $('#reminder-view-start').text(start_date);
        $('#reminder-view-end').text(end_date);
        $('#reminder-view-remark').text(remark);

        $('#modal-reminder-view-label').text('View Reminder');

        showReminderViewModal(true);
    }

    // show create mode
    function showReminderCreateForm(event_type) {
        let $modal = $('#modal-reminder-form');
        let $btnSubmit = $('#modal-reminder-form-submit');
        $btnSubmit.data('action', 'create');
        $btnSubmit.data('type', event_type);
        $('#modal-reminder-form-label').text('Create Reminder');
        $modal.find('.btn-delete-event').hide();
        $modal.find('input').val('');
        $modal.find('select').select2('val', '0');

        resetReminderForm();
        showReminderFormModal(true);
    }

    // show edit mode
    function showReminderEditForm(event_type, event) {
        let $btnSubmit = $('#modal-reminder-form-submit');
        $btnSubmit.data('action', 'edit');
        $btnSubmit.data('type', event_type);
        $('#modal-reminder-form-label').text('Edit Reminder');

        let removable = event.extendedProps.is_removable;
        $('#modal-reminder-form').find('.btn-delete-event').hide();
        if (removable) {
            $('#modal-reminder-form').find('.btn-delete-event').show();
        }

        let dayoff_type = event.extendedProps.dayoff_type.toString();
        let assignee = event.extendedProps.assignee.toString();
        let start_date = moment(event.start).format('YYYY-MM-DD');
        let end_date = event.extendedProps.end_date;
        let remark = event.extendedProps.remark;

        $('#reminder-id').val(event.id);
        $('#reminder-title').val(event.title);
        $('#reminder-type').select2('val', dayoff_type);
        $('#reminder-person').select2('val', assignee);
        $('#reminder-start').val(start_date);
        $('#reminder-end').val(end_date);
        $('#reminder-remark').val(remark);

        resetReminderForm();
        showReminderFormModal(true);
    }

    function hideReminderForm() {
        showReminderFormModal(false);
    }

    // show delete checking modal
    function showDeleteCheking(is_task = null) {
        let event_id = $('#reminder-id').val();
        if (is_task) {
            event_id = $('#modal-task-form-submit').data('task');
        }

        let $modal = $('#modal-sm');
        setDeleteReminderCheckingModal($modal, event_id, is_task);
        $modal.modal('show');
    }

    function setDeleteReminderCheckingModal($modal, event_id, is_task = null) {
        let calEvent = calendarObj.getEventById(event_id);

        $modal.unbind().on('show.bs.modal', function(e) {
            $(this).find('.modal-title').text('Delete Reminder');
            $(this).find('.modal-body').append(`Delete <strong>` + calEvent.title + ` ?</strong>`);
        });

        $modal.on('hidden.bs.modal', function(e) {
            $(this).find('.modal-body').empty();
            if (eventStatus.status == eventStatus.delete_checking) {
                if (is_task) {
                    showTaskFormModal(true);
                }
                else {
                    showReminderFormModal(true);
                }
            }
            else {
                eventStatus.status = eventStatus.normal;
            }
        });

        // Request
        $modal.find(':submit').unbind().on('click', function() {
            if (is_task) {
                taskSubmitHandler('delete', event_id);
            }
            else {
                deleteReminder(event_id);;
            }
            eventStatus.status = eventStatus.delete_checked;
            $modal.modal('hide');
        });
    }
    /** /.reminder form modal function **/


    /** day off form modal function **/
    // show view mode
    function showDayOffViewForm(event) {
        showReminderViewForm(event);
        $('#modal-reminder-view-label').text('View Day Off');
    }

    // show create mode
    function showDayOffCreateForm(event_type) {
        showReminderCreateForm(event_type);
        $('#modal-reminder-form-label').text('Create Day Off');
    }

    // show edit mode
    function showDayOffEditForm(event_type, event) {
        showReminderEditForm(event_type, event);
        $('#modal-reminder-form-label').text('Edit Day Off');
    }

    /** /.day off form modal function **/


    /** reminder event data function **/
    function getReminderFormData() {
        let data = {
            type: $('#modal-reminder-form-submit').data('type'),
            title: $('#reminder-title').val(),
            dayoff_type: $('#reminder-type').val(),
            person: $('#reminder-person').val(),
            start_date: $('#reminder-start').val(),
            end_date: $('#reminder-end').val(),
            remark: $('#reminder-remark').val()
        };
        return data;
    }

    function createReminder(info_data = null, info_event = null) {
        let data = info_data ?? getReminderFormData();
        let route = "{{ route('calendar.store') }}";
        saveEventChanges('post', 'create', route, data, null, info_event);
    }

    function editReminder(info_data = null) {
        let data = getReminderFormData();
        let event_id = $('#reminder-id').val();

        if (info_data) {
            data = info_data;
            event_id = info_data.id;
        }
        let route = "{{ route('calendar.update', ':calendar') }}";
        route = route.replace(/:calendar/, event_id);
        saveEventChanges('patch', 'edit', route, data, event_id);
    }

    function deleteReminder(event_id) {
        let data = {id: event_id};
        let route = "{{ route('calendar.delete', ':calendar') }}";
        route = route.replace(/:calendar/, event_id);
        saveEventChanges('patch', 'delete', route, data, event_id);
    }

    // send ajax request
    function saveEventChanges(type, action, route, data, event_id = null, calEvent = null) {
        data['_token'] = "{{ csrf_token() }}";

        $.ajax({
            type: type,
            url: route,
            data: data,
            success: function(e) {
                if (e.success == true) {
                    let event_data = e.data.event_data;
                    // if (action === 'edit') {
                    //     editEvent(event_data);
                    // }
                    // else if (action === 'create') {
                    //     createEvent(event_data);
                    // }
                    // else if (action === 'delete') {
                    //     deleteEvent(event_data);
                    // }
                    reloadCalendar(); // prevent from filter bug (new event will not be filtered)
                    toastr.success("{{ config('messages.SuccessSaving') }}");
                }
                else {
                    reloadCalendar();
                    toastr.error(e.message);
                }

                if (calEvent) {
                    calEvent.remove();
                }
                hideReminderForm();
                console.log(action + ' event', e)
            },
            error: function(e) {
                resetReminderForm();
                if (e.status == 422) {
                    // form validation error
                    let errors = e.responseJSON.errors;
                    console.log(errors);
                    $.each(errors, (key, value) => {
                        if (key === 'start_date') {
                            $('#reminder-start').addClass('is-invalid').siblings('p').text(value);
                        }
                        else if (key === 'end_date') {
                            $('#reminder-end').addClass('is-invalid').siblings('p').text(value);
                        }
                        else if (key === 'dayoff_type') {
                            $('#reminder-type').addClass('is-invalid').siblings('p').text(value);
                        }
                        else {
                            $('#reminder-' + key).addClass('is-invalid').siblings('p').text(value);
                        }
                    });
                }
                else {
                    reloadCalendar();
                    toastr.error("{{ config('messages.Error') }}");
                }
                console.log(e)
            },
            complete: function() {
                disabledFormButtons($('#modal-reminder-form'), false);
            }
        });
    }
    /** /.reminder event data function **/
</script>
@endsection


@section('task-form-js')
<script>
    // scrollable adjustment for file delete checking modal
    $(document).on('close.checking.modal', '#modal', function(e) {
        $('body').addClass('modal-open');
    });

    $('#modal-task-form-submit').on('click', function() {
        let task_id = $(this).data('task');
        let action = $(this).data('action');
        // editor data
        let value = form_editor.getData();
        $('input[name=content').val(value);

        // disabled buttons to prevent from duplicated submission
        disabledFormButtons($(this).closest('.modal'), true);
        taskSubmitHandler(action);
    });

    // task form modal is showing
    $('#modal-task-form').on('show.bs.modal', function () {
        eventStatus.status = eventStatus.normal;
    });

    // task form modal is hidden
    $('#modal-task-form').on('hidden.bs.modal', function () {
        // check device downgrade
        if (eventStatus.status == eventStatus.delete_checking) {
            showDeleteCheking(true);
        }
    });

    // click delete task button
    $(document).on('click', '.btn-delete-task', function() {
        eventStatus.status = eventStatus.delete_checking;
        hideTaskForm();
    });

    function showTaskFormModal(show, is_show_mode = null) {
        let $modal = $('#modal-task-form');
        if (show) {
            // $modal.modal('show');

            // if (is_show_mode) {
            //     // can close modal by click backdrop
            //     $modal.data('bs.modal')._config.keyboard = true;
            //     $modal.data('bs.modal')._config.backdrop = true;
            // }
            // else {
            //     $modal.data('bs.modal')._config.keyboard = false;
            //     $modal.data('bs.modal')._config.backdrop = 'static';
            // }

            $modal.modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        }
        else {
            $modal.modal('hide');
        }
    }

    function setTaskMode(action, removable = null) {
        $('#modal-task-form-label').text(ucfirst(action) + ' Task');
        $('#modal-task-form-submit').data('action', action);
        $('.btn-delete-task').hide();

        if (action === 'view') {
            $('#modal-task-form-close').show();
            $('#modal-task-form-cancel, #modal-task-form-submit').hide();
        }
        else {
            if (action === 'edit' && removable) {
                $('.btn-delete-task').show();
            }
            $('#modal-task-form-close').hide();
            $('#modal-task-form-cancel, #modal-task-form-submit').show();
        }
    }

    function showTaskViewForm(event) {
        let task_id = event.id;
        let routeString = "{{ route('task.show', ':task') }}";
        let route = routeString.replace(/:task/, task_id)
        loadTaskForm(route, 'view', true, event, task_id);
        setTaskMode('view');
    }

    function showTaskEditForm(event) {
        let removable = event.extendedProps.is_removable;
        let task_id = event.id;
        let routeString = "{{ route('task.edit', ':task') }}";
        let route = routeString.replace(/:task/, task_id)
        loadTaskForm(route, 'edit', false, event, task_id);
        setTaskMode('edit', removable);
    }

    function showTaskCreateForm() {
        let route = "{{ route('task.create') }}";
        loadTaskForm(route, 'create', false);
        setTaskMode('create');
    }

    function hideTaskForm() {
        showTaskFormModal(false);
    }

    // layout for getting task data fail
    function showTaskNotFound(action, status) {
        setTaskMode('view');
        let message = "{{ config('messages.TaskNotFound') }}";

        if (action === 'create') {
            $('#modal-task-form-label').text(ucfirst(action) + ' Task');
            message = "{{ config('messages.Action_unauthorized') }}";
        }
        $('#task-form-content').html(message);
    }

    // function loadTaskForm(route, is_show_mode, event = null, task_id = null) {
    //     $('#task-form-content').load(route + " .form-content>.row", function(response, status, xhr) {
    //         if (status == "error") {
    //             // task was not found
    //             reloadCalendar();
    //             toastr.error("{{ config('messages.TaskNotFound') }}");
    //             console.log("Sorry but there was an error: " + xhr.status + " " + xhr.statusText )
    //             return false;
    //         }
    //         showTaskFormModal(true);
    //         initTaskForm(is_show_mode);
    //         showModeTaskForm(is_show_mode, event);
    //         $('#modal-task-form-submit').data('task', task_id);
    //     });
    // }

    function loadTaskForm(route, action, is_show_mode, event = null, task_id = null) {
        // show loading before getting url data
        showModalLoading($('#modal-task-form'));
        showTaskFormModal(true);

        // set 100 ms timer for modal loading
        setTimeout(() => {
            $.get(route, function (html) {
                let doc = $(html);
                let formContentHtml = '';
                let $script = '';

                doc.each((index, item) => {
                    if (item.id == 'app'){
                        formContentHtml = $(item).find('.form-content').html();
                    }
                    else if (item.id == 'app-form-js') {
                        $script = $(item);
                    }
                });

                $('#task-form-content').html(formContentHtml);

                let has_script = $('#app-form-js').html().length > 0;
                if (!has_script) {
                    $('#app-form-js').empty().replaceWith($script);
                }

                // showTaskFormModal(true, is_show_mode);
                initTaskForm(is_show_mode);
                showModeTaskForm(is_show_mode, event);
                $('#modal-task-form-submit').data('task', task_id);
            }).fail(function (e) {
                // 404 task was not found
                // let error_message = "{{ config('messages.TaskNotFound') }}";
                // if (e.status == 403) {
                //     error_message = "{{ config('messages.Action_unauthorized') }}";
                // }
                showTaskNotFound(action, e.status);
                reloadCalendar();
                // toastr.error(error_message);
                toastr.error("{{ config('messages.Error') }}");
            })
            .always(function (e) {
                removeModalLoading($('#modal-task-form')); // remove loading after ajax process completed
            });
        }, 100);
    }

    function initTaskForm(isShowMode) {
        select2Custom.bs4($('.select2bs4'));
        select2Custom.bs4NotSearch($('.select2bs4-nSearch'));

        // Autocomplete off
        $('input').attr('autocomplete', 'off');
        initEditor(isShowMode);

        // col width
        $('#task-created-at, #task-updated-at').removeClass('col-md-4').addClass('col-md-5 col-lg-4');
    }

    function showModeTaskForm(isShowMode, event) {
        let $form = $('#layout_form');
        let $show = $form.find('.form-control-show');

        if (isShowMode) {
            $form.find('.form-group:not(.form-group-remain):not(.form-group-select):not(.form-file-upload) label').each((index, item) => {
                let $item = $(item);
                $item.find('span.required').remove();
                $(item).siblings().not('.form-control-show').not('.siblings-show').remove();
            });

            // select: get selected option text
            $form.find('.form-group.form-group-select').each((index, item) => {
                let $item = $(item);
                let selected = $item.find('select option:selected');
                let textArr = $.map(selected, (item, index) => item.text);
                let text = textArr.join(' | ');
                $item.find('span.required').remove();
                $item.find('.form-control-show').text(text);
                $(item).children().not('.form-control-show').not('label').not('.siblings-show').remove();
            });

            // input: no label
            $form.find('.form-group.form-group-no-label').each((index, item) => {
                let $item = $(item);
                $item.find('span.required').remove();
                $item.find('.form-control-show').text($item.find('input').val());
                $(item).children().not('.form-control-show').not('.siblings-show').remove();
            });

            $show.removeClass('d-none');
        }
        else {
            $show.remove();
        }
    }

    function editTaskByDrop(event) {
        let event_id = event.id;
        let start_date = moment(event.start).format('YYYY-MM-DD');
        let data = {
            _token: "{{ csrf_token() }}",
            due_date: moment(event.start).format('YYYY-MM-DD'),
        };

        let route = "{{ route('calendar.update_task_date', ':task') }}";
        route = route.replace(/:task/, event_id);

        $.ajax({
            type: 'patch',
            url: route,
            data: data,
            success: function(e) {
                if (e.success == true) {
                    let event_data = e.data.event_data;
                    // editEvent(event_data);
                    toastr.success("{{ config('messages.SuccessSaving') }}");
                }
                else {
                    toastr.error(e.message);
                }
                reloadCalendar();
                console.log('edit task by drop', e)
            },
            error: function(e) {
                console.log(e)
                toastr.error("{{ config('messages.Error') }}");
            },
        });
    }

    function taskSubmitHandler(action, event_id = null) {
        // let type = action === 'create' ? 'post' : 'patch';
        saveTaskChanges(action, event_id);
    }

    function saveTaskChanges(action, event_id = null) {
        let $form = $('#layout_form');
        let formData = new FormData($form[0]);
        formData.append('is_ajax_form', 1);
        formData.append('action', action);

        if (event_id) {
            formData.append('id', event_id);
        }

        let task_id = $('#modal-task-form-submit').data('task');
        let routeString = "{{ route('calendar.task_handler', ':task') }}";
        let route = routeString.replace(/:task/, task_id);

        $.ajax({
            type: 'post',
            url: route,
            contentType: false, // required
            processData: false, // required
            dataType: 'json', // required
            data: formData,
            success: function(e) {
                if (e.success == true) {
                    let event_data = e.data.event_data;
                    // if (action === 'edit') {
                    //     editEvent(event_data);
                    // }
                    // else if (action === 'create') {
                    //     createEvent(event_data);
                    // }
                    // else if (action === 'delete') {
                    //     deleteEvent(event_data);
                    // }
                    reloadCalendar(); // prevent from filter bug (new event will not be filtered)
                    toastr.success("{{ config('messages.SuccessSaving') }}");
                }
                else {
                    toastr.error(e.message);
                    reloadCalendar();
                }
                showTaskFormModal(false);
                console.log(action + ' task', e)
            },
            error: function(e) {
                $form.find('.form-control').removeClass('is-invalid').siblings('p').text('');
                if (e.status == 422) {
                    // form validation error
                    let errors = e.responseJSON.errors;
                    Object.entries(errors).forEach(([key, value]) => {
                        let $element = $form.find('.form-control[name="' + key + '"]');
                        $element.addClass('is-invalid');
                        $element.siblings('p').text(value);
                    });

                    toastr.error("{{ config('messages.FieldInputError') }}");
                }
                else {
                    toastr.error("{{ config('messages.Error') }}");
                }
                console.log(e)
            },
            complete: function() {
                disabledFormButtons($form.closest('.modal'), false);
            }
        });
    }
</script>

<script id="app-form-js"></script>
@endsection --}}
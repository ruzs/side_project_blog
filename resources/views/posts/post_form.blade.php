@extends('layouts.form')

@section('form-content')
<div id="row-task-detail" class="row">
    <div class="col-md-6 col-xl-6">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.name') }}</label>
            <div class="form-control-show d-none">{{ @$row->title }}</div>
            <input name="title" value="{{ old('title') ?: @$row->title }}" type="text" class="form-control {{ $errors->has('title') ?' is-invalid' : '' }}" placeholder="{{ trans('default.Task.name') }}">
            <p class="error invalid-feedback">{{ $errors->has('title') ? $errors->first('title') : '' }}</p>
        </div>
    </div>
    <div class="col-md-6 col-xxl-5 col-xxxl-4">
        <div class="form-group form-group-select {{ $errors->has('project') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.project') }}</label>
            <div class="form-control-show d-none"></div>
            <select id="select_project" name="project" class="form-control select2bs4 {{ $errors->has('project') ?' is-invalid' : '' }}">
                <option value="0">--{{  trans('default.Task.'.config('messages.Select_an_option'))  }}--</option>
                @if (@$projects)
                @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project', @$row->parent_id) == $project->id ? 'selected' : ''  }}>{{ $project->title }}</option>
                @endforeach
                @endif
            </select>
            <p class="error invalid-feedback">{{ $errors->has('project') ? $errors->first('project') : '' }}</p>
        </div>
    </div>
    <div class="col-12 d-none d-xxl-block"></div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group form-group-select {{ $errors->has('priority') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.priority') }}</label>
            <div class="form-control-show d-none"></div>
            <select id="select_priority" name="priority" class="form-control select2bs4-nSearch {{ $errors->has('priority') ?' is-invalid' : '' }}">
                <option value="0">--{{  trans('default.Task.'.config('messages.Select_an_option'))  }}--</option>
                @foreach (config('constants.priority_types') as $priority)
                <option value="{{ $priority['value'] }}" {{ old('priority') !== null ? ( old('priority') == (string)$priority['value'] ? 'selected' : '' ) : ( @$row->priority == (string)$priority['value'] ? 'selected' : '' ) }}>{{  trans('default.Task.'.$priority['label']) }}</option>
                @endforeach
            </select>
            <p class="error invalid-feedback">{{ $errors->has('priority') ? $errors->first('priority') : '' }}</p>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.duedate') }}</label>
            <div class="form-control-show d-none">{{ @$row->due_date ? date('Y/m/d', strtotime(@$row->due_date)) : '' }}</div>
            <input type="date" name="due_date" class="form-control {{ $errors->has('due_date') ?' is-invalid' : '' }}" value="{{ old('due_date') ?: @$row->due_date }}">
            <p class="error invalid-feedback">{{ $errors->has('due_date') ? $errors->first('due_date') : '' }}</p>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group form-group-select {{ $errors->has('status') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.status') }}</label>
            <div class="form-control-show d-none"></div>
            <select id="select_status" name="status" class="form-control select2bs4-nSearch {{ $errors->has('status') ?' is-invalid' : '' }}">
                <option value="0">--{{ trans('default.Task.'.config('messages.Select_an_option')) }}--</option>
                @foreach (config('constants.task_status') as $status)
                <option value="{{ $status['value'] }}" {{ old('status') !== null ? ( old('status') == (string)$status['value'] ? 'selected' : '' ) : ( @$row->status == (string)$status['value'] ? 'selected' : '' ) }}>{{ trans('default.Task.'.$status['label']) }}</option>
                @endforeach
            </select>
            <p class="error invalid-feedback">{{ $errors->has('status') ? $errors->first('status') : '' }}</p>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('completed_date') ? 'has-error' : '' }}">
            <label>{{ trans('default.Task.completeddate') }}</label>
            <div class="form-control-show d-none">{{ @$row->completed_date ? date('Y/m/d', strtotime(@$row->completed_date)) : '' }}</div>
            <input type="date" name="completed_date" class="form-control" value="{{ old('completed_date') ?: @$row->completed_date }}">
            <p class="error invalid-feedback">{{ $errors->has('completed_date') ? $errors->first('completed_date') : '' }}</p>
        </div>
    </div>
    <div class="col-12 d-none d-xxl-block"></div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
            {{-- the date where/when the task is scheduled to begin --}}
            {{-- task is scheduled to begin from the date --}}
            <label>{{ trans('default.Task.startdate') }}</label>
            <div class="form-control-show d-none">{{ @$row->start_date ? date('Y/m/d', strtotime(@$row->start_date)) : '' }}</div>
            <input type="date" name="start_date" class="form-control {{ $errors->has('start_date') ?' is-invalid' : '' }}" value="{{ old('start_date') ?: @$row->start_date }}">
            <p class="error invalid-feedback">{{ $errors->has('start_date') ? $errors->first('start_date') : '' }}</p>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
            <label>{{ trans('default.Task.scheduledfinishdate') }}</label>
            <div class="form-control-show d-none">{{ @$row->end_date ? date('Y/m/d', strtotime(@$row->end_date)) : '' }}</div>
            <input type="date" name="end_date" class="form-control {{ $errors->has('end_date') ?' is-invalid' : '' }}" value="{{ old('end_date') ?: @$row->end_date }}">
            <p class="error invalid-feedback">{{ $errors->has('end_date') ? $errors->first('end_date') : '' }}</p>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('workday') ? 'has-error' : '' }}">
            <label>{{ trans('default.Task.scheduledworkday') }}</label>
            <div class="form-control-show d-none">{{ number_format(@$row->workday ?: 0) }}</div>
            <div class="input-group mb-3">
                <input type="number" name="workday" min="1" class="form-control {{ $errors->has('workday') ?' is-invalid' : '' }}" value="{{ old('workday') ?: (@$row->workday ?: 1) }}">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
                </div>
                <p class="error invalid-feedback">{{ $errors->has('workday') ? $errors->first('workday') : '' }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group {{ $errors->has('progress') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.progress') }}</label>
            <div class="form-control-show d-none">{{ number_format(@$row->progress ?: 0) }}%</div>
            <div class="input-group mb-3">
                <input type="number" name="progress" min="0" class="form-control {{ $errors->has('progress') ?' is-invalid' : '' }}" value="{{ old('progress') ?: (@$row->progress ?: 0) }}">
                <div class="input-group-append">
                    <span class="input-group-text">%</span>
                </div>
                <p class="error invalid-feedback">{{ $errors->has('progress') ? $errors->first('progress') : '' }}</p>
            </div>
        </div>
    </div>
    <div class="col-12 d-none d-xxl-block"></div>
    <div class="col-sm-6 col-md-4 col-xl-3 col-xxl-2">
        <div class="form-group form-group-select {{ $errors->has('assignee') ? 'has-error' : '' }}">
            <label><span class="required">*</span>{{ trans('default.Task.assignee') }}</label>
            <div class="form-control-show d-none"></div>
            <select  name="assignee" class="form-control select2bs4-nSearch {{ $errors->has('assignee') ?' is-invalid' : '' }}">
                <option value="0">--{{ trans('default.Task.'.config('messages.Select_an_option')) }}--</option>
                @if (@$users)
                @foreach (@$users as $user)
                <option value="{{ $user->id }}" {{ old('assignee', @$row->assignee) == $user->id ? 'selected' : '' }} >{{ $user->name }}</option>
                @endforeach
                @endif
            </select>
            <p class="error invalid-feedback">{{ $errors->has('assignee') ? $errors->first('assignee') : '' }}</p>
        </div>
    </div>
    <div class="col-md-8 col-xl-5 col-xxl-4 col-xxxl-3">
        <div class="form-group form-group-select {{ $errors->has('related_user') ? 'has-error' : '' }}">
            <label>{{ trans('default.Task.relateduser') }}</label>
            <div class="form-control-show d-none"></div>
            <select name="related_user[]" class="form-control select2bs4 {{ $errors->has('related_user') ?' is-invalid' : '' }}" multiple="multiple">
                @if (@$users)
                @foreach (@$users as $user)
                @if (@$row and $row->relatedUsers)
                <option value="{{ $user->id }}" {{ in_array($user->id, old('related_user', @$row->relatedUsers()->get()->pluck('id')->toArray())) ?  'selected' : '' }} >{{ $user->name }}</option>
                @else
                <option value="{{ $user->id }}" {{ old('related_user') ? ( in_array($user->id, old('related_user')) ? 'selected' : '' ) : '' }}>{{ $user->name }}</option>
                @endif
                @endforeach
                @endif
            </select>
            <p class="error invalid-feedback">{{ $errors->has('related_user') ? $errors->first('related_user') : '' }}</p>
        </div>
    </div>
    <div class="col-xl-8 col-xxl-6">
        <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
            <label>{{ trans('default.Task.remark') }}</label>
            <div class="form-control-show d-none">{{ @$row->remark }}</div>
            <input name="remark" value="{{ old('remark') ?: @$row->remark }}" type="text" class="form-control {{ $errors->has('remark') ?' is-invalid' : '' }}" placeholder="{{ trans('default.Task.remark') }}">
            <p class="error invalid-feedback">{{ $errors->has('remark') ? $errors->first('remark') : '' }}</p>
        </div>
    </div>
</div>

@if (@$row)
<div class="row">
    <div id="task-created-at" class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group">
            <label>{{ trans('default.Task.Created At') }}</label>
            <div class="form-control-show d-none">{{ @$row->created_at ? date('Y/m/d H:i:s', strtotime(@$row->created_at)) : '' }}</div>
            <input type="text" class="form-control" value="{{ date('Y/m/d H:i:s', strtotime($row->created_at)) }}" disabled>
        </div>
    </div>
    <div id="task-updated-at" class="col-sm-6 col-md-4 col-xl-3 col-xxxl-2">
        <div class="form-group">
            <label>{{ trans('default.Task.Updated At') }}</label>
            <div class="form-control-show d-none">{{ @$row->updated_at ? date('Y/m/d H:i:s', strtotime(@$row->updated_at)) : '' }}</div>
            <input type="text" class="form-control" value="{{ date('Y/m/d H:i:s', strtotime($row->updated_at)) }}" disabled>
        </div>
    </div>
</div>
@endif

@include('components.form_editor')
@include('components.file_upload')
@endsection

@section('sub-page-js')
{{-- <script src="{{ asset('js/sweetalert/dist/sweetalert.min.js') }}"></script> --}}
<script>
    $(function() {
        initForm("{{ @$row ? route('task.update', $row->id) : route('task.store') }}", "{{ route('task.index') }}");
        initEditor();
    });

    function beforeFormSubmit() {
        let value = form_editor.getData();
        $('input[name=content').val(value);
    }

</script>
@endsection
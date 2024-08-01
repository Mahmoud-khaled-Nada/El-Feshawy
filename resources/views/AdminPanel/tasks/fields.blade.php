@isset($task)
    @method('PUT')
    <input type="hidden" value="{{ $task->id }}" name="id">
@endisset
@csrf
<div class="card-body border-top p-9">
    <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

        @foreach (LaravelLocalization::getSupportedLocales() as $name => $value)
            <li class="nav-item" data-bs-toggle="tab">
                <a class="nav-link {{ LaravelLocalization::getCurrentLocale() == $name ? 'active' : '' }}"
                    id="{{ $name }}-tab" data-bs-toggle="tab" href="#{{ $name }}" role="tab"
                    aria-controls="{{ $name }}"
                    aria-selected="{{ LaravelLocalization::getCurrentLocale() == $name ? 'true' : 'false' }}">{{ $value['native'] }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content mt-5" id="myTabContent">
        @foreach (LaravelLocalization::getSupportedLocales() as $name => $value)
            <div class="tab-pane fade {{ LaravelLocalization::getCurrentLocale() == $name ? 'show active' : '' }}"
                id="{{ $name }}" role="tabpanel" aria-labelledby="{{ $name }}-tab">
                <!--begin::Input group-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.title') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <input type='text' name="{{ $name }}[title]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                                    placeholder="{{ __('lang.title') }}"
                                    value="{{ old($name . '.title', isset($task) ? $task->getTranslation($name)->title : '') }}">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-3">
                    <!--begin::Label-->
                    <label
                        class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.description') }}</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <textarea name="{{ $name }}[description]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote">{{ old($name . '.description', isset($task) ? $task->getTranslation($name)->description : '') }}
                                </textarea>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

            </div>
        @endforeach
    </div>


    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.start_date') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='date' name="start_date" id="start_date"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder="{{ __('lang.start_date') }}"
                        value="{{ old('start_date', $task->start_date ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->


    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.end_date') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='date' name="end_date" id="end_date"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        value="{{ old('end_date', $task->end_date ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.duration') }}
        </label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='number' name="duration" id="duration" readonly
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder="{{ __('lang.duration') }}" value="{{ old('duration', $task->duration ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.participants') }}
        </label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type='number' name="participants"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 "
                        placeholder=" {{ __('lang.participants') }}"
                        value="{{ old('participants', $task->participants ?? '') }}">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->


    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.employees') }}
        </label>
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <select id="js-example-basic" class="form-control select2 h-50px" multiple name="employee_ids[]">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ isset($task) && collect(old('employee_ids', $task->employees->pluck('id')->toArray()))->contains($employee->id) ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>

    <div class="row mb-3">
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
            {{ __('lang.add_file') }}
        </label>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="file"
                        name="received_file_path">
                    @if (isset($task) && $task->received_file_path)
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            <p>Current File: <a href="{{ asset($task->received_file_path) }}"
                                    target="_blank">{{ basename($task->received_file_path) }}</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--begin::Input group-->
    <div class="row mb-3" id="checklistForm">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">
            {{ __('lang.add_checklist') }}
        </label>
        <div class="col-lg-8">
            <button type="button" id="addChecklistItem" class="btn btn-flex btn-light-primary mb-2">
                <i class="ki-duotone ki-plus fs-3"></i>
                Add Row
            </button>

            <div class="row">
                <div class="col-lg-12 fv-row fv-plugins-icon-container" id="checklistContainer">
                    @if (isset($task))
                        @foreach ($task->taskChecklistItems as $item)
                            <div class="input-group mb-3">
                                <input type="text" name="checklist_items[]"
                                    class="form-control form-control-lg form-control-solid"
                                    value="{{ $item->item }}">
                                <button type="button" class="btn btn-danger removeChecklistItem">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span></i>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--end::Input group-->



    <script>
        $(document).ready(function() {
            $('#js-example-basic').select2({
                placeholder: "{{ __('lang.select') }}",
                allowClear: true
            });

            // Adding new checklist item checklist_items
            $('#addChecklistItem').click(function() {
                $('#checklistContainer').append(`
                <div class="input-group mb-3">
                    <input type="text" name="checklist_items[]" class="form-control form-control-lg form-control-solid" placeholder="Enter checklist item">
                    <button type="button" class="btn btn-danger removeChecklistItem">
                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                        class="path2"></span><span class="path3"></span><span
                        class="path4"></span><span class="path5"></span></i>
                        </button>
                </div>
            `);
            });

            // Removing checklist item
            $(document).on('click', '.removeChecklistItem', function() {
                $(this).closest('.input-group').remove();
            });
        });

        $(document).ready(function() {
            function calculateDuration() {
                var startDate = $('#start_date').val();
                var endDate = $('#end_date').val();

                if (startDate && endDate) {
                    var start = new Date(startDate);
                    var end = new Date(endDate);
                    var duration = (end - start) / (1000 * 60 * 60 * 24);
                    $('#duration').val(duration);
                } else {
                    $('#duration').val('');
                }
            }
            $('#start_date, #end_date').on('change', calculateDuration);
        });
    </script>

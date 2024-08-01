@isset($meeting)
    @method('PUT')
    <input type="hidden" value="{{ $meeting->id }}" name="id">
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
                                    value="{{ old($name . '.title', isset($meeting) ? $meeting->getTranslation($name)->title : '') }}">
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
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Description</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                <textarea name="{{ $name }}[description]"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote">
                                    {{ old($name . '.description', isset($meeting) ? $meeting->getTranslation($name)->description : '') }}
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
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.start_time') }}</label>
            <input type="time" name="start_time" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                placeholder="{{ __('lang.start_time') }}" value="{{ old('start_time', $meeting->start_time ?? '') }}">
            <div class="invalid-feedback">
                <!-- Error message for start time -->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.end_time') }}</label>
            <input type="time" name="end_time" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                placeholder="{{ __('lang.end_time') }}" value="{{ old('end_time', $meeting->end_time ?? '') }}">
            <div class="invalid-feedback">
                <!-- Error message for end time -->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.date') }}</label>
            <input type="date" name="date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                placeholder="{{ __('lang.date') }}" value="{{ old('date', $meeting->date ?? '') }}">
            <div class="invalid-feedback">
                <!-- Error message for end time -->
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.numbers_of_employees') }}</label>
            <input type="number" name="number_employees"
                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __('lang.numbers_of_employees') }}"
                value="{{ old('number_employees', $meeting->number_employees ?? '') }}">
            <div class="invalid-feedback">
                <!-- Error message for start time -->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.numbers_of_customers') }}</label>
            <input type="number" name="number_customers" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                placeholder="{{ __('lang.numbers_of_customers') }}" value="{{ old('number_customers', $meeting->number_customers ?? '') }}">
            <div class="invalid-feedback">
                <!-- Error message for end time -->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-lg-4">
            <label class="col-form-label required fw-semibold fs-6">{{ __('lang.status') }}</label>
            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                <select id="js-example-basic" class=" form-control select2 h-50px" name="status">
                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
                </select>
            </div>
            <div class="invalid-feedback">
                <!-- Error message for end time -->
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-3" id="meeting-link-group">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.link') }}</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="text" name="link"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __('lang.link') }}"
                        value="{{ old('link', $meeting->link ?? '') }}">
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
    <div class="row mb-3" id="meeting-location-group">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.location') }} </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <input type="text" name="location"
                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __('lang.location') }}..."
                        value="{{ old('location', $meeting->location ?? '') }}">
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
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.employees') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <select id="employee-select" class="form-control select2 h-50px" multiple name="employee_ids[]">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ collect(old('employee_ids', isset($meeting) ? $meeting->participatingEmployees->pluck('id')->toArray() : []))->contains($employee->id) ? 'selected' : '' }}>
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
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-3">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.customers') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <select id="customer-select" class=" form-control select2 h-50px" multiple name="customer_ids[]">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ collect(old('customer_ids', isset($meeting) ? $meeting->participatingCustomers->pluck('id')->toArray() : []))->contains($customer->id) ? 'selected' : '' }}>
                                {{ $customer->name }}
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
    <!--end::Input group-->

</div>


<script>
    $(document).ready(function() {
        $('#employee-select').select2({
            placeholder: "{{ __('lang.select') }}",
            allowClear: true
        });
    });

    $(document).ready(function() {
        $('#customer-select').select2({
            placeholder: "{{ __('lang.select') }}",
            allowClear: true
        });
    });

    $(document).ready(function() {
        $('#js-example-basic').select2({
            placeholder: "{{ __('lang.select') }}",
            allowClear: true
        });
    });


    $(document).ready(function() {
        function toggleMeetingFields() {
            var status = $('#js-example-basic').val();
            console.log(status);
            if (status === 'Online') {
                $('#meeting-link-group').show();
                $('#meeting-location-group').hide();
            } else if (status === 'Offline') {
                $('#meeting-link-group').hide();
                $('#meeting-location-group').show();
            }
        }

        // Initial check
        toggleMeetingFields();

        // Change event listener
        $('#js-example-basic').change(function() {
            toggleMeetingFields();
        });
    });
</script>

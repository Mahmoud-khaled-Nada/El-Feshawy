@php
    use Carbon\Carbon;
@endphp
<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-200px">{{ __('lang.title') }}</th>
            <th class="min-w-100px">{{ __('lang.start_time') }}</th>
            <th class="min-w-100px">{{ __('lang.end_time') }}</th>
            <th class="min-w-100px">{{ __('lang.date') }}</th>
            <th class="min-w-50px">{{ __('lang.employees') }}</th>
            <th class="min-w-50px">{{ __('lang.customers') }}</th>
            <th class="min-w-100px">{{ __('lang.status') }}</th>
            <th class="min-w-100px">{{ __('lang.link') }}</th>
            <th class="min-w-100px">{{ __('lang.location') }}</th>
            <th class="min-w-200px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($meetings as $meeting)
            <tr>
                <td>
                    <strong class="text-primary">{{ $meeting->title }}</strong>
                </td>
                <td>
                    <span class="text-gray-600 fw-bold fs-6">
                        {{ Carbon::parse($meeting->start_time)->format('h:i A') }}
                    </span>
                </td>
                <td>
                    <span class="text-gray-600 fw-bold fs-6">
                        {{ Carbon::parse($meeting->end_time)->format('h:i A') }}
                    </span>
                </td>
                <td>
                    <span class="text-gray-600 fw-bold fs-6">
                        {{ Carbon::parse($meeting->date)->format('F j, Y') }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-primary p-2 cursor-pointer gap-1" data-bs-toggle="modal"
                        data-bs-target="#employeesModal{{ $meeting->id }}">
                        <i class="bi bi-people-fill text-white"></i>
                        {{ $meeting->number_employees }}-view
                    </span>
                    <x-models.show_meeting_employees_model :meeting="$meeting" />
                </td>
                <td>
                    <span class="badge badge-primary p-2 cursor-pointer gap-1" data-bs-toggle="modal"
                        data-bs-target="#customersModal{{ $meeting->id }}">
                        <i class="bi bi-people-fill text-white"></i>
                        {{ $meeting->number_customers }}-View
                    </span>
                    <x-models.show_meeting_customers_model :meeting="$meeting" />
                </td>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $meeting->status }}</span>
                </td>
                <td>
                    @if ($meeting->link)
                        <div>
                            <span id="linkValue_{{ $meeting->id }}" class="copy-text d-none">{{ $meeting->link }}</span>
                            <button data-action="copy"
                                class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light copyButton"
                                data-target="linkValue_{{ $meeting->id }}">
                                <i class="ki-solid ki-copy fs-2"></i>
                            </button>
                        </div>
                    @else
                        <span class="badge badge-light-danger fs-7 fw-bold">No link</span>
                    @endif
                </td>
                <td>
                    @if ($meeting->location)
                        <div>
                            <span id="locationValue_{{ $meeting->id }}" class="copy-text d-none">{{ $meeting->location }}</span>
                            <button data-action="copy"
                                class="btn btn-color-gray-500 btn-active-color-primary btn-icon btn-sm btn-outline-light copyButton"
                                data-target="locationValue_{{ $meeting->id }}">
                                <i class="ki-solid ki-copy fs-2"></i>
                            </button>
                        </div>
                    @else
                        <span class="badge badge-light-danger fs-7 fw-bold">No location</span>
                    @endif
                </td>
                
                <td>
                    @if (auth()->user()->can('update meeting'))
                        <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif
                    @if (auth()->user()->can('delete meeting'))
                        <button class="btn btn-sm btn-danger delete-btn"
                            data-url="{{ route('meetings.destroy', $meeting->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    <!--end::Tbody-->
</table>
<!--end::Table-->

<script>
    $(document).ready(function() {
        $('#kt_datatable_dom_positioning').dataTable({
            "searching": true,
            "ordering": true,
            responsive: true,
        });
    });

    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function() {
    $(document).on('click', '.copyButton', function() {
        const targetId = $(this).data('target');
        const textToCopy = $(`#${targetId}`).text().trim();
        const button = $(this);
        const originalIcon = button.find('i');

        if (navigator.clipboard) {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    showSuccessIcon(button);
                })
                .catch(err => {
                    console.error('Failed to copy:', err);
                });
        } else {
            const textArea = document.createElement('textarea');
            textArea.value = textToCopy;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            textArea.remove();
            showSuccessIcon(button);
        }
    });

    function showSuccessIcon(button) {
        const successIcon = '<i class="bi bi-check-all fs-2 text-success"></i>';
        button.html(successIcon);

        setTimeout(() => {
            button.html('<i class="ki-solid ki-copy fs-2"></i>');
        }, 3000);
    }
});

</script>

@php
    use Carbon\Carbon;
@endphp
<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-200px">{{ __('lang.title') }}</th>
            <th class="min-w-80px">{{ __('lang.start_date') }}</th>
            <th class="min-w-80px">{{ __('lang.end_date') }}</th>
            <th class="min-w-50px">{{ __('lang.duration') }}</th>
            <th class="min-w-50px">{{ __('lang.status') }}</th>
            <th class="min-w-50px">{{ __('lang.participants') }}</th>
            <th class="min-w-100px">{{ __('lang.checklist') }}</th>
            <th class="min-w-50px">{{ __('lang.received_file') }}</th>
            <th class="min-w-50px">{{ __('lang.uploaded_file') }}</th>
            <th class="min-w-200px">{{ __('lang.description') }}</th>
            <th class="min-w-200px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>
                    <strong class="text-primary">{{ $task->title }}</strong>
                </td>
                <td>{{ Carbon::parse($task->start_date)->format('d M, Y') }}</td>
                <td>{{ Carbon::parse($task->end_date)->format('d M, Y') }}</td>
                <td>
                    <span class="badge rounded-pill bg-secondary">{{ $task->duration }}</span>
                </td>
                <td>
                    @if (Carbon::parse($task->end_date)->isPast() && $task->status === 'pending')
                        <span class="badge badge-light-danger fw-bold me-auto px-4 py-3">Overdue</span>
                    @else
                        <span
                            class="badge badge-light-{{ $task->status === 'done' ? 'success' : 'warning' }} fs-7 fw-bold">
                            {{ $task->status }}
                        </span>
                    @endif
                </td>
                <td>
                    <span class="badge badge-primary p-2 cursor-pointer gap-1" data-bs-toggle="modal"
                        data-bs-target="#employeesModal{{ $task->id }}">
                        <i class="bi bi-people-fill text-white"></i>
                        {{ $task->participants }}-view
                    </span>
                    <x-models.show_task_employee_model :task="$task" />
                </td>
                <td>
                    <span class="badge bg-primary cursor-pointer p-2 text-white gap-1" data-bs-toggle="modal"
                        data-bs-target="#addChecklistModal{{ $task->id }}">
                        <i class="bi bi-clipboard2-check text-white"></i>
                        <span>checklist</span>
                    </span>
                    <x-models.show_task_checklist_model :task="$task" />

                </td>
                <td>
                    @if ($task->received_file_path)
                        <a href="{{ route('task.download', ['filename' => $task->received_file_path]) }}"
                            class="btn btn-icon btn-light pulse me-10 mb-10">
                            <i class="ki-duotone ki-document fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span class="pulse-ring"></span>
                        </a>
                    @else
                        <span class="badge badge-light-danger">No File</span>
                    @endif
                </td>
                <td>
                    @if ($task->uploaded_file_path)
                        <a href="{{ route('task.download', ['filename' => $task->uploaded_file_path]) }}"
                            class="btn btn-icon btn-light pulse me-10 mb-10">
                            <i class="ki-duotone ki-document fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span class="pulse-ring"></span>
                        </a>
                    @else
                        <span class="badge badge-light-danger">No File</span>
                    @endif
                </td>
                <td>
                    <span class="full-description d-none">{!! $task->description !!}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('update tasks'))
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif
                    @if (auth()->user()->can('delete tasks'))
                        <button class="btn btn-sm btn-danger delete-btn"
                            data-url="{{ route('task.destroy', $task->id) }}">
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
        $('.read-more').click(function() {
            var $this = $(this);
            var $shortDesc = $this.siblings('.short-description');
            var $fullDesc = $this.siblings('.full-description');
            if ($fullDesc.hasClass('d-none')) {
                $shortDesc.addClass('d-none');
                $fullDesc.removeClass('d-none');
                $this.text('Read Less');
            } else {
                $shortDesc.removeClass('d-none');
                $fullDesc.addClass('d-none');
                $this.text('Read More');
            }
        });
    });
</script>

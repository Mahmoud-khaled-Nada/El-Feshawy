<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-250px">{{ __('lang.name') }}</th>
            <th class="min-w-100px">{{ __('lang.email') }}</th>
            <th class="min-w-100px">{{ __('lang.phone') }}</th>
            <th class="min-w-150px">{{ __('lang.code') }}</th>
            <th class="min-w-100px">{{ __('lang.status') }}</th>
            <th class="min-w-200px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                {{-- <td>
                    <span class="badge badge-light-success fs-7 fw-bold cursor-pointer symbol symbol-35px">
                        <img onerror="this.onerror=null;this.src='{{ asset('assets/media/svg/files/blank-image.svg') }}'"
                            src="{{ $employee->image }}" class="rounded-3" a>
                    </span>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $employee->name }}</span>
                </td> --}}

                <td class="d-flex justify-content-start align-items-center">
                    <span class="badge badge-light-success fs-7 fw-bold cursor-pointer symbol symbol-35px">
                        <img 
                            onerror="this.onerror=null;this.src='{{ asset('assets/media/svg/files/blank-image.svg') }}'" 
                            src="{{ $employee->image }}"
                            class="rounded-3"
                            alt="{{ $employee->name }}'s avatar">
                    </span>
                    <strong class="text-primary ms-2">{{ $employee->name }}</strong>
                </td>
                <td>{{ $employee->email }}</td>
                <td>
                    {{ $employee->phone }}
                </td>
                <td>
                    {{ $employee->code }}
                </td>
                <td>
                    @if ($employee->status == 1)
                        <span class="badge bg-success">{{ __('lang.active') }}</span>
                    @else
                    <span class="badge bg-warning">{{ __('lang.inactive') }}</span>
                    @endif
                </td>
                <td>
                    @if (auth()->user()->can('update employees'))
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif
                    @if (auth()->user()->can('delete employees'))
                        @if ($employee->status == 1)
                            <button class="btn btn-sm btn-danger delete-btn"
                            data-url="{{ route('employees.destroy', $employee->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        @else
                            <a type="button" class="btn btn-sm btn-success me-2"
                                href="{{ route('employees.destroy', $employee->id) }}">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        </button>
                        @endif
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
</script>

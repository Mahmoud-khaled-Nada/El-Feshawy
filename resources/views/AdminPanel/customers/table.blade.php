<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-150px">{{ __('lang.name') }}</th>
            <th class="min-w-100px">{{ __('lang.email') }}</th>
            <th class="min-w-100px">{{ __('lang.phone') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td class="d-flex justify-content-start align-items-center">
                    <span class="badge badge-light-success fs-7 fw-bold cursor-pointer symbol symbol-35px">
                        <img 
                            onerror="this.onerror=null;this.src='{{ asset('assets/media/svg/files/blank-image.svg') }}'" 
                            src="{{ url('uploads/avatars/' . $customer->avatar) }}" 
                            class="rounded-3"
                            alt="{{ $customer->name }}'s avatar">
                    </span>
                    <strong class="text-primary ms-2">{{ $customer->name }}</strong>
                </td>
                <td>{{ $customer->email }}</td>
                <td>
                    @if (optional($customer->inquiry)->second_phone)
                        {{ $customer->phone . '-' . $customer->inquiry->second_phone }}
                    @else
                        {{ $customer->phone }}
                    @endif
                </td>
                <td>
                    @if (auth()->user()->can( 'delete employees'))
                    <button class="btn btn-sm btn-danger delete-btn"
                    data-url="{{ route('customers.destroy', $customer->id) }}">
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
</script>

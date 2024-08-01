<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-250px">{{ __('lang.name') }}</th>
            <th class="min-w-100px">{{ __('lang.email') }}</th>
            <th class="min-w-100px">{{ __('lang.role') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $admin->name }}</span>
                </td>
                <td>{{ $admin->email }}</td>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $admin->roles->first()->name }}</span>
                </td>
                <td>
                    <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-light me-2">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <a type="button" class="btn btn-sm btn-danger me-2 delete-btn"
                        data-url="{{ route('admins.destroy', $admin->id) }}">
                        <i class="bi bi-file-x-fill"></i>
                    </a>
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

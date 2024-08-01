<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-250px">{{ __('lang.name') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $role->name }}</span>
                </td>
                <td>
                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-light me-2">
                        <i class="bi bi-pencil-square"></i>
                    </a>


                    <a type="submit" class="btn btn-sm btn-danger me-2 delete-btn"
                        data-url="{{ route('role.destroy', $role->id) }}">
                        <i class="bi bi-file-x-fill"></i>
                    </a>

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

@php
    use Carbon\Carbon;
@endphp

<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-150px">{{ __('lang.name') }}</th>
            <th class="min-w-200px">{{ __('lang.email') }}</th>
            <th class="min-w-100px">{{ __('lang.phone') }}</th>
            <th class="min-w-100px">{{ __('lang.date') }}</th>
            <th class="min-w-50px">{{ __('lang.type') }}</th>
            <th class="min-w-50px">{{ __('lang.file') }}</th>
            <th class="min-w-250px">{{ __('lang.message') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appoint)
            <tr>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">
                        {{ $appoint->first_name . ' ' . $appoint->last_name }}
                    </span>
                </td>
                <td>{{ $appoint->email }}</td>
                <td>{{ $appoint->phone }}</td>
                <td>{{ Carbon::parse($appoint->created_at)->format('d M, Y') }}</td>
                <td>
                    <span class="badge border border-success text-success">{{ $appoint->type }}</span>
                </td>
                <td>
                    @if ($appoint->file)
                        <a href="{{ route('appointmentReq.download', ['filename' => basename($appoint->file)]) }}"
                            class="btn btn-icon btn-light pulse me-10 mb-10">
                            <i class="ki-duotone ki-document fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="pulse-ring"></span>
                        </a>
                    @else
                        <span class="badge badge-light-danger">No File</span>
                    @endif

                </td>
                <td>
                    <span class="full-description d-none">{!! $appoint->message !!}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('delete inquiries'))
                        <button type="submit" class="btn btn-sm btn-danger delete-btn" style="width: 70%"
                            data-url="{{ route('appointmentReq.destroy', $appoint->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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

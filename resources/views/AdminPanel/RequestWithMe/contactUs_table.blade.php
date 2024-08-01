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
            <th class="min-w-250px">{{ __('lang.message') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contactUs as $contac)
            <tr>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold">
                        {{ $contac->first_name . ' ' . $contac->last_name }}
                    </span>
                </td>
                <td>{{ $contac->email }}</td>
                <td>{{ $contac->phone }}</td>
                <td>{{ Carbon::parse($contac->created_at)->format('d M, Y') }}</td>
                <td>
                    <span class="badge border border-danger text-danger">contac us</span>
                </td>
                <td>
                    <span class="full-description d-none">{!! $contac->message !!}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('delete inquiries'))
                        <button type="submit" class="btn btn-sm btn-danger delete-btn" style="width: 70%"
                            data-url="{{ route('contactUsReq.destroy', $contac->id) }}">
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

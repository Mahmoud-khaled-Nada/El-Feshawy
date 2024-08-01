<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-150px">{{ __('lang.name') }}</th>
            <th class="min-w-150px">{{ __('lang.email') }}</th>
            <th class="min-w-150px">{{ __('lang.phone') }}</th>
            <th class="min-w-150px">{{ __('lang.status') }}</th>
            <th class="min-w-150px">{{ __('lang.subject') }}</th>
            <th class="min-w-200px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inquiries as $req)
            <tr>
                <td class="fw-medium">
                    {{ $req->customer->name }}
                </td>
                <td>
                    {{ $req->customer->email }}
                </td>
                <td>
                    {{ $req->second_phone . '--' . $req->customer->phone }}
                </td>
                <td>
                    @if ($req->status === 'appointment')
                        <span class="badge border border-success text-success">{{ $req->status }}</span>
                    @else
                        <span class="badge border border-danger text-danger">{{ $req->status }}</span>
                    @endif
                </td>
                <td>
                    <span class="short-description">{{ Str::limit($req->subject, 10, '') }}</span>
                    <span class="full-description d-none">{{ $req->subject }}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('update inquiries'))
                        @if ($req->status === 'appointment')
                            <a href="{{ route('inquiries.create', $req->customer->id) }}"
                                class="btn btn-sm btn-success">
                                <i class="bi bi-box-arrow-up-right"></i> +Meet
                            </a>
                        @endif
                    @endif
                    @if (auth()->user()->can('delete inquiries'))
                        <button type="submit" class="btn btn-sm btn-danger delete-btn"
                            style="{{ $req->status !== 'appointment' ? 'width: 70%;' : '' }}"
                            data-url="{{ route('inquiries.destroy', $req->id) }}">
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

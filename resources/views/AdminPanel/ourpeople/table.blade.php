<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-200px">{{ __('lang.title') }}</th>
            <th class="min-w-300px">{{ __('lang.description') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peoples as $people)
            <tr>
                <td>
                    <span class="badge badge-light-success fs-7 fw-bold cursor-pointer symbol symbol-35px">
                        <img onerror="this.onerror=null;this.src='{{ asset('assets/media/svg/files/blank-image.svg') }}'"
                            src="{{ $people->image }}" class="rounded-3" a>
                    </span>
                    <span class="badge badge-light-success fs-7 fw-bold">{{ $people->title }}</span>
                </td>
                <td>
                    <span class="full-description d-none">{!! $people->description !!}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('update people'))
                        <a href="{{ route('people.edit', $people->id) }}" class="btn btn-sm btn-light me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif

                    @if (auth()->user()->can('delete people'))
                        <a data-url="{{ route('people.destroy', $people->id) }}" type='button'
                            class="btn btn-sm btn-danger me-2 delete-btn">
                            <i class="bi bi-file-x-fill"></i>
                        </a>
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

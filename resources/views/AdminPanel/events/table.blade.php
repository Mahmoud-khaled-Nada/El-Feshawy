<!--begin::Table-->
<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <!--begin::Thead-->
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-200px">{{ __('lang.title') }}</th>
            <th class="min-w-100px">{{ __('lang.date') }}</th>
            <th class="min-w-200px">{{ __('lang.location') }}</th>
            <th class="min-w-250px">{{ __('lang.description') }}</th>
            <th class="min-w-250px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <!--end::Thead-->
    <!--begin::Tbody-->
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>
                    <strong class="text-primary">{{ $event->title }}</strong>
                </td>
                <td>{{ $event->date }}</td>
                <td>
                    <a href="{{ $event->location }}" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-arrow-up-right-circle-fill"></i> Location
                    </a>
                </td>
                <td>
                    <span class="short-description">{{ Str::limit($event->description, 10, '') }}</span>
                    <span class="full-description d-none">{{ $event->description }}</span>
                    <button type="button" class="btn btn-link fs-6 fw-bold read-more">Read More</button>
                </td>
                <td>
                    @if (auth()->user()->can('update events'))
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    @endif

                    @if (auth()->user()->can('delete events'))
                        <button class="btn btn-sm btn-danger delete-btn"
                            data-url="{{ route('events.destroy', $event->id) }}">
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

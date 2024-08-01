<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
        <tr class="fw-6 fw-semibold text-gray-600">
            <th class="min-w-100px">{{ __('lang.email') }}</th>
            <th class="min-w-100px">{{ __('lang.phone') }}</th>
            <th class="min-w-100px">{{ __('lang.facebook') }}</th>
            <th class="min-w-100px">{{ __('lang.linkedin') }}</th>
            <th class="min-w-100px">{{ __('lang.instagram') }}</th>
            <th class="min-w-100px">{{ __('lang.X') }}</th>
            <th class="min-w-100px">{{ __('lang.youtube') }}</th>
            <th class="min-w-100px">{{ __('lang.location') }}</th>
            <th class="min-w-100px">{{ __('lang.address') }}</th>
            <th class="min-w-100px">{{ __('lang.message') }}</th>
            <th class="min-w-150px">{{ __('lang.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>{{$contact->facebook}}</td>
                <td>{{$contact->linkedin}}</td>
                <td>{{$contact->instagram}}</td>
                <td>{{$contact->X}}</td>
                <td>{{$contact->youtube}}</td>
                <td>{{$contact->location}}</td>
                <td>{{$contact->address}}</td>
                <td>{!!$contact->message!!}</td>
                <td>
                     <!-- @if (auth()->user()->can('update news')) -->
                        <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-light me-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                     <!-- @endif -->

                     <!-- @if (auth()->user()->can('delete news')) -->
                        <a data-url="{{ route('contact.destroy', $contact->id) }}" type='button'
                            class="btn btn-sm btn-danger me-2 delete-btn">
                            <i class="bi bi-file-x-fill"></i>
                        </a>
                    <!-- @endif -->

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

    $(document).ready(function(){
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

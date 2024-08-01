@props(['meeting'])

<div class="modal fade" id="customersModal{{ $meeting->id }}" tabindex="-1"
    aria-labelledby="customersModalLabel{{ $meeting->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="customersModalLabel{{ $meeting->id }}">{{ __('lang.customers') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($meeting->participatingCustomers->isEmpty())
                    <p>{{ __('lang.no_customers') }}</p>
                @else
                    <ol class="list-group">
                        @foreach ($meeting->participatingCustomers as $customer)
                            <li class="list-group-item d-flex justify-content-start align-items-center"
                                style="border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.125); border-radius: 0;">
                                <img src="{{ asset('default_user.jpg') }}" alt="{{ $customer->id }}" width="70"
                                    height="70" class="rounded-circle me-3">
                                <div>
                                    <h5 class="fw-bold mb-1"><strong>{{ __('lang.name') }}:</strong>
                                        {{ $customer->name }}</h5>
                                    <p class="mb-0"><strong>{{ __('lang.email') }}:</strong> {{ $customer->email }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('lang.close') }}</button>
            </div>
        </div>
    </div>
</div>

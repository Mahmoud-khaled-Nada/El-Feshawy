@props(['meeting'])

<div class="modal fade" id="employeesModal{{ $meeting->id }}" tabindex="-1"
    aria-labelledby="employeesModalLabel{{ $meeting->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="employeesModalLabel{{ $meeting->id }}">{{ __('lang.employees') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($meeting->participatingEmployees->isEmpty())
                    <p>{{ __('lang.no_employees') }}</p>
                @else
                    <ol class="list-group">
                        @foreach ($meeting->participatingEmployees as $employee)
                            <li class="list-group-item d-flex justify-content-start align-items-center"
                                style="border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.125); border-radius: 0;">
                                <img src="{{ asset('default_user.jpg') }}" alt="{{ $employee->id }}" width="70"
                                    height="70" class="rounded-circle me-3">
                                <div>
                                    <h5 class="fw-bold mb-1"><strong>{{ __('lang.name') }}:</strong>
                                        {{ $employee->name }}</h5>
                                    <p class="mb-0"><strong>{{ __('lang.email') }}:</strong> {{ $employee->email }}
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

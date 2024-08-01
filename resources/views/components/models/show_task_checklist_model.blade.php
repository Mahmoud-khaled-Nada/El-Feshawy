@props(['task'])

<div class="modal fade" id="addChecklistModal{{ $task->id }}" tabindex="-1"
    aria-labelledby="addChecklistModalLabel{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChecklistModalLabel{{ $task->id }}">{{ __('lang.checklist') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (sizeof($task->taskChecklistItems) > 0)
                    @foreach ($task->taskChecklistItems as $item)
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckChecked{{ $item->id }}" {{ $item->checked ? 'checked' : '' }}>
                            <label class="form-check-label fs-5" for="flexCheckChecked{{ $item->id }}">
                                {{ $item->item }}
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="fs-4 text-warning">{{ __('lang.is_checklist_found') }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('lang.close') }}</button>
            </div>
        </div>
    </div>
</div>

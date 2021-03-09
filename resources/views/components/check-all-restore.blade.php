<button class="btn btn-outline-primary btn-sm"
        data-checkbox=".item-checkbox"
        data-form="restore-selected-form"
        data-toggle="modal"
        data-target="#restore-selected-model">
    <i class="fas fa-trash-restore"></i>
    @lang('check-all.actions.restore')
</button>

<!-- Modal -->
<div class="modal fade" id="restore-selected-model" tabindex="-1" role="dialog"
     aria-labelledby="selected-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selected-modal-title">
                    @lang('check-all.dialogs.restore.title')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @lang('check-all.dialogs.restore.info', ['type' => $resource ?? ''])
                <form action="{{ route('dashboard.restore.selected') }}"
                      id="restore-selected-form"
                      method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="type" value="{{ $type ?? '' }}">
                    <input type="hidden" name="resource" value="{{ $resource ?? '' }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    @lang('check-all.dialogs.restore.cancel')
                </button>
                <button type="submit" class="btn btn-primary btn-sm" form="restore-selected-form">
                    @lang('check-all.dialogs.restore.confirm')
                </button>
            </div>
        </div>
    </div>
</div>
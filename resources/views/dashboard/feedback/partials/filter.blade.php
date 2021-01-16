{{ BsForm::resource('feedback')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('feedback.filter'))

    <div class="row">
        <div class="col-md-3 d-flex align-items-end">
            {{ BsForm::radio('status')
                ->value('read')
                ->checked(request('status') == 'read')
                 ->label(trans('feedback.attributes.read')) }}
        </div>
        <div class="col-md-3 d-flex align-items-end">
            {{ BsForm::radio('status')
                ->value('unread')
                ->checked(request('status') == 'unread')
                 ->label(trans('feedback.attributes.unread')) }}
        </div>
        <div class="col-md-3 d-flex align-items-end">
            {{ BsForm::radio('status')
                ->value('all')
                ->checked(request('status') == 'all')
                 ->label(trans('feedback.actions.list')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('feedback.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('feedback.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}

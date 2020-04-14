<button
    type="button"
   id="filter-popover"
   class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('accounts::users')->get(null) }}
        {{ BsForm::text('name')->value(request('name')) }}

        {{ BsForm::text('email')->value(request('email')) }}

        {{ BsForm::select('type')
                ->options(trans('accounts::users.types'))
                ->value(request('type'))
                ->placeholder(trans('accounts::users.select-type')) }}

        {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('accounts::users.perPage')) }}

        <button type='submit' class='btn btn-primary btn-sm'>
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('accounts::users.actions.filter')
        </button>

    {{ BsForm::close() }}
</div>

@push('scripts')
    <script>
        $('#filter-popover').popover({
            html: true,
            container: 'body',
            content: function () {
                return $("#popover-content").html();
            },
            placement: 'bottom',
            sanitize: false,
        });
    </script>
@endpush

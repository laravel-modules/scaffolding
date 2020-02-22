<button
    type="button"
   id="filter-popover"
   class="btn btn-outline-dark btn-sm">
    <i class="fas fa fa-fw fa-filter"></i>
</button>

<div id="popover-content" class="d-none">
    {{ BsForm::resource('users')->get(null) }}
        {{ BsForm::text('name')->value(request('name')) }}

        {{ BsForm::text('email')->value(request('email')) }}

        {{ BsForm::select('type')
                ->options(trans('users.types'))
                ->value(request('type'))
                ->placeholder(trans('users.select-type')) }}

        {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('users.perPage')) }}

        <button type='submit' class='btn btn-primary btn-sm'>
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('users.actions.filter')
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

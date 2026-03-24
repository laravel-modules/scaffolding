@if(! empty(\App\Models\MailTemplate::types()) && Gate::allows('create', \App\Models\MailTemplate::class))
    <div class="dropdown">
        <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa fa-fw fa-plus"></i>
            @lang('mail-templates.actions.create')
        </button>
        <div class="dropdown-menu">
            @foreach(\App\Models\MailTemplate::types() as $value => $type)
                <a class="dropdown-item" href="{{ route('dashboard.mail-templates.create', ['model_type' => $value]) }}">
                    {{ $type }}
                </a>
            @endforeach
        </div>
    </div>
@endif


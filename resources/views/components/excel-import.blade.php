@props([
    'class' => 'btn btn-outline-primary btn-sm',
    'model'
])
@php($id = str($model)->classBasename()->plural()->kebab()->toString())
@if(in_array(\App\Excel\Importable::class, class_implements($model)))
    <a href="#{{ $id }}-excel-model"
       class="btn btn-outline-primary btn-sm"
       data-toggle="modal">
        <i class="fas fa fa-fw fa-upload"></i>
        {{ __('excel.import') }}
    </a>


    <!-- Modal -->
    <div class="modal fade" id="{{ $id }}-excel-model" tabindex="-1" role="dialog"
         aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="modal-title">{{ __('excel.import-title') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ BsForm::post($url ?? route('dashboard.excel.import', ['model' => $model]), [
                        'enctype' => 'multipart/form-data',
                        'id' => "$id-excel-form-model"
                    ]) }}
                    {{ BsForm::file('file')->label(__('excel.file'))->note(__('excel.note')) }}
                    {{ BsForm::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('excel.cancel') }}
                    </button>
                    <button type="submit" form="{{ $id }}-excel-form-model" class="btn btn-danger">
                        {{ __('excel.upload') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

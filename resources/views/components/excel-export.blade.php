@props([
    'class' => 'btn btn-outline-secondary btn-sm',
    'model'
])
@if(in_array(\App\Excel\Exportable::class, class_implements($model)))
    <div class="dropdown">
        <button class="{{ $class }} dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa fa-fw fa-download"></i>
            {{ __('excel.export') }}
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('dashboard.excel.export', [
            'model' => $model,
            'extension' => 'csv'
        ]) }}">CSV</a>

            <a class="dropdown-item" href="{{ route('dashboard.excel.export', [
            'model' => $model,
            'extension' => 'xlsx'
        ]) }}">XLSX</a>

            <a class="dropdown-item" href="{{ route('dashboard.excel.export', [
            'model' => $model,
            'extension' => 'xls'
        ]) }}">XLS</a>
        </div>
    </div>
@endif


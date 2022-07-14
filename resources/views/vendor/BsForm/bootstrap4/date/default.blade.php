<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<?php $value = $value && ! Str::contains($value, '___') ? \Carbon\Carbon::parse($value)
    ->format(
        isset($attributes['data-format']) ? $attributes['data-format'] : 'Y/m/d H:i'
    ): $value ?>
<div class="form-group">
    @if($label)
        {{ Form::label($name, $label) }}
    @endif
    {{ Form::text($name, $value, array_merge([
        'class' => 'datepicker form-control'.$invalidClass,
        'autocomplete' => 'off',
    ], $attributes)) }}

    @if($inlineValidation)
        @if($errors->{$errorBag}->has($nameWithoutBrackets))
            <div class="invalid-feedback">
                {{ $errors->{$errorBag}->first($nameWithoutBrackets) }}
            </div>
        @else
            <small class="form-text text-muted">{{ $note }}</small>
        @endif
    @else
        <small class="form-text text-muted">{{ $note }}</small>
    @endif
</div>

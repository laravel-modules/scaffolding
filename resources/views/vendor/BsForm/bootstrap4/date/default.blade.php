<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>
<div class="form-group">
    @if($label)
        {{ Form::label($name, $label) }}
    @endif
    <?php
    $format = $attributes['data-format'] ?? 'Y/m/d';
    $value = $value instanceof \Carbon\Carbon ? $value->format($format) : $value;
    ?>
    {{ Form::text($name, $value, array_merge([
        'class' => 'datepicker form-control'.$invalidClass,
        'autocomplete' => 'off',
        'data-datepicker' => '1',
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

<?php $invalidClass = $errors->{$errorBag}->has($nameWithoutBrackets) ? ' is-invalid' : ''; ?>

@if($currency)
    <div class="form-group">
        @if($label)
            {{ Form::label($name, $label) }}
        @endif
        <div class="input-group mb-2">
            {{ Form::text($name, $value, array_merge([
                'class' => 'form-control'.$invalidClass,
                'data-inputmask' => "'alias': 'currency'"
            ], $attributes)) }}
            <div class="input-group-append">
                <div class="input-group-text">{{ $currency }}</div>
            </div>
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
    </div>
@else
    <div class="form-group">
        @if($label)
            {{ Form::label($name, $label) }}
        @endif
        {{ Form::text($name, $value, array_merge([
                'class' => 'form-control'.$invalidClass,
                'data-inputmask' => "'alias': 'currency'"
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
@endif
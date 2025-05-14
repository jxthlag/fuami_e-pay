@props([
    'label' => 'Password',
    'name' => 'password',
    'placeholder' => '',
    'required' => true
])

<label for="{{ $name }}">{{ $label }}</label>

<input
    type="password"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name) }}"
    {{ $required ? 'required' : '' }}
    placeholder="{{ $placeholder }}"
    class="form-control @error($name) is-invalid @enderror"
    title="At least 8 characters with letters, numbers, and symbols."
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

<div class="mt-2 small d-flex flex-wrap gap-2" id="{{ $name }}-rules">
    <span id="{{ $name }}-rule-length" class="text-danger">• At least 8 characters</span>
    <span>|</span>
    <span id="{{ $name }}-rule-letter" class="text-danger">Contains letters</span>
    <span>|</span>
    <span id="{{ $name }}-rule-number" class="text-danger">Contains numbers</span>
    <span>|</span>
    <span id="{{ $name }}-rule-symbol" class="text-danger">Contains symbols</span>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('{{ $name }}');

    const ruleLength = document.getElementById('{{ $name }}-rule-length');
    const ruleLetter = document.getElementById('{{ $name }}-rule-letter');
    const ruleNumber = document.getElementById('{{ $name }}-rule-number');
    const ruleSymbol = document.getElementById('{{ $name }}-rule-symbol');

    input.addEventListener('input', () => {
        const val = input.value;

        ruleLength.classList.toggle('text-success', val.length >= 8);
        ruleLength.classList.toggle('text-danger', val.length < 8);

        ruleLetter.classList.toggle('text-success', /[a-zA-Z]/.test(val));
        ruleLetter.classList.toggle('text-danger', !/[a-zA-Z]/.test(val));

        ruleNumber.classList.toggle('text-success', /[0-9]/.test(val));
        ruleNumber.classList.toggle('text-danger', !/[0-9]/.test(val));

        ruleSymbol.classList.toggle('text-success', /[^a-zA-Z0-9]/.test(val));
        ruleSymbol.classList.toggle('text-danger', !/[^a-zA-Z0-9]/.test(val));
    });
});
</script>

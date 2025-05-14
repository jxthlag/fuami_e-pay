@props([
    'label',
    'name',
    'maxlength' => 15,
    'placeholder' => '',
    'required' => true
])

<label for="{{ $name }}">{{ $label }}</label>

{{-- Warnings --}}
<small class="text-danger d-none" id="{{ $name }}-warning-numbers">
    *Only numbers are allowed.
</small>
<small class="text-danger d-none" id="{{ $name }}-warning-length">
    *Must not exceed {{ $maxlength - 1 }} digits.
</small>

<input
    type="text"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name) }}"
    maxlength="{{ $maxlength }}"
    {{ $required ? 'required' : '' }}
    placeholder="{{ $placeholder }}"
    class="form-control only-numbers @error($name) is-invalid @enderror"
    title="Only numbers are allowed. Max {{ $maxlength - 1 }} digits."
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('{{ $name }}');
    const numberWarning = document.getElementById(`${input.name}-warning-numbers`);
    const lengthWarning = document.getElementById(`${input.name}-warning-length`);
    const maxLength = {{ $maxlength - 1 }};

    let numberTimeout = null;
    let lengthTimeout = null;

    input.addEventListener('input', () => {
        const original = input.value;

        // Non-digit check
        const hasInvalidChars = /[^0-9]/.test(original);
        if (hasInvalidChars) {
            numberWarning.classList.remove('d-none');
            clearTimeout(numberTimeout);
            numberTimeout = setTimeout(() => {
                numberWarning.classList.add('d-none');
            }, 3000);
        }

        // Length check
        if (original.length > maxLength) {
            lengthWarning.classList.remove('d-none');
            clearTimeout(lengthTimeout);
            lengthTimeout = setTimeout(() => {
                lengthWarning.classList.add('d-none');
            }, 3000);
        } else {
            lengthWarning.classList.add('d-none');
        }

        // Clean input to only digits
        let cleaned = original.replace(/[^0-9]/g, '');

        // Enforce max length
        if (cleaned.length > maxLength) {
            cleaned = cleaned.slice(0, maxLength);
        }

        // Only update input if needed
        if (input.value !== cleaned) {
            input.value = cleaned;
        }
    });
});
</script>

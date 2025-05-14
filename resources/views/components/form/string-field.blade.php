@props([
    'label',
    'name',
    'maxlength' => 25,
    'placeholder' => '',
    'required' => true
])

<label for="{{ $name }}">{{ $label }}</label>

{{-- Warnings go directly after the label --}}
<small class="text-danger d-none" id="{{ $name }}-warning-chars">
    *Letters only.
</small>
<small class="text-danger d-none" id="{{ $name }}-warning-length">
    *Must not exceed {{ $maxlength - 1 }} characters.
</small>

<input
    type="text"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, optional($profile)->$name ?? '') }}"
    maxlength="{{ $maxlength }}"
    {{ $required ? 'required' : '' }}
    placeholder="{{ $placeholder }}"
    class="form-control only-letters @error($name) is-invalid @enderror"
    title="Only letters, spaces, and hyphens are allowed. Max {{ $maxlength }} characters."
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('{{ $name }}');
    const charWarning = document.getElementById(`${input.name}-warning-chars`);
    const lengthWarning = document.getElementById(`${input.name}-warning-length`);
    const maxLength = {{ $maxlength - 1 }};

    let charTimeout = null;
    let lengthTimeout = null;

    input.addEventListener('input', () => {
        const original = input.value;

        // Character validation
        const hasInvalidChars = /[^A-Za-z\s\-]/.test(original);
        if (hasInvalidChars) {
            charWarning.classList.remove('d-none');
            clearTimeout(charTimeout);
            charTimeout = setTimeout(() => {
                charWarning.classList.add('d-none');
            }, 3000);
        }

        // Length validation
        if (original.length > maxLength) {
            lengthWarning.classList.remove('d-none');
            clearTimeout(lengthTimeout);
            lengthTimeout = setTimeout(() => {
                lengthWarning.classList.add('d-none');
            }, 3000);
        }

        // Sanitize input
        let cleaned = original.replace(/[^A-Za-z\s\-]/g, '');

        if (cleaned !== original) {
            input.value = cleaned;
        }

        if (cleaned.length > maxLength) {
            input.value = cleaned.slice(0, maxLength);
        }
    });
});
</script>

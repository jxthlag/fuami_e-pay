@props([
    'label' => 'Username',
    'name' => 'username',
    'maxlength' => 21,
    'placeholder' => '',
    'required' => true
])

<label for="{{ $name }}">{{ $label }}</label>

<small class="text-danger d-none" id="{{ $name }}-warning-space">
    *must not contain spaces.
</small>
<small class="text-danger d-none" id="{{ $name }}-warning-length">
    *must not exceed {{ $maxlength - 1 }} characters.
</small>

<input
    type="text"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name) }}"
    maxlength="{{ $maxlength }}"
    {{ $required ? 'required' : '' }}
    placeholder="{{ $placeholder }}"
    class="form-control only-username @error($name) is-invalid @enderror"
    title="No spaces allowed. Max {{ $maxlength - 1 }} characters."
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('{{ $name }}');
    const spaceWarning = document.getElementById('{{ $name }}-warning-space');
    const lengthWarning = document.getElementById('{{ $name }}-warning-length');
    const maxLength = {{ $maxlength - 1 }};

    let timeout;

    // Prevent typing space
    input.addEventListener('keydown', (e) => {
        if (e.key === ' ') {
            e.preventDefault(); // block space
            spaceWarning.classList.remove('d-none');
            clearTimeout(timeout);
            timeout = setTimeout(() => spaceWarning.classList.add('d-none'), 3000);
        }
    });

    input.addEventListener('input', () => {
        let value = input.value;

        // Remove any spaces that slipped in
        if (/\s/.test(value)) {
            value = value.replace(/\s/g, '');
            input.value = value;
        }

        // Length check
        if (value.length > maxLength) {
            lengthWarning.classList.remove('d-none');
            clearTimeout(timeout);
            timeout = setTimeout(() => lengthWarning.classList.add('d-none'), 3000);
            input.value = value.slice(0, maxLength);
        } else {
            lengthWarning.classList.add('d-none');
        }
    });
});
</script>

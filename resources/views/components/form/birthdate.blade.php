@props([
    'label' => 'Birthdate',
    'name' => 'birthdate',
    'required' => true,
])

<label for="{{ $name }}">{{ $label }}</label>

<small class="text-danger d-none" id="{{ $name }}-warning-date">
    *Birthdate must be in the past (not today or future).
</small>

<input
    type="date"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, optional($profile)->$name ?? '') }}"
    max="{{ now()->subDay()->toDateString() }}"
    {{ $required ? 'required' : '' }}
    class="form-control @error($name) is-invalid @enderror"
    title="Please select a valid birthdate in the past."
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('{{ $name }}');
    const warning = document.getElementById('{{ $name }}-warning-date');
    let timeout = null;

    input.addEventListener('change', () => {
        const selectedDate = new Date(input.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Ignore time

        if (selectedDate >= today) {
            warning.classList.remove('d-none');
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                warning.classList.add('d-none');
            }, 3000);
            input.value = '';
        } else {
            warning.classList.add('d-none');
        }
    });
});
</script>

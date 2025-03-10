<div class="form-group mt-2">
    <label for="{{ $id }}" class="mb-2 labeltxt">{{ $label }}</label>
    <textarea class="form-control " placeholder="{{ $placeholder }}" id="{{ $id }}" rows="5"
        name="{{ $name }}">{{ $value }}</textarea>
    <p class="mb-3 pt-1 helpertxt"> {{ $helpertxt }}</p>
</div>

<style>
    [data-bs-theme=dark] .helpertxt {
        color: white !important;
    }
    [data-bs-theme=dark] .labeltxt {
        color: white !important;
    }

</style>

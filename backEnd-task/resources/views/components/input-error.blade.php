@props(['name', 'default' => ''])
<div class="invalid-feedback">
    @if ($errors->has($name))
        {{ $errors->first($name) }}
    @else
        {{ $default }}
    @endif
</div>

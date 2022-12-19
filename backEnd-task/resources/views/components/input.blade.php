@props(['type', 'name','class'=>'','min'=>null, 'text' => '' ,'note' => '', 'value' => '', 'label' => '', 'required' => false ,'readonly' => false])
<div class="form-group">
    <label class="fieldlabels text-dark"> @lang($text) </label><br>
    <span class="text-danger">@lang($note)</span>
    <input type="{{ $type }}" min="{{$min}}" class="form-control {{$class}} @error($name) is-invalid @enderror validate" value="{{ $value }}"
        id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}>
    <label for="" class="">{{ $label }}</label>
    <x-input-error default="Please enter the field." name="{{ $name }}" />
                                <p class="error"> please fill input </p>

</div>

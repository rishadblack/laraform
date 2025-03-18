<div>
    @isset($attributes['label'])
        <label for="{{ $attributes->wire('model')->value }}" @style('font-weight: bold;')>{{ $attributes['label'] }}
            @if (isset($attributes['require']))
                <span class="text-danger">(*)</span>
            @elseif (isset($attributes['nonrequire']))
                <span class="text-warning">{{ __('default.optional') }}</span>
            @endif
        </label>
    @endisset
    <input @if ($attributes['read-only']) readonly @endif
        @if ($attributes['column']) data-column="{{ $attributes['column'] }}" @endif
        @if ($attributes['row']) data-row="{{ $attributes['row'] }}" @endif type="text"
        list="{{ $attributes->wire('model')->value }}_list" {{ $attributes->wire('model') }}
        id="{{ $attributes->wire('model')->value }}" name="{{ $attributes->wire('model')->value }}"
        placeholder="{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
        class="form-control @error($attributes->wire('model')->value) is-invalid @enderror {{ $attributes['class'] }} @if (isset($attributes['valid-status']) && $attributes['valid-status']) is-valid @endif">
    @if (!isset($attributes['is_hide_error']) || (isset($attributes['is_hide_error']) && !$attributes['is_hide_error']))
        @error($attributes->wire('model')->value)
            <div class="invalid-feedback" style="color:red">
                <h6>{{ $message }}</h6>
            </div>
        @enderror
    @endif
    @if (isset($attributes['datalist']))
        @if (count($attributes['datalist']) > 0)
            <datalist id="{{ $attributes->wire('model')->value }}_list">
                @foreach ($attributes['datalist'] as $key => $option)
                    <option value="{{ $key }}">{{ $option }}</option>
                @endforeach
            </datalist>
        @endif
    @endif
</div>

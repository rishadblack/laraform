<div x-data="inputMask('{{ $attributes->wire('model')->value }}', {{ json_encode($mask) }})" x-init="initializeMask()">
    @isset($attributes['label'])
        <label for="{{ $attributes->wire('model')->value }}" style="font-weight: bold;">
            {{ $attributes['label'] }}
            @if (isset($attributes['require']))
                <span class="text-danger">(*)</span>
            @elseif (isset($attributes['nonrequire']))
                <span class="text-warning">{{ __('default.optional') }}</span>
            @endif
        </label>
    @endisset

    <input @if ($attributes['read-only']) readonly @endif x-ref="inputField_{{ $attributes->wire('model')->value }}"
        @if ($attributes['column']) data-column="{{ $attributes['column'] }}" @endif
        @if ($attributes['row']) data-row="{{ $attributes['row'] }}" @endif type="text"
        list="{{ $attributes->wire('model')->value }}_list" {{ $attributes->wire('model') }}
        id="input_{{ $attributes->wire('model')->value }}" name="{{ $attributes->wire('model')->value }}"
        placeholder="{{ $attributes['placeholder'] ?? '' }}"
        class="form-control @error($attributes->wire('model')->value) is-invalid @enderror {{ $attributes['class'] }} @if (isset($attributes['valid-status']) && $attributes['valid-status']) is-valid @endif">

    @error($attributes->wire('model')->value)
        <div class="invalid-feedback" style="color:red">
            <h6>{{ $message }}</h6>
        </div>
    @enderror
</div>

@push('js')
    <script>
        function inputMask(inputId, mask) {
            return {
                mask: null, // This will hold the IMask instance
                initializeMask() {
                    const element = this.$refs['inputField_' + inputId]; // Unique reference for each input
                    const maskOptions = {
                        mask: mask, // Custom pattern for date (DD/MM/YYYY)
                        lazy: false,
                        autofix: true,
                        blocks: {
                            d: {
                                mask: IMask.MaskedRange,
                                placeholderChar: 'd',
                                from: 1,
                                to: 31,
                                maxLength: 2,
                            },
                            m: {
                                mask: IMask.MaskedRange,
                                placeholderChar: 'm',
                                from: 1,
                                to: 12,
                                maxLength: 2,
                            },
                            Y: {
                                mask: IMask.MaskedRange,
                                placeholderChar: 'y',
                                from: 1900,
                                to: 9999, // Allow years between 1900 and 9999
                                maxLength: 4, // Force four digits for year
                            }
                        }

                    };

                    this.mask = IMask(element, maskOptions); // Apply the mask
                }
            };
        }
    </script>
@endpush

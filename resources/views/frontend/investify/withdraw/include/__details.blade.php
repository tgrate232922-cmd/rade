<li>
    <span class="title">{{ __('Withdraw Fee') }}</span>
    <span class="info"><span class="withdrawFee">{{ $charge }}</span> {{ $currency }}</span>
</li>

@if($conversionRate != null)
    <li>
        <span class="title">{{ __('Conversion Rate') }}</span>
        <span class="info"><span class="conversion-rate">1 {{ $currency }} = {{ $conversionRate }}</span></span>
    </li>
    <li>
        <span class="title">{{ __('Pay Amount') }}</span>
        <span class="info"><span class="pay-amount"></span></span>
    </li>
@endif

<li>
    <span class="title">{{ __('Withdraw Account') }}</span>
    <span class="info">{{ $name }}</span>
</li>

@foreach($credentials as $name => $data)
   <li>
     <span class="title">{{ $name }}</span>
    <span class="info" style="display:block; font-size:11px; color:#eafff4; word-break:break-all; overflow-wrap:anywhere;">
        @if($data['type'] == 'file')
            <img src="{{ asset(data_get($data, 'value')) }}" alt="" style="max-width:100%; height:auto; border-radius:6px;"/>
        @else
            {{ data_get($data, 'value') }}
        @endif
    </span>
</li>
@endforeach


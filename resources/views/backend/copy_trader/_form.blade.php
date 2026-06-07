@php
    $copyTrader = $copyTrader ?? null;
    $capitalReturn = old('capital_return', $copyTrader ? (int) $copyTrader->capital_return : 1);
    $status = old('status', $copyTrader ? (int) $copyTrader->status : 1);
    $approved = old('approved', $copyTrader ? (int) $copyTrader->approved : 0);
@endphp

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="site-input-groups">
                    <label class="box-input-label">{{ __('Trader Image') }}</label>
                    <div class="wrap-custom-file">
                        <input
                            type="file"
                            name="image"
                            id="copy-trader-image"
                            accept=".gif, .jpg, .jpeg, .png, .svg"
                            @if(! $copyTrader) required @endif
                        />
                        <label for="copy-trader-image">
                            <img class="upload-icon" src="{{ $copyTrader?->image ? asset($copyTrader->image) : asset('global/materials/upload.svg') }}" alt="">
                            <span>{{ __('Upload Avatar') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Trader Name') }}</label>
            <input type="text" name="name" class="box-input" value="{{ old('name', $copyTrader?->name) }}" required>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Daily Profit %') }}</label>
            <input type="text" name="daily_profit_percentage" class="box-input" oninput="this.value = validateDouble(this.value)" value="{{ old('daily_profit_percentage', $copyTrader?->daily_profit_percentage) }}" required>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Minimum Amount') }}</label>
            <div class="input-group joint-input">
                <input type="text" name="min_amount" class="form-control" oninput="this.value = validateDouble(this.value)" value="{{ old('min_amount', $copyTrader?->min_amount) }}" required>
                <span class="input-group-text">{{ setting('site_currency','global') }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Maximum Amount') }}</label>
            <div class="input-group joint-input">
                <input type="text" name="max_amount" class="form-control" oninput="this.value = validateDouble(this.value)" value="{{ old('max_amount', $copyTrader?->max_amount) }}" required>
                <span class="input-group-text">{{ setting('site_currency','global') }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Duration') }}</label>
            <div class="input-group joint-input">
                <input type="number" min="1" name="duration_days" class="form-control" value="{{ old('duration_days', $copyTrader?->duration_days ?? 1) }}" required>
                <span class="input-group-text">{{ __('Days') }}</span>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Risk Level') }}</label>
            <select name="risk_level" class="form-select" required>
                @foreach(['low' => __('Low'), 'medium' => __('Medium'), 'high' => __('High')] as $value => $label)
                    <option value="{{ $value }}" @selected(old('risk_level', $copyTrader?->risk_level ?? 'medium') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Users Copying') }}</label>
            <input type="number" min="0" name="display_users_copying" class="box-input" value="{{ old('display_users_copying', $copyTrader?->display_users_copying ?? 0) }}" required>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Trader Win Rate') }}</label>
            <div class="input-group joint-input">
                <input type="text" name="win_rate" class="form-control" oninput="this.value = validateDouble(this.value)" value="{{ old('win_rate', $copyTrader?->win_rate ?? 0) }}" required>
                <span class="input-group-text">%</span>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Capital Return') }}</label>
            <select name="capital_return" class="form-select" required>
                <option value="1" @selected((string) $capitalReturn === '1')>{{ __('Yes') }}</option>
                <option value="0" @selected((string) $capitalReturn === '0')>{{ __('No') }}</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Status') }}</label>
            <select name="status" class="form-select" required>
                <option value="1" @selected((string) $status === '1')>{{ __('Active') }}</option>
                <option value="0" @selected((string) $status === '0')>{{ __('Inactive') }}</option>
            </select>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Expert Approval') }}</label>
            <select name="approved" class="form-select" required>
                <option value="1" @selected((string) $approved === '1')>{{ __('Approved') }}</option>
                <option value="0" @selected((string) $approved === '0')>{{ __('Pending') }}</option>
            </select>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="site-input-groups">
            <label class="box-input-label">{{ __('Description') }}</label>
            <textarea name="description" class="form-textarea" rows="4">{{ old('description', $copyTrader?->description) }}</textarea>
        </div>
    </div>
</div>

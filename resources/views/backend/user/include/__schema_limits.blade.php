@can('customer-schema-limit')
    <div class="tab-pane fade" id="pills-schema-limits" role="tabpanel" aria-labelledby="pills-schema-limits-tab">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">{{ __('Per-Plan Subscription Limits') }}</h3>
            </div>
            <div class="site-card-body">
                <p class="mb-4">{{ __('Set how many times this user can invest in each plan. Leave a row empty to use the default unlimited behavior for that plan.') }}</p>

                <form action="{{ route('admin.user.schema-limits.update', $user->id) }}" method="post">
                    @csrf
                    <div id="schema-limit-rows">
                        @forelse($schemaLimits as $index => $limit)
                            <div class="row align-items-end mb-3 schema-limit-row">
                                <div class="col-md-6">
                                    <label class="box-input-label">{{ __('Plan') }}</label>
                                    <select name="limits[{{ $index }}][schema_id]" class="form-select">
                                        <option value="">{{ __('Select Plan') }}</option>
                                        @foreach($schemas as $schema)
                                            <option value="{{ $schema->id }}" @selected($limit->schema_id == $schema->id)>{{ $schema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="box-input-label">{{ __('Max Subscriptions') }}</label>
                                    <input type="number" min="1" class="form-control" name="limits[{{ $index }}][max_subscriptions]" value="{{ $limit->max_subscriptions }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="site-btn-sm red-btn remove-schema-limit">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        @empty
                            <div class="row align-items-end mb-3 schema-limit-row">
                                <div class="col-md-6">
                                    <label class="box-input-label">{{ __('Plan') }}</label>
                                    <select name="limits[0][schema_id]" class="form-select">
                                        <option value="">{{ __('Select Plan') }}</option>
                                        @foreach($schemas as $schema)
                                            <option value="{{ $schema->id }}">{{ $schema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="box-input-label">{{ __('Max Subscriptions') }}</label>
                                    <input type="number" min="1" class="form-control" name="limits[0][max_subscriptions]" value="1">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="site-btn-sm red-btn remove-schema-limit">{{ __('Remove') }}</button>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button" class="site-btn-sm primary-btn" id="add-schema-limit">{{ __('Add Plan Limit') }}</button>
                        <button type="submit" class="site-btn-sm grad-btn">{{ __('Save Limits') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="schema-limit-template">
        <div class="row align-items-end mb-3 schema-limit-row">
            <div class="col-md-6">
                <label class="box-input-label">{{ __('Plan') }}</label>
                <select data-name="schema_id" class="form-select">
                    <option value="">{{ __('Select Plan') }}</option>
                    @foreach($schemas as $schema)
                        <option value="{{ $schema->id }}">{{ $schema->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="box-input-label">{{ __('Max Subscriptions') }}</label>
                <input type="number" min="1" class="form-control" data-name="max_subscriptions" value="1">
            </div>
            <div class="col-md-2">
                <button type="button" class="site-btn-sm red-btn remove-schema-limit">{{ __('Remove') }}</button>
            </div>
        </div>
    </template>

    @push('script')
        <script>
            (function () {
                let rowIndex = {{ max(count($schemaLimits), 1) }};
                const container = document.getElementById('schema-limit-rows');
                const template = document.getElementById('schema-limit-template');

                document.getElementById('add-schema-limit')?.addEventListener('click', function () {
                    const clone = template.content.cloneNode(true);
                    clone.querySelector('[data-name="schema_id"]').setAttribute('name', `limits[${rowIndex}][schema_id]`);
                    clone.querySelector('[data-name="max_subscriptions"]').setAttribute('name', `limits[${rowIndex}][max_subscriptions]`);
                    rowIndex++;
                    container.appendChild(clone);
                });

                container?.addEventListener('click', function (event) {
                    if (event.target.classList.contains('remove-schema-limit')) {
                        const rows = container.querySelectorAll('.schema-limit-row');
                        if (rows.length > 1) {
                            event.target.closest('.schema-limit-row').remove();
                        }
                    }
                });
            })();
        </script>
    @endpush
@endcan

<div
    class="modal fade"
    id="editModal"
    tabindex="-1"
    aria-labelledby="editScheduleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content site-table-modal">
            <div class="modal-body popup-body">
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                <div class="popup-body-text">
                    <h3 class="title mb-4">{{ __('Edit Schedule') }}</h3>
                    <form action="" id="editForm" method="post">
                        @csrf
                        @method('PUT')
                        <div class="site-input-groups">
                            <label for="" class="box-input-label">{{ __('Schedule Name:') }}</label>
                            <input
                                type="text"
                                class="box-input mb-0"
                                required=""
                                name="name"
                                id="name"
                            />
                        </div>
                        <div class="site-input-groups">
                            <label for="" class="box-input-label">{{ __('Schedule Interval:') }}</label>
                            <div class="input-group joint-input">
                                <input type="text" class="form-control" name="time" id="time"/>
                                <select name="time_unit" class="form-select" id="time-unit">
                                    <option value="instantly">{{ __('Instantly') }}</option>
                                    <option value="seconds">{{ __('Seconds') }}</option>
                                    <option value="minutes">{{ __('Minutes') }}</option>
                                    <option value="hours">{{ __('Hours') }}</option>
                                    <option value="days">{{ __('Days') }}</option>
                                    <option value="months">{{ __('Months') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="action-btns">
                            <button type="submit" class="site-btn-sm primary-btn me-2">
                                <i icon-name="check"></i>
                                {{ __('Save Schedule') }}
                            </button>
                            <a
                                href="#"
                                class="site-btn-sm red-btn"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i icon-name="x"></i>
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- INPUT LIST:
    radio_{{ $namaKolom }}
    hvps_v_{{ $namaKolom }}
    hvps_i_{{ $namaKolom }}
    mag_i_{{ $namaKolom }} --}}
<div class="row">
    <label class="col-sm-2 col-form-label" for="input_HVPS_V_{{ $namaKolom }}">{{ $namaKolom }}</label>
    <div class="col-sm-2">
        {{--  --}}
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}1" value="1"> PASS
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <div class="form-check form-check-radio form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="radio_{{ $namaKolom }}"
                    id="input_{{ $namaKolom }}0" value="0"> FAIL
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        {{--  --}}
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="hvps_v_{{ $namaKolom }}"
                id="input_HVPS_V_{{ $namaKolom }}" placeholder="{{ __('HVPS_V') }}" value="" />
            <div class="input-group-append">
                <span class="input-group-text">V</span>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="hvps_i_{{ $namaKolom }}"
                id="input_HVPS_I{{ $namaKolom }}" placeholder="{{ __('HVPS_I') }}" value="" />
            <div class="input-group-append">
                <span class="input-group-text">A</span>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="input-group">
            <input class="form-control" input type="text" name="mag_i_{{ $namaKolom }}"
                id="input_Mag_I{{ $namaKolom }}" placeholder="{{ __('Mag_I') }}" value="" />
            <div class="input-group-append">
                <span class="input-group-text">mA</span>
            </div>
        </div>
    </div>

</div>

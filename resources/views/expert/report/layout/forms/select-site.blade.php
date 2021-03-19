<div class="row">
    <label class="col-sm-2 col-form-label" for="inputstation_id">station_id</label>
    <div class="col-sm-8">
        <div class='@error('site_id') label-floating has-danger @enderror'>
            @error('site_id')
                <label class="control-label force-has-danger">{{ $message }}</label>
                <span class="material-icons form-control-feedback">clear</span>
            @enderror
            <select name="site_id" wire:change="setRecommends"
                id="inputsite_id"
                wire:model="site_id" class="form-control">
                <option value="">-- choose station --</option>
                @foreach ($sites as $site)
                    <option value="{{ $site->site_id }}">
                        {{ $site->station_id }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <label class="col-sm-2 col-form-label" for="inputradar_name">radar_name</label>
    <div class="col-sm-8">
        <div class="form-group @error('radar_name') label-floating has-danger @enderror">
            @error('radar_name')
            <label class="control-label force-has-danger">{{ $message }}</label>
            <span class="material-icons form-control-feedback">clear</span>
            @enderror
            <input class="form-control " wire:model="radar" disabled
            type="text" name="radar_name" id="inputradar_name"
            />
        </div>
    </div>
</div>
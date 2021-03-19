@extends('layouts.app', ['activePage' => 'activity', 'titlePage' => __('Technisians Activity')])

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title mt-2" >Add New PM Schedule</h4>
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
              
              <form method="POST" action="/addPM" >
                @csrf
                <div class="form-group-site">
                  <input type="hidden" class="form-control" id="maintenance_type" name="maintenance_type" placeholder="Maintenance Type" value="pm">
                </div>

                <div class="form-group">
                  <label>Radar Name</label>
                  <select name="radar_name" id="radar_name" class="form-control ">
                    <option  selected disabled value="">--Choose Radar Name--</option>

                    @foreach ($sites as $sts)
                      <option value={{$sts->site_id}}>{{$sts->radar_name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group-site">   
                    <label for="inputSite">Station ID</label>
                    <input type="text" class="form-control" id="station_id" name="station_id" placeholder="Input Station ID" >
                </div>

                <div class="form-group-site">   
                    <label for="inputSite">Date Start</label>
                    <input type="date" class="form-control" id="report_date_start" name="report_date_start" placeholder="Input Date Start">
                </div>
                  
                <div class="form-group-site">
                    <label for="inputSite">Date End</label>
                    <input type="date" class="form-control" id="report_date_end" name="report_date_end" placeholder="Input Date End">
                </div>
                <br>
                <button type="submit" onclick="return confirm('Apakah yakin ingin menambahkan data?')" class="btn btn-primary">Tambah</button>
                <a href="/pm" class="btn btn-primary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Add Distributions')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <div class="row">
              <div class="col-md-6">
                <h4 class="card-title mt-2" >Penambahan Distribusi Ruangan</h4>
              </div>
              <div class="col-md-6">
               
              </div>
            </div>
          </div>
          <div class="card-body text-center">
            <div class="table-responsive">
          
                <form method="POST" action="add">
                  @csrf
                  <div class="form-group">
                    <label >Nama Teknisi</label>
                    <select name="" id="" class="form-control ">
                        <option value="">--Pilih Teknisi--</option>
                        
                        <option value="nama">Rezza</option>
                        
                        

                    </select>
    
                  </div>
                  <div class="form-group">
                  
                    <label>Site</label>
                    <select name="site_id" id="site_id" class="form-control ">
                      <option value="">--Pilih Site--</option>
                      
                      <option value="">Wamena</option>
                      
                      
                      </select>
              
                  </div>

                  <button type="submit" onclick="return confirm('Apakah yakin ingin menambahkan data?')" class="btn btn-primary">Tambah</button>
                  <a href="/distribution" class="btn btn-primary">Kembali</a>

            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
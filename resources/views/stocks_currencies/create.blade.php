@extends('layouts.app', ['activePage' => 'stock_currency', 'titlePage' => __('Input Stocks and their currencies')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Input Inventory with Exchange Rate</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
                <p class="mb-4 text-center h3">Harga Kurs Sekarang : <span class="text-primary text-center display-4">Rp {{ $rate_fix }}</span> ke USD</p>
                <form action="{{ url('stock_currency/') }}" method="POST">
                  @csrf
                    <div class="form-group my-4">
                      <label for="site_id">Pilih Site</label>
                      <select name="site_id" id="site_id" class="form-control">
                        <option value="">-- Pilih Site --</option>
                        @foreach ($sites as $st)
                          <option value="{{ $st->site_id }}">{{ $st->station_id }}</option>  
                        @endforeach
                      </select>
                      {{-- <input type="text" class="form-control" id="site_id" name="site_id"> --}}
                      <small class="form-text text-muted">Apabila site tidak ada, berarti tambah dahulu di fitur site</small>
                    </div>
                    <div class="form-group my-4">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang">
                      <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group my-4">
                      <label for="group">Group nya</label>
                      <select name="group" id="group" class="form-control">
                        <option value="">-- Pilih jenis barang --</option>
                        <option value="1">Transmitter</option>
                        <option value="2">Receiver</option>
                        <option value="3">Antenna</option>
                      </select>
                      {{-- <input type="text" class="form-control" id="group" name="group" placeholder="Jenis barang"> --}}
                    </div>
                    <div class="form-group my-4">
                      <label for="part_number">Part Number</label>
                      <input type="text" class="form-control" id="part_number" name="part_number" placeholder="Masukkan part number">
                    </div>
                    <div class="form-group my-4">
                      <label for="serial_number">Serial Number</label>
                      <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Masukkan part number">
                    </div>
                    <div class="form-group my-4">
                      <label for="tgl_masuk">Tanggal Masuk / Edit</label>
                      <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="Tanggal Input">
                    </div>
                    <div class="form-group my-4">
                      <label for="expired">Life expectancy</label>
                      <input type="date" class="form-control" id="expired" name="expired" placeholder="Expected lifetime">
                    </div>
                    <div class="form-group my-4">
                      <label for="kurs_beli">Kurs Beli</label>
                      <input type="text" class="form-control" id="kurs_beli" name="kurs_beli" placeholder="Kurs Beli">
                    </div>
                    <div class="form-group my-4">
                      <label for="jumlah_unit">Jumlah Unit</label>
                      <input type="text" class="form-control" id="jumlah_unit" name="jumlah_unit" placeholder="Mau masukin berapa">
                    </div>
                    <div class="form-group my-4">
                      <label for="status">Status</label>
                      <select name="status" id="status" class="form-control">
                        <option value="">-- is it obsolete or not? --</option>
                        <option value="0">Not Obsolete</option>
                        <option value="1">Obsolete</option>
                      </select>
                      {{-- <input type="text" class="form-control" id="status" name="status" placeholder="Status nya obsolete (1) atau ngga"> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url('stock_currency/') }}" class="btn btn-info ml-3 d-inline">Kembali</a>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
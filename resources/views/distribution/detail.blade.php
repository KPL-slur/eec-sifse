@extends('layouts.app', ['activePage' => 'distribution-management', 'titlePage' => __('Distribution Management')])

@section('content')
    
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Expert Distribution of {{$sites->radar_name}} </h4>
            </div>
            <div class="card-body">
              
              <div class="row">
                  <div class="col-12 text-left">
                    <a title="back" class="btn btn-sm btn-primary m-2" href="/distribution">
                      <i class="material-icons">arrow_back</i>
                      <div class="ripple-container"></div>
                    </a>
                  </div>
                  <div class="col-12 text-right">
                    <a rel="tooltip" title="Adding Distribution" href="/addDistribution/{{$sites->site_id}}" class="btn btn-sm btn-primary">
                      <i class="material-icons">
                        add
                      </i>Add Distribution
                    </a>
                  </div>
              </div>
              
              <div class="table-responsive mt-3">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama Teknisi</th>
                      <th scope="col">Expert Company</th>
                      <th scope="col">Station ID</th>
                      <th class="text-center">Update or Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($distributions as $dst)
                      <tr>
                        <td scope="row">{{$loop->iteration}}</td>
                        <td>{{$dst->name}}</td>
                        <td>{{$dst->expert_company}}</td>
                        <td>{{$dst->station_id}}</td>
                        <td class="td-actions text-center">
                              <a title="edit" class="btn btn-warning m-2" href="/editDistribution/{{$dst->dist_id}}">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                              
                              <form method="POST" action="/deleteDistribution/{{$dst->dist_id}}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger m-2" title="delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" >
                                  <i class="material-icons">delete</i>
                                  <div class="ripple-container"></div>
                                </button>
                              </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              @if (session('status1'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'success' ,'<?php echo session('status1') ?>');
                };
              </script>
              @elseif (session('status2'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'warning' ,'<?php echo session('status2') ?>');
                };
              </script>
              @elseif (session('status3'))
              <script>
                window.onload = () => {
                  showNotification('top', 'right', 'danger' ,'<?php echo session('status3') ?>');
                };
              </script>
              @endif
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
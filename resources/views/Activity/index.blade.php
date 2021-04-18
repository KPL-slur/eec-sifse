@extends('layouts.app', ['activePage' => 'activity', 'titlePage' => __('Experts Activity')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="sidebar-mini">PM</i>
                            </div>
                            <h3 class="card-title">Preventive Maintenance</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route("activity.index", ['maintenance_type' => 'pm']) }}">VIEW</a>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="sidebar-mini">CM</i>
                            </div>
                            <h3 class="card-title">Corrective Maintenance</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info" href="{{ route("activity.index", ['maintenance_type' => 'cm']) }}">VIEW</a>
                        </div>
                    </div>
                </div>
                {{--  --}}
            </div>
        </div>
    </div>
@endsection
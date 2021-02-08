@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])


{{-- IF entry_id not pm or cm will redirect to /tech --}}
@if ($_GET['entry_id'] == 'pm' or $_GET['entry_id'] == 'cm')

    @section('content')
        <div class="content">
            <div class="container-fluid">
                <h1>Create New {{ ($_GET['entry_id'] === "pm" ? "Preventive" : $_GET['entry_id'] === "cm") ? "Corective" : "" }} Maintenance Report</h1>
                <div class="row">
                    <div class="col-md-12">
                        {{-- List of Form Name Inputs:
                        maintenance_type
                        radar_name
                        station_id
                        report_date_start
                        report_date_end
                        expertise1
                        expertise2
                        expertise3
                        expertise4
                        expertise5
                        expertise6
                        expertise7
                        expertise8
                        expertise9
                        expertise10
                        expertise_company1
                        expertise_company2
                        expertise_company3
                        expertise_company4
                        expertise_company5
                        expertise_company6
                        expertise_company7
                        expertise_company8
                        expertise_company9
                        expertise_company10 --}}
                        <form method="post" action="/report" class="form-horizontal">
                            @csrf

                            {{-- HIDDEN --}}
                            <input type="hidden" name="maintenance_type" value="{{ $_GET['entry_id'] }}">
                            {{-- END OF HIDDEN --}}

                            {{-- SUMMARY --}}
                            <div class="card ">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                                </div>
                                {{-- DYNAMIC FIELDS --}}
                                <div class="card-body " id="dynamicField">
                                    @include('tech.forms.summaryForm', ['namaKolom'=>'radar_name', 'tipeForm'=>'text'])
                                    @include('tech.forms.summaryForm', ['namaKolom'=>'station_id', 'tipeForm'=>'text'])
                                    @include('tech.forms.summaryForm', ['namaKolom'=>'report_date_start',
                                    'tipeForm'=>'date'])
                                    @include('tech.forms.summaryForm', ['namaKolom'=>'report_date_end', 'tipeForm'=>'date'])

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="inputInternalExpertise">{{ __('Internal Expertise') }}</label>
                                        @for ($i = 1; $i <= 3; $i++)
                                            <div
                                                class="form-group col-md-3 @error('expertise1') label-floating has-danger @enderror">
                                                @error('expertise1')
                                                    <label class="control-label">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <select id="inputInternalExpertise{{ $i }}" class="form-control"
                                                    name="expertise{{ $i }}">
                                                    <option selected disabled>Choose...</option>
                                                    @foreach ($technisians as $tech)
                                                        <option value="{{ $tech->name }}"
                                                            {{ old("expertise$i") == $tech->name ? 'selected' : '' }}>
                                                            {{ $tech->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" value="Era Elektra Corpora Indonesia"
                                                    name="expertise_company{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>

                                    {{-- FIELDS THAT CAN BE ADDED BY USER USING JS BELOW --}}
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="inputExpertise">{{ __('External Expertise') }}</label>
                                        <div class="col-sm-4">
                                            <div
                                                class="form-group @error('expertise4') label-floating has-danger @enderror">
                                                @error('expertise4')
                                                    <label class="control-label">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <input class="form-control" input type="text" name="expertise4"
                                                    id="inputExpertise" placeholder="{{ __('Name') }}"
                                                    value="{{ old('expertise4') }}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div
                                                class="form-group @error('expertise4') label-floating has-danger @enderror">
                                                @error('expertise4')
                                                    <label class="control-label">{{ $message }}</label>
                                                    <span class="material-icons form-control-feedback">clear</span>
                                                @enderror
                                                <input class="form-control" input type="text" name="expertise_company4"
                                                    id="inputExpertiseCompany"
                                                    placeholder="{{ __('Expertise Company') }}"
                                                    value="{{ old('expertise_company4') }}" />
                                            </div>
                                        </div>
                                        <button type="button" id="add" class="btn btn-primary">ADD</button>
                                        <button type="button" id="remove" class="btn btn-danger">DELETE LAST</button>
                                    </div>
                                    {{--  --}}
                                </div>
                            </div>
                            {{-- END OF SUMMARY --}}

                            {{-- BUTTON GROUP --}}
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                                <button type="submit" class="btn btn-primary mx-5">SUBMIT</button>
                            </div>
                            {{-- END OF BUTTON GROUP --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@else
    <script>
        window.location = "/tech";

    </script>
@endif

<script>
    window.onload = function() {
        /*
         *   FUNGSI MENAMBAHKAN INPUT FIELD BARU
         *   
         *   old input belum dapat diberikan pada field yang ditambahkan menggunakan js
         */
        var $i = 4;
        $('#add').click(function() {
            if ($i < 10) {
                $i++;
                $('#dynamicField').append(
                    '<div class="row" id="dynamicField' + $i +
                    '"><label class="col-sm-2 col-form-label" for="inputExpertise' + $i +
                    '">Expertise ' + $i +
                    '</label><div class="col-sm-4"><div class="form-group"><input class="form-control" input type="text" name="expertise' +
                    $i + '" id="inputExpertise' + $i +
                    '" placeholder="{{ __('Expertise') }}" value="{{ old("expertise'+$i+'") }}"   /></div></div><div class="col-sm-3"><div class="form-group"><input class="form-control" input type="text" name="expertise_company' +
                    $i + '" id="inputExpertiseCompany' + $i +
                    '" placeholder="{{ __('Expertise Company') }}" value="{{ old("expertise_company'+$i+'") }}"   /></div></div></div>'
                );
            }
        });
        /*
         *   FUNGSI MENGAHPUS INPUT FIELD  YANG BARU DITAMBAHKAN
         */
        $('#remove').click(function() {
            if (!($i <= 1)) {
                $('#dynamicField' + $i + '').detach();
                $i--;
            }
        });

        /*
         *
         */
        if ($("#inputInternalExpertise2").val() === null) {
            $("#inputInternalExpertise2").prop("disabled", true);
        };
        if ($("#inputInternalExpertise3").val() === null) {
            $("#inputInternalExpertise3").prop("disabled", true);
        };
        $("#inputInternalExpertise1").on("change", function() {
            $("#inputInternalExpertise2").prop("disabled", false);
            $("#inputInternalExpertise2").on("change", function() {
                $("#inputInternalExpertise3").prop("disabled", false);
            });
        });
    };

</script>

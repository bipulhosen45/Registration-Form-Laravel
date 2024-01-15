@push('css')
<link rel="stylesheet" href="{{ asset('backend') }}/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
@endpush
@extends('admin.app')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{route('registration.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-circle-left"></i> Back to List</a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
      <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="card-title">User Edit Form</h2>
            </div>
            <div class="card-body">
                <form action="{{route('registration.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$data->email}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="{{$data->password}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confim Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                            value="{{$data->confirm_password}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="dateofbirth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" value="{{$data->dateofbirth}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="skill" class="form-label d-block">Skill</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill1"
                                    value="PHP" multiple selected>
                                <label class="form-check-label" for="skill1">PHP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill2"
                                    value="Laravel" multiple selected>
                                <label class="form-check-label" for="skill2">Laravel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill3"
                                    value="C#" multiple selected>
                                <label class="form-check-label" for="skill3">C#</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill4"
                                    value="PYTHON" multiple selected>
                                <label class="form-check-label" for="skill4">PYTHON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill5"
                                    value="JAVASCRIPT" multiple selected>
                                <label class="form-check-label" for="skill5">JAVASCRIPT</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skill" id="skill6"
                                    value="REACT" multiple selected>
                                <label class="form-check-label" for="skill6">REACT</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="division_id" class="form-label">Division Name</label>
                            <select name="division_id" class="form-control @error('division_id') is-invalid @enderror" id="division_id">
                                <option>Select Division</option>
                                @foreach ($divisions as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="district_id" class="form-label">District Name</label>
                            <select name="district_id" class="form-control @error('district_id') is-invalid @enderror" id="district_id" disabled>
                                <option>Select District</option>
                            </select>
                        </div>
                    </div>
                   
        
                    <div class="col-sm-12">
                        <div class="input-group mb-4">
                            <input type="file" class="form-control" id="image" name="image">
                            <label class="input-group-text" for="image">Upload</label>
                          </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="text-center ">
                    <input type="submit" class="btn btn-primary btn-lg" name="" id="submit" value="Submit">
                </div>
            </div>
        </form>
        </div>
      </div>

       
    </div>
@endsection

@push('js')
        <!-- page require js load here... -->
        <script src="{{ asset('backend') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script src="{{ asset('backend') }}/dropify/dist/js/dropify.min.js"></script>
        <script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>

        
    // dpopify & select 
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.select2').select2();
        });
    
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

<script>
    // get district
    const getDistricts = (division_id, selected = null) => {
        axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res => {
            let districts = res.data
            let element = $('#district_id')
         //    let thana_element = $('#thana_id').empty().append(`<option>Select Thana</option>`).attr('disabled', 'disabled')
            element.removeAttr('disabled')
            element.empty()
            element.append(`<option>Select District</option>`)
            districts.map((district, index) => {
                element.append(`<option value="${district.id}">${district.name}</option>`)
            })
 
        })
    }
 
 
    $('#division_id').on('change', function() {
        getDistricts($(this).val());
    })

 </script>
@endpush
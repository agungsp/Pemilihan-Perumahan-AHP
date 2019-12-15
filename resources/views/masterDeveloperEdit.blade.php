@extends('layout.template')
@section('css')
<link href="/sbAdmin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
@endsection
@section('title', 'Master Developer')
@section('icon-title-content')
<i class="fas fa-edit"></i>
@endsection
@section('title-content', 'Master Developer')
@section('content')
<!-- DataTables Example -->
<div class="row">
    <div class="col-5">
        <div class="card mb-3">
            <div class="card-header">
                <i class="far fa-edit"></i>
                Edit Master Developer
            </div>
            <div class="card-body">
                <form class="" action="/masterDeveloper/save" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <input type="hidden" name="IdDeveloper" value="{{$data->IdDeveloper}}">
                    <div class="form-group form-inline">
                        <label for="masterWilayah">Wilayah: </label>
                        <select name="masterWilayah" id="masterWilayah" class="form-control ml-2" required>
                            <option value="">.:: Pilih Wilayah ::.</option>
                            @foreach ($masterWilayah as $key => $value)
                            <option value="{{$value->IdWilayah}}">{{$value->NamaWilayah}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="KodeDeveloper" name="KodeDeveloper"
                                class="form-control KodeDeveloper" placeholder="Kode Developer" required="required"
                                autofocus="autofocus" value="{{$data->KodeDeveloper}}">
                            <label for="KodeDeveloper">Kode Developer</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="NamaDeveloper" name="NamaDeveloper"
                                class="form-control NamaDeveloper" placeholder="Nama Developer" required="required"
                                autofocus="autofocus" value="{{$data->NamaDeveloper}}">
                            <label for="NamaDeveloper">Nama Developer</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="Alamat" name="Alamat" class="form-control" placeholder="Alamat"
                                required="required" autofocus="autofocus" value="{{$data->Alamat}}">
                            <label for="Alamat">Alamat</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="NoTelp" name="NoTelp" class="form-control NoTelp"
                                placeholder="No. Telp" required="required" autofocus="autofocus"
                                value="{{$data->NoTelp}}">
                            <label for="NoTelp">No. Telp</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/masterDeveloper" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="submit" class="btn btn-warning">
                            <i class="far fa-edit"></i> Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="/sbAdmin/vendor/datatables/jquery.dataTables.js"></script>
<script src="/sbAdmin/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="/cleaveJS/cleave.min.js"></script>
<script src="/cleaveJS/addons/cleave-phone.id.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#masterWilayah').val("{{$data->IdWilayah}}");
    });

    $('#cancel').click(
        function () {
            $('#KodeDeveloper').val('');
            $('#NamaDeveloper').val('');
            $('#Alamat').val('');
            $('#NoTelp').val('');
        }
    );

    var cleaveKode = new Cleave('.KodeDeveloper', {
        blocks: [5],
        uppercase: true
    });

    var cleaveNoTelp = new Cleave('.NoTelp', {
        phone: true,
        phoneRegionCode: 'ID'
    });

</script>
@endsection

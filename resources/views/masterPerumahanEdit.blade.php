@extends('layout.template')
@section('title', 'Edit Master Perumahan')
@section('icon-title-content')
<i class="fas fa-edit"></i>
@endsection
@section('title-content', 'Edit Master Perumahan')
@section('content')
<div class="row">
    <div class="col-5">
        <div class="card mb-3">
            <div class="card-body">
                <form class="" action="/masterPerumahan/save" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <input type="hidden" name="IdPerumahan" value="{{$data->IdPerumahan}}">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="KodePerumahan" name="KodePerumahan" class="form-control KodePerumahan" placeholder="Kode Perumahan"
                                required="required" autofocus="autofocus" value="{{$data->KodePerumahan}}" readonly>
                            <label for="KodePerumahan">Kode Perumahan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="NamaPerumahan" name="NamaPerumahan" class="form-control NamaPerumahan" placeholder="Nama Perumahan"
                                required="required" autofocus="autofocus" value="{{$data->NamaPerumahan}}">
                            <label for="NamaPerumahan">Nama Perumahan</label>
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
                            <input type="text" id="NoTelp" name="NoTelp" class="form-control NoTelp" placeholder="No. Telp"
                                required="required" autofocus="autofocus" value="{{$data->NoTelp}}">
                            <label for="NoTelp">No. Telp</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/masterPerumahan" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="submit" class="btn btn-warning" id="addModalBtn">
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
    var cleaveNoTelp = new Cleave('.NoTelp', {
        phone: true,
        phoneRegionCode: 'ID'
    });
</script>
@endsection


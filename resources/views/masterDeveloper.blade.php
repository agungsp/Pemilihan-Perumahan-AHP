@extends('layout.template')
@section('css')
<link href="/sbAdmin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
@endsection
@section('title', 'Master Developer')
@section('icon-title-content')
<i class="fas fa-database"></i>
@endsection
@section('title-content', 'Master Developer')
@section('right-of-title-content')
<button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal" data-backdrop="static"
    data-keyboard="false">
    <i class="fas fa-plus"></i> Tambah
</button>
@endsection
@section('content')
<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Wilayah</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$value->NamaWilayah}}</td>
                        <td>{{$value->KodeDeveloper}}</td>
                        <td>{{$value->NamaDeveloper}}</td>
                        <td>{{$value->Alamat}}</td>
                        <td>{{$value->NoTelp}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/masterDeveloper/eid{{$value->IdDeveloper}}" class="btn btn-sm btn-warning text-dark"><i class="far fa-edit"></i> Ubah</a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" onclick="DoDeleteVarian({{$value->IdDeveloper}}, '{{$value->KodeDeveloper}}');" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('modal')
    {{-- Modal Add --}}
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Input Developer</h5>
                </div>
                <div class="modal-body" id="addModalBody">
                    <form class="" action="/masterDeveloper" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
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
                                <input type="text" id="KodeDeveloper" name="KodeDeveloper" class="form-control KodeDeveloper" placeholder="Kode Developer"
                                    required="required" autofocus="autofocus">
                                <label for="KodeDeveloper">Kode Developer</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="NamaDeveloper" name="NamaDeveloper" class="form-control NamaDeveloper" placeholder="Nama Developer"
                                    required="required" autofocus="autofocus">
                                <label for="NamaDeveloper">Nama Developer</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="Alamat" name="Alamat" class="form-control" placeholder="Alamat"
                                    required="required" autofocus="autofocus">
                                <label for="Alamat">Alamat</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="NoTelp" name="NoTelp" class="form-control NoTelp" placeholder="No. Telp"
                                    required="required" autofocus="autofocus">
                                <label for="NoTelp">No. Telp</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" id="cancel" type="button" data-dismiss="modal">Batal</button>
                            <button type="submit" name="submit" class="btn btn-primary" id="addModalBtn">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Hapus Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Yakin ingin menghapus?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="deleteModalBody"></div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-danger" id="deleteModalBtn" href="/masterVarian/did">
                            <i class="far fa-trash-alt"></i> Hapus
                        </a>
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
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

        function DoDeleteVarian(IdDeveloper, KodeDeveloper) {
            var delLink = document.getElementById("deleteModalBtn");
            document.getElementById("deleteModalBody").innerHTML = "Developer <strong>" + KodeDeveloper + "</strong> akan dihapus?";
            delLink.href = "/masterDeveloper/did"+IdDeveloper;
        }
    </script>
@endsection

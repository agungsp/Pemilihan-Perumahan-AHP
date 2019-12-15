{{-- {{dd($masterPerumahan)}} --}}
@extends('layout.template')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
<link href="/sbAdmin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="/viewerJS/viewer.min.css" rel="stylesheet">
@endsection
@section('title', 'Master Rumah')
@section('icon-title-content')
<i class="fas fa-database"></i>
@endsection
@section('title-content', 'Master Rumah')
@section('right-of-title-content')
<button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addModal" data-backdrop="static"
    data-keyboard="false">
    <i class="fas fa-plus"></i> Tambah
</button>
@endsection
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            {{ csrf_field() }}
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Perumahan</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Luas Tanah (m<sup>2</sup>)</th>
                        <th>Harga</th>
                        <th>Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$value->NamaPerumahan}}</td>
                        <td>{{$value->KodeRumah}}</td>
                        <td>{{$value->NamaRumah}}</td>
                        <td>{{number_format($value->Tipe)}}</td>
                        <td>{{number_format($value->LuasTanah)}}</td>
                        <td>{{number_format($value->Harga)}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-toggle="modal" data-target="#fasilitasModal" IdRumah="{{$value->IdRumah}}" class="btn btn-primary btn-sm dynamic"><i class="far fa-building"></i> Lihat</button>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/masterRumah/eid{{$value->IdRumah}}" class="btn btn-sm btn-warning text-dark"><i class="far fa-edit"></i> Ubah</a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" onclick="DoDeleteRumah({{$value->IdRumah}}, '{{$value->KodeRumah}}');" class="btn btn-sm btn-danger">
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
        <div class="modal-dialog" role="document" style="max-width:50rem">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Input Rumah</h5>
                </div>
                <div class="modal-body" id="addModalBody">
                    <form class="" id="addForm" action="/masterRumah" method="POST"  enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="masterPerumahan">Perumahan: </label>
                            <select name="masterPerumahan" id="masterPerumahan" onchange="setKodeRumah(this)" class="form-control ml-2" required>
                                <option value="">.:: Pilih Perumahan ::.</option>
                                @foreach ($masterPerumahan as $key => $value)
                                    <option value="{{$value->IdPerumahan}}-{{$value->KodePerumahan}}-{{$value->NomorRumah+1}}">{{$value->KodePerumahan}} - {{$value->NamaPerumahan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="KodeRumah" name="KodeRumah" class="form-control KodeRumah" placeholder="Kode Rumah"
                                    required="required" autofocus="autofocus" readonly>
                                <label for="KodeRumah">Kode Rumah</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="NamaRumah" name="NamaRumah" class="form-control NamaRumah" placeholder="Nama Rumah"
                                    required="required" autofocus="autofocus">
                                <label for="NamaRumah">Nama Rumah</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="Harga" name="Harga" class="form-control Harga" placeholder="Harga"
                                    required="required" autofocus="autofocus" >
                                <label for="Harga">Harga</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="Tipe" name="Tipe" class="form-control Tipe" placeholder="Tipe"
                                    required="required" autofocus="autofocus">
                                <label for="Tipe">Tipe</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="LuasTanah" name="LuasTanah" class="form-control LuasTanah" placeholder="Luas Tanah"
                                    required="required" autofocus="autofocus" >
                                <label for="LuasTanah">Luas Tanah (m<sup>2</sup>)</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="Akses" name="Akses" class="form-control Akses" placeholder="Akses tempat umum (Menit)"
                                    required="required" autofocus="autofocus">
                                <label for="Akses">Akses tempat umum (Menit)</label>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="Sertifikat">Sertifikat: </label>
                            <select name="Sertifikat" id="Sertifikat" class="form-control ml-2">
                                <option value="">.:: Pilih Sertifikat ::.</option>
                                <option value="SHM">SHM</option>
                                <option value="SHGB">SHGB</option>
                            </select>
                        </div>
                        <div class="form-group form-inline">
                            <label for="Fasilitas">Fasilitas: </label>
                            <select name="Fasilitas" id="Fasilitas" class="form-control ml-2">
                                <option value="">.:: Pilih Fasilitas ::.</option>
                                <option value="1">Keamanan, Tempat Ibadah</option>
                                <option value="2">Keamanan, Tempat Ibadah, Taman</option>
                                <option value="3">Keamanan, Tempat Ibadah, Taman, Market, Tempat Olahraga</option>
                            </select>
                        </div>


                        {{-- <h5 class="mt-3">Fasilitas</h5>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col">
                                    <label>
                                        <input type="checkbox" name="IsKeamanan" id="IsKeamanan">
                                        Keamanan
                                    </label>
                                </div>
                                <div class="form-group col">
                                    <label>
                                        <input type="checkbox" name="IsTempatIbadah" id="IsTempatIbadah">
                                        Tempat Ibadah
                                    </label>
                                </div>
                                <div class="form-group col">
                                    <label>
                                        <input type="checkbox" name="IsTaman" id="IsTaman">
                                        Taman
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>
                                        <input type="checkbox" name="IsMarket" id="IsMarket">
                                        Market
                                    </label>
                                </div>
                                <div class="form-group col">
                                    <label>
                                        <input type="checkbox" name="IsOlahraga" id="IsOlahraga">
                                        Tempat Olahraga
                                    </label>
                                </div>
                                <div class="form-group col">
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="form-label-group">
                                <textarea name="FasilitasLain" id="FasilitasLain" class="form-control" cols="30" rows="4" placeholder="Fasilitas Lain"></textarea>
                                <label for="FasilitasLain">Fasilitas Lain</label>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="Gambar">Gambar Rumah: </label>
                            <input type="file" name="GambarRumah" id="GambarRumah"
                                class="form-control ml-2" required>
                        </div>
                        <div class="form-group form-inline">
                            <label for="Gambar">Gambar Denah: </label>
                            <input type="file" name="GambarDenah" id="GambarDenah"
                                class="form-control ml-2" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" id="cancel" type="button" onclick="resetForm()" data-dismiss="modal">Batal</button>
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
                    <a class="btn btn-danger" id="deleteModalBtn" href="/masterRumah/did">
                        <i class="far fa-trash-alt"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- View Modal --}}
    <div class="modal fade" id="fasilitasModal" tabindex="-1" role="dialog" aria-labelledby="fasilitasModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-4" id="modal-content">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
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
    <script src="/viewerJS/viewer.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function setKodeRumah(combo) {
            if (combo.value != '') {
                var temp = combo.value.split('-');
                var id = temp[0];
                var kode = temp[1] + '-' + temp[2];
                var nomor = temp[3];
                var LenCode = 3;
                var kodeRumah = '';

                for (let i = 0; i < (LenCode - nomor.length); i++) {
                    kodeRumah = kodeRumah + '0';
                }
                kodeRumah = kode + '-' + kodeRumah + nomor;

                document.getElementById('KodeRumah').value = kodeRumah;
            } else {
                document.getElementById('KodeRumah').value = '';
            }
        }

        function resetForm() {
            document.getElementById('addForm').reset();
        }

        var cleaveHarga = new Cleave('.Harga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalScale: 2,
            numeralDecimalMark: '.'
        });

        var cleaveTipe = new Cleave('.Tipe', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalScale: 2,
            numeralDecimalMark: '.'
        });

        var cleaveLuasTanah = new Cleave('.LuasTanah', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalScale: 2,
            numeralDecimalMark: '.'
        });

        var cleaveAkses = new Cleave('.Akses', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalScale: 2,
            numeralDecimalMark: '.'
        });

        function DoDeleteRumah(IdRumah, KodeRumah) {
            var delLink = document.getElementById("deleteModalBtn");
            document.getElementById("deleteModalBody").innerHTML = "Rumah <strong>" + KodeRumah + "</strong> akan dihapus?";
            delLink.href = "/masterRumah/did"+IdRumah;
        }

        /*
         * Fungsi Untuk mengisi modal fasilitas
        */
        $(document).ready(function(){
            $('.dynamic').click(function(){
                var field = 'IdRumah';
                var value = $(this).attr("IdRumah");
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('C_MasterRumah.fetch') }}",
                    method:"POST",
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data:{field:field, value:value, _token:_token},
                    success: function(result) {
                        $('#modal-content').html(result);
                    }
                });
            });

            // $('#masterBarang').change(function(){
            //     $('#ukuran').val('');
            // });
        });
    </script>
@endsection

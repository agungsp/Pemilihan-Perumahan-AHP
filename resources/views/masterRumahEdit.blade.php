{{-- {{dd($masterPerumahan)}} --}}
@extends('layout.template')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Edit Master Rumah')
@section('icon-title-content')
<i class="fas fa-edit"></i>
@endsection
@section('title-content', 'Edit Master Rumah')
@section('content')
<div class="card mb-3" style="max-width:50rem">
    <div class="card-body">
        <form class="" id="addForm" action="/masterRumah/save" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="IdRumah" value="{{$data->IdRumah}}">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="KodeRumah" name="KodeRumah" class="form-control KodeRumah" placeholder="Kode Rumah"
                        required="required" autofocus="autofocus" readonly value="{{$data->KodeRumah}}">
                    <label for="KodeRumah">Kode Rumah</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="NamaRumah" name="NamaRumah" class="form-control NamaRumah" placeholder="Nama Rumah"
                        required="required" autofocus="autofocus" value="{{$data->NamaRumah}}">
                    <label for="NamaRumah">Nama Rumah</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="Harga" name="Harga" class="form-control Harga" placeholder="Harga"
                        required="required" autofocus="autofocus" value="{{$data->Harga}}">
                    <label for="Harga">Harga</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="Tipe" name="Tipe" class="form-control Tipe" placeholder="Tipe"
                        required="required" autofocus="autofocus" value="{{$data->Tipe}}">
                    <label for="Tipe">Tipe</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="LuasTanah" name="LuasTanah" class="form-control LuasTanah" placeholder="Luas Tanah"
                        required="required" autofocus="autofocus" value="{{$data->LuasTanah}}">
                    <label for="LuasTanah">Luas Tanah (m<sup>2</sup>)</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="Akses" name="Akses" class="form-control Akses" placeholder="Akses tempat umum (Menit)"
                        required="required" autofocus="autofocus" value="{{$data->Akses}}">
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
                            <input type="checkbox" name="IsKeamanan" id="IsKeamanan" {{$data->IsKeamanan==1?"checked":""}}>
                            Keamanan
                        </label>
                    </div>
                    <div class="form-group col">
                        <label>
                            <input type="checkbox" name="IsTempatIbadah" id="IsTempatIbadah" {{$data->IsTempatIbadah==1?"checked":""}}>
                            Tempat Ibadah
                        </label>
                    </div>
                    <div class="form-group col">
                        <label>
                            <input type="checkbox" name="IsTaman" id="IsTaman" {{$data->IsTaman==1?"checked":""}}>
                            Taman
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label>
                            <input type="checkbox" name="IsMarket" id="IsMarket" {{$data->IsMarket==1?"checked":""}}>
                            Market
                        </label>
                    </div>
                    <div class="form-group col">
                        <label>
                            <input type="checkbox" name="IsOlahraga" id="IsOlahraga" {{$data->IsOlahraga==1?"checked":""}}>
                            Tempat Olahraga
                        </label>
                    </div>
                    <div class="form-group col">
                    </div>
                </div>
            </div> --}}
            <div class="form-group">
                <div class="form-label-group">
                    <textarea name="FasilitasLain" id="FasilitasLain" class="form-control" cols="30" rows="4" placeholder="Fasilitas Lain">{{$data->FasilitasLain}}</textarea>
                    <label for="FasilitasLain">Fasilitas Lain</label>
                </div>
            </div>
            <div class="form-group form-inline">
                <label for="Gambar">Gambar Rumah: </label>
                <input type="file" name="GambarRumah" id="GambarRumah"
                    class="form-control ml-2">
            </div>
            <div class="form-group form-inline">
                <label for="Gambar">Gambar Denah: </label>
                <input type="file" name="GambarDenah" id="GambarDenah"
                    class="form-control ml-2">
            </div>
            <div class="modal-footer">
                <a href="/masterRumah" class="btn btn-secondary">Batal</a>
                <button type="submit" name="submit" class="btn btn-warning" id="addModalBtn">
                    <i class="far fa-edit"></i> Edit
                </button>
            </div>
        </form>
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

            var sertifikat = "{{$data->Sertifikat}}";
            $('#Sertifikat').val(sertifikat);

            var fasilitas = "{{$fasilitas}}";
            $('#Fasilitas').val(fasilitas);
        });

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
    </script>
@endsection

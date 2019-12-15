@extends('layout.template')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Home')
@section('title-content', 'Home')
@section('css')
    <style>
        li.media:hover{
            background-color: #e3e3e3;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <ul class="list-unstyled">
        {{ csrf_field() }}
        @foreach ($masterRumah as $key => $value)
        <li data-toggle="modal" data-target="#fasilitasModal" IdRumah="{{$value->IdRumah}}" class="media mb-4 dynamic">
            <img src="{{$value->GambarRumahTumb}}" class="mr-3" alt="{{$value->KodeRumah}}">
            <div class="media-body">
                <h5 class="mt-0 mb-1">{{$value->KodeRumah}} - {{$value->NamaRumah}}</h5>
                Kode: {{$value->KodeRumah}} | Nama: {{$value->NamaRumah}} | Tipe: {{$value->Tipe}} | Sertifikat: {{$value->Sertifikat}} |
            </div>
        </li>
        <hr>
        @endforeach
    </ul>
@endsection
@section('modal')
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
    <script>
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

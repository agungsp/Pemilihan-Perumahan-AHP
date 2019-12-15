@extends('layout.template')
@section('title', 'Penilaian Kriteria')
@section('title-content', 'Penilaian Kriteria')
@section('content')
    <form action="/penilaianKriteria" method="POST">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Kriteria</th>
                                <th class="text-center">Nilai Perbandingan</th>
                                <th class="text-center">Nama Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($data); $i++)
                                @for ($j = 0; $j < count($data); $j++)
                                    @if ($i < $j)
                                        <tr>
                                            <td>{{$data[$i]->KodeKriteria}} - {{$data[$i]->NamaKriteria}}</td>
                                            <td>
                                                <select class="form-control" name="{{$data[$i]->IdKriteria}}_{{$data[$j]->IdKriteria}}">
                                                    @if (Session::has('login_state'))
                                                        @if (Session::has('admin_request') && (count(Session::get('admin_request')) > 0))
                                                        <option value="1" {{[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 1 ? "selected" : "" }}>1. Sama penting dengan</option>
                                                        <option value="2" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 2 ? "selected" : "" }}>2. Mendekati sedikit lebih penting dari</option>
                                                        <option value="3" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 3 ? "selected" : "" }}>3. Sedikit lebih penting dari</option>
                                                        <option value="4" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 4 ? "selected" : "" }}>4. Mendekati lebih penting dari</option>
                                                        <option value="5" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 5 ? "selected" : "" }}>5. Lebih penting dari</option>
                                                        <option value="6" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 6 ? "selected" : "" }}>6. Mendekati sangat penting dari</option>
                                                        <option value="7" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 7 ? "selected" : "" }}>7. Sangat penting dari</option>
                                                        <option value="8" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 8 ? "selected" : "" }}>8. Mendekati mutlak dari</option>
                                                        <option value="9" {{Session::get('admin_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 9 ? "selected" : "" }}>9. Mutlak sangat penting dari</option>
                                                        @else
                                                        <option value="1">1. Sama penting dengan</option>
                                                        <option value="2">2. Mendekati sedikit lebih penting dari</option>
                                                        <option value="3">3. Sedikit lebih penting dari</option>
                                                        <option value="4">4. Mendekati lebih penting dari</option>
                                                        <option value="5">5. Lebih penting dari</option>
                                                        <option value="6">6. Mendekati sangat penting dari</option>
                                                        <option value="7">7. Sangat penting dari</option>
                                                        <option value="8">8. Mendekati mutlak dari</option>
                                                        <option value="9">9. Mutlak sangat penting dari</option>
                                                        @endif
                                                    @else
                                                        @if (Session::has('user_request'))
                                                        <option value="1" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 1 ? "selected" : "" }}>1. Sama penting dengan</option>
                                                        <option value="2" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 2 ? "selected" : "" }}>2. Mendekati sedikit lebih penting dari</option>
                                                        <option value="3" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 3 ? "selected" : "" }}>3. Sedikit lebih penting dari</option>
                                                        <option value="4" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 4 ? "selected" : "" }}>4. Mendekati lebih penting dari</option>
                                                        <option value="5" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 5 ? "selected" : "" }}>5. Lebih penting dari</option>
                                                        <option value="6" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 6 ? "selected" : "" }}>6. Mendekati sangat penting dari</option>
                                                        <option value="7" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 7 ? "selected" : "" }}>7. Sangat penting dari</option>
                                                        <option value="8" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 8 ? "selected" : "" }}>8. Mendekati mutlak dari</option>
                                                        <option value="9" {{Session::get('user_request')[$data[$i]->IdKriteria.'_'.$data[$j]->IdKriteria] == 9 ? "selected" : "" }}>9. Mutlak sangat penting dari</option>
                                                        @else
                                                        <option value="1">1. Sama penting dengan</option>
                                                        <option value="2">2. Mendekati sedikit lebih penting dari</option>
                                                        <option value="3">3. Sedikit lebih penting dari</option>
                                                        <option value="4">4. Mendekati lebih penting dari</option>
                                                        <option value="5">5. Lebih penting dari</option>
                                                        <option value="6">6. Mendekati sangat penting dari</option>
                                                        <option value="7">7. Sangat penting dari</option>
                                                        <option value="8">8. Mendekati mutlak dari</option>
                                                        <option value="9">9. Mutlak sangat penting dari</option>
                                                        @endif
                                                    @endif
                                                </select>
                                            </td>
                                            <td>{{$data[$j]->KodeKriteria}} - {{$data[$j]->NamaKriteria}}</td>
                                        </tr>
                                    @endif
                                @endfor
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="form-group float-right">
                    <input type="reset" class="btn btn-secondary" value="Reset">
                    <button type="submit" class="btn btn-primary" name="submit">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

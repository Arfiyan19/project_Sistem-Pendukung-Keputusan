@extends('layouts.stisla.index', ['title' => 'Halaman Data Alternatif', 'page_heading' => 'Perhitungan'])

@section('content')
<div class="card">
    <div class="row">
        <div class="col-lg-12">
            <!-- <button type="button" class="btn btn-primary float-right mt-3 mx-3" data-toggle="modal" data-target="#alternatif_create_modal">
                <i class="fas fa-fw fa-plus"></i>
                Tambah Data Perhitungan
            </button> -->
        </div>
    </div>
    <H4 style="text-align: center; padding-top: 20px;">Matrik Ternormalisasi</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">GO</th>
                            <th scope="col">PE</th>
                            <th scope="col">IPK</th>
                            <th scope="col">AD</th>
                            <th scope="col">AM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // dd($detail_alternatif->alternatif)
                        use Illuminate\Support\Facades\DB;
                        ?>
                        @foreach($alternatif as $row)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $row->nama }}</td>
                            <?php
                            $detail_alternatif = db::table('detail_alts')
                                ->where('alternatif_id', $row->id)
                                ->get();
                            foreach ($detail_alternatif as $row2) {

                                echo "<td>" . $row2->nilai . "</td>";
                            }
                            ?>
                        </tr>
                        @endforeach
                        <tr>
                            <th scope="row">Jumlah</th>
                            <td></td>
                            <!-- arrayJumlahKriteria -->
                            @foreach($arrayJumlahKriteria as $row)
                            <td>{{ number_format($row, 2) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <H4 style="text-align: center; padding-top: 20px;">Normalisasi Matriks Keputusan</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable">

                    <thead>
                        <tr>
                            <th scope="col">GO</th>
                            <th scope="col">PE</th>
                            <th scope="col">IPK</th>
                            <th scope="col">AD</th>
                            <th scope="col">AM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        ?>
                        @foreach($hasil as $row)
                        <!-- td  -->
                        <tr>
                            @foreach($row as $row2)
                            <td>{{ number_format($row2, 2) }}</td>
                            <!-- //no++  -->
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>





    </div>


    <H4 style="text-align: center; padding-top: 20px;">Matriks Keputusan Normalisasi Terbobot</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable">

                    <thead>
                        <tr>
                            <!-- Nama Alternatif  -->
                            <th scope="col">NAMA</th>
                            <th scope="col">GO</th>
                            <th scope="col">PE</th>
                            <th scope="col">IPK</th>
                            <th scope="col">AD</th>
                            <th scope="col">AM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($alternatif as $key => $value) {
                            $alternatifNama[$key] = $value->nama;
                        }
                        foreach ($kriteria as $key => $value) {
                            $kriteriaCode[$key] = $value->code;
                        }
                        // dd($alternatifNama);
                        ?>
                        @foreach($hasilBobot as $row)
                        <!-- td  -->
                        <tr>
                            @foreach($row as $row2)
                            <!-- <td>{{ number_format($row2, 2) }}</td> -->
                            <!-- if baris ke [0][0] dan baris ke [1][0] maka hasilnya negatif -->
                            @if($loop->iteration == 1 && $loop->parent->iteration == 1)
                            <!-- alternatifNama -->
                            <td>{{ $alternatifNama[$loop->index] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 2)
                            <td>{{ $alternatifNama[$loop->index+1] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 3)
                            <td>{{ $alternatifNama[$loop->index+2] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 4)
                            <td>{{ $alternatifNama[$loop->index+3] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 5)
                            <td>{{ $alternatifNama[$loop->index+4] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @endif
                            <!-- foreach baris ke 0 kolom ke 1 -->
                            @if($loop->iteration == 2 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>

                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif

                            @if($loop->iteration == 3 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif
                            <!-- kolom ke 4 -->
                            @if($loop->iteration == 4 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif
                            <!-- kolom ke 5 -->
                            @if($loop->iteration == 5 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>





    </div>


    <H4 style="text-align: center; padding-top: 20px;">SOLUSI IDEAL POSISTIF DAN SOLUSI IDEAL NEGATIF</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable">

                    <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">S+</th>
                            <th scope="col">S-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kriteria as $key => $value) {
                            $kriteriaCode[$key] = $value->name;
                        }
                        echo "<tr>";
                        foreach ($kriteriaCode as $key => $value) {
                            echo "<td>" . $value . "</td>";
                            // baris pertama negatif dan baris kedua positif 
                            if ($key == 0) {
                                echo "<td>" . '-' . number_format($solusiIdealPositif[0], 2) . "</td>";
                                echo "<td>" . '-' . number_format($solusiIdealNegatif[0], 2) . "</td>";
                            } else {
                                echo "<td>" . number_format($solusiIdealPositif[$key], 2) . "</td>";
                                echo "<td>" . number_format($solusiIdealNegatif[$key], 2) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tr>";
                        ?>

                    </tbody>
                </table>
            </div>
        </div>





    </div>


    <H4 style="text-align: center; padding-top: 20px;">JARAK ALTERNATIF DENGAN SOLUSI IDEAL POSITIF DAN NEGATIF</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable" align="center">
                        <!-- //SEBELUMNYA  -->
                    <!-- <thead style="text-align: center;" <tr>
                        <th scope="col">D+</th>
                        <th scope="col">D-</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <?php
                        foreach ($kriteria as $key => $value) {
                            $kriteriaCode[$key] = $value->code;
                        }
                        // dd($kriteriaCode);
                        echo "<tr>";
                        foreach ($kriteriaCode as $key => $value) {
                            echo "<td>" . number_format($totalIdealPositif[$key], 2) . "</td>";
                            echo "<td>" . number_format($totalIdealNegatif[$key], 2) . "</td>";
                            // ranking 
                            $ranking[$key] = $totalIdealNegatif[$key] / ($totalIdealNegatif[$key] + $totalIdealPositif[$key]);
                            // echo "<td>" . number_format($ranking[$key], 2) . "</td>";


                            echo "</tr>";
                        }
                        echo "</tr>";
                        ?>
                    </tbody> -->
<!-- //PEMBARUAN  -->


                    <thead>
                        <tr>
                            <!-- Nama Alternatif  -->
                            <th scope="col">NAMA</th>
                            <th scope="col">GO</th>
                            <th scope="col">PE</th>
                            <th scope="col">IPK</th>
                            <th scope="col">AD</th>
                            <th scope="col">AM</th>
                            <th scope="col">D +</th>
                            <th scope="col">D -</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($alternatif as $key => $value) {
                            $alternatifNama[$key] = $value->nama;
                        }
                        foreach ($kriteria as $key => $value) {
                            $kriteriaCode[$key] = $value->code;
                        }
                        // dd($kriteriaCode);
                        ?>
                        @foreach($hasilBobot as $row)
                        <!-- td  -->
                        <tr>
                            @foreach($row as $row2)
                            <!-- <td>{{ number_format($row2, 2) }}</td> -->
                            <!-- if baris ke [0][0] dan baris ke [1][0] maka hasilnya negatif -->
                            @if($loop->iteration == 1 && $loop->parent->iteration == 1)
                            <!-- alternatifNama -->
                            <td>{{ $alternatifNama[$loop->index] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 2)
                            <td>{{ $alternatifNama[$loop->index+1] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 3)
                            <td>{{ $alternatifNama[$loop->index+2] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 4)
                            <td>{{ $alternatifNama[$loop->index+3] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 1 && $loop->parent->iteration == 5)
                            <td>{{ $alternatifNama[$loop->index+4] }}</td>
                            <td> - {{ number_format($row2, 2) }}</td>

                            @endif
                            <!-- foreach baris ke 0 kolom ke 1 -->
                            @if($loop->iteration == 2 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>

                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 2 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif

                            @if($loop->iteration == 3 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 3 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif
                            <!-- kolom ke 4 -->
                            @if($loop->iteration == 4 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            @elseif($loop->iteration == 4 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            @endif
                            <!-- kolom ke 5 -->
                            @if($loop->iteration == 5 && $loop->parent->iteration == 1)
                            <td> {{ number_format($row2, 2) }}</td>
                            <td>{{ number_format($totalIdealPositif[0], 2) }}</td>
                            <td>{{ number_format($totalIdealNegatif[0], 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 2)
                            <td> {{ number_format($row2, 2) }}</td>
                            <td>{{ number_format($totalIdealPositif[1], 2) }}</td>
                            <td>{{ number_format($totalIdealNegatif[1], 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 3)
                            <td> {{ number_format($row2, 2) }}</td>
                            <td>{{ number_format($totalIdealPositif[2], 2) }}</td>
                            <td>{{ number_format($totalIdealNegatif[2], 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 4)
                            <td> {{ number_format($row2, 2) }}</td>
                            <td>{{ number_format($totalIdealPositif[3], 2) }}</td>
                            <td>{{ number_format($totalIdealNegatif[3], 2) }}</td>
                            @elseif($loop->iteration == 5 && $loop->parent->iteration == 5)
                            <td> {{ number_format($row2, 2) }}</td>
                            <td>{{ number_format($totalIdealPositif[4], 2) }}</td>
                            <td>{{ number_format($totalIdealNegatif[4], 2) }}</td>
                            @endif



                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>





    </div>

    <H4 style="text-align: center; padding-top: 20px;">CLOSENESS COEFFICIENT</H4>
    <div class="row px-3 py-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="datatable" align="center">

                    <thead style="text-align: center;" <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">V</th>
                        <!-- //ranking  -->
                        <th scope="col">Ranking</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <?php
                        $no = 1;
                        //    gabung
                        $gabung = array_combine($nama, $ranking);
                        arsort($gabung);
                        foreach ($gabung as $key => $value) {
                            echo "<tr>";
                            echo "<td>" . $key . "</td>";
                            echo "<td>" . number_format($value, 2) . "</td>";
                            echo "<td>" . $no++ . "</td>";
                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>





    </div>


</div>
@endsection

@push('modal')
@include('perhitungan.modal.create')
@include('perhitungan.modal.show')
@include('perhitungan.modal.edit')
@endpush

@push('js')
@include('perhitungan._script')
@endpush
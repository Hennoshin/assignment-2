<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sallary</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<body>
    <div class="container" id="print-pdf">
        {{-- <h2 class="pb-2 border-bottom">Columns with icons</h2> --}}
        <img src="{{ asset('images/header.png') }}" alt="image" width="100%">
        <div class="row g-4 py-5 row-cols-12 row-cols-lg-12">
            <h1 class="mb-5 mt-2">SLIP GAJI</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-4">Nama</div>
                        <div class="col-1">:</div>
                        <div class="col-7">{{ auth()->user()->employee->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">No. Telepon</div>
                        <div class="col-1">:</div>
                        <div class="col-7">{{ auth()->user()->employee->phone }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">Unit Kerja</div>
                        <div class="col-1">:</div>
                        <div class="col-7">{{ auth()->user()->employee->unitKerja->title }}</div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="row">
                        <div class="col-4">Tanggal</div>
                        <div class="col-1">:</div>
                        <div class="col-7">{{ date('d M Y', strtotime($row->bulan))}}</div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 25px;">
                <table class="table">
                    <thead>
                        <tr style="background-color: #28a8e1; color: white;">
                            <th scope="col">No.</th>
                            <th scope="col">Uraian</th>
                            <th scope="col">Jumlah</th>
                            <th class="text-center" scope="col" style="width: 20%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Gaji Pokok</td>
                            <td class="text-end">{{ number_format($row->gaji_pokok) }}</td>
                            <td rowspan="6" class="text-center" style="padding-top: 5%">{{ $row->description }}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Uang Lembur</td>
                            <td class="text-end">{{number_format($row->lembur)}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Uang Makan</td>
                            <td class="text-end">{{ number_format($row->uang_makan) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Tunjangan</td>
                            <td class="text-end">{{ number_format($row->tunjangan) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Cicilan Hutang Karyawan</td>
                            <td class="text-end">{{ number_format($row->hutang) }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Lain-lain</td>
                            <td class="text-end">{{ number_format($row->uang_beras) }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-center">Total</th>
                            <th colspan="2" class="text-end" style="background-color: #28a8e1; color: white;">{{ number_format($row->total_income)}}</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-6" style="margin-top: 50px;">
                    <p>
                        <h5>Jazaakallahu Khairan</h5>
                    </p>
                    <p>
                        <i>Satu-satu cara untuk melakukan pekerjaan hebat yaitu dengan mencintai apa yang sedang kamu lakukan.</i>
                    </p>
                    <p style="font-size: 10px; margin-top: 80px;">www.minhajus-sunnah.id <br>{{ date('Y-m-d H:i:s').' - '.$row->uuid }}</p>
                </div>
                <div class="col-3 text-center" style="margin-top: 50px;">
                    <p>
                        Hormat Kami
                    </p>
                    <p style="margin-top: 100px;">
                        <h6>Human Resource Development</h6>
                    </p>
                </div>
                <div class="col-3 text-center" style="margin-top: 50px;">
                    <p>
                        Mengetahui
                    </p>
                    <p style="margin-top: 100px;">
                        <h6>Bendahara</h6>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var element = document.getElementById('print-pdf');
    var opt = {
    margin:       0.2,
    filename:     'gaji-{{auth()->user()->employee->name.'-'.$row->bulan}}.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 1 },
    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    
    // New Promise-based usage:
    html2pdf().set(opt).from(element).save();
    
    // Old monolithic-style usage:
    html2pdf(element, opt);

    // window.close();
</script>
</html>

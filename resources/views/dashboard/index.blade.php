<head>
    <!-- CSS DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .card-produk {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            margin-bottom: 40px;
        }

        .card-produk-info {
            width: 200px;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
        }
    </style>
</head>
@include('dash.header')
@include('dash.sidebar')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                            <!-- Row : Informasi Singkat Tentang Penjualan Produk Terbanyak -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-produk">
                                        @foreach($combineData as $produk => $count)
                                        <div class="card-produk-info">
                                            <p class="statistics-title">{{ $produk }}</p>
                                            <h3 class="rate-percentage"> {{ $count }}</h3>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- //Row : Informasi Singkat Tentang Penjualan Produk Terbanyak -->

                            <!-- Row : Data yang sudah di olah -->
                            <div class="row">
                                <div class="col-lg-12 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div class="d-sm-flex justify-content-start align-items-center">
                                                        <div>
                                                            <h1 class="card-title">Leaderboard All Produk</h1>
                                                        </div>
                                                    </div>
                                                    <table id="table-dataJadi" class="display wrap table-sm"
                                                        style="width:100%">
                                                        <thead>
                                                            <tr style="font-size: 90%;">
                                                                <th>#</th>
                                                                <th>Nama</th>
                                                                <th>No Telp</th>
                                                                <th>Quantity</th>
                                                                <th>Total Pembelian</th>
                                                                <th>Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($leaderboard as $data)
                                                            <tr style="font-size: 90%;">
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data['nama'] }}</td>
                                                                <td>{{ $data['no_telp'] }}</td>
                                                                <td>{{ $data['jumlah_quantity'] }}</td>
                                                                <td>
                                                                    Rp {{
                                                                    number_format($data['total_pembelian'],0,',','.')
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        @foreach($data['pembelian'] as $purchase)
                                                                        <li>{{ $purchase['produk'] }} ({{
                                                                            $purchase['quantity'] }}) - Rp {{
                                                                            number_format($purchase['total'],0,',','.')
                                                                            }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Etawalin</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardEtawalin as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_quantity'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Zymuno</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardZymuno as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Generos</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardGeneros as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Freshmag</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardFreshmag as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Bio Insuleaf</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardBio as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Gizidat</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardGizidat as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Nutriflakes</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardNutriflakes as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Etawaku Platinum</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardEtawaku as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Fresh Vision</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardFreshvision as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Leaderbaord Weight Herba</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama</th>
                                                            <th>No Telp</th>
                                                            <th>Quantity</th>
                                                            <th>Total Pembelian</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($leaderboardWeightherba as $index => $data)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $data['nama'] }}</td>
                                                            <td>{{ $data['no_telp'] }}</td>
                                                            <td>{{ $data['jumlah_transaksi'] }}</td>
                                                            <td>
                                                                Rp {{ number_format($data['total_pembelian'],0,',','.')
                                                                }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dash.footer')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        new DataTable('#table-dataJadi', {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
        });
    </script>

    <script type="text/javascript">
        $(function() {
          $(document).on('click', '.deleteButton', function(e) {
              e.preventDefault();
              var formAction = $(this).closest('form').attr('action');
              Swal.fire({
                  title: "Yakin Untuk  Menghapus Semua?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#1F3BB3",
                  cancelButtonColor: "#F95F53",
                  confirmButtonText: "Iya, Hapuss!!"
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Di sini Anda bisa melakukan ajax request untuk menghapus data atau submit form secara langsung.
                      // Misalnya:
                      // $.ajax({
                      //     type: "DELETE",
                      //     url: formAction,
                      //     success: function(data) {
                      //         Swal.fire("Deleted!", "Your file has been deleted.", "success");
                      //     },
                      //     error: function(data) {
                      //         Swal.fire("Error!", "An error occurred while deleting the file.", "error");
                      //     }
                      // });
  
                      // Atau, jika Anda ingin langsung submit form:
                      $(this).closest('form').submit();
                  }
              });
          });
      });
    </script>

    @if ($message = Session::get('success'))
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
          }
      });
      Toast.fire({
          icon: "success",
          title: "{{$message}}"
          });
    </script>
    @endif
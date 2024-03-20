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
          <!-- <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div>
                </div> -->
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

              <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <div>
                  <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#formUpload"><i class="fa-solid fa-file-import fa-xs"
                      style="margin-right: 8px;"></i>Import Data</button>
                </div>
                <div>
                  <form action="{{ route('delete_all') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-lg text-white mb-0 me-0 deleteButton" type="submit"><i
                        class="fa-solid fa-trash-can"></i> Hapus Semua</button>
                  </form>
                </div>
              </div>
              <br>

              <!-- MODAL UPLOAD FILE EXCEL -->
              <div class="modal fade" id="formUpload" tabindex="-1" aria-labelledby="formUploadLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Form Upload Data Excel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('store_file') }}" method="post" enctype="multipart/form-data"
                        class="form-sample">
                        @csrf
                        <div class="form-group">
                          <label for="upload-file" style="font-size: 16px;">Upload File :</label>
                          <input type="file" class="form-control" name="file" id="upload-file">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark btn-lg text-white"
                        data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-lg text-white">Upload</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- BATAS MODAL UPLOAD FILE EXCEL -->

              <!-- Row : Data Mentah-->
              <div class="row">
                <div class="col-lg-12 d-flex flex-column">
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-start align-items-center">
                            <div>
                              <h1 class="card-title">Data Mentah</h1>
                              <p class="card-subtitle">Berikut adalah kumpulan data penjualan produk yang belum diolah
                              </p>
                            </div>
                          </div>
                          <table id="table-dataMentah" class="display wrap table-sm" style="width:100%">
                            <thead>
                              <tr style="font-size: 90%;">
                                <th>#</th>
                                <th>user id</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Produk</th>
                                <th>No Telp</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                              $no = 1;
                              @endphp
                              @foreach($data as $d)
                              <tr style="font-size: 90%;">
                                <td>{{ $no++ }}</td>
                                <td>{{ $d->user_id }}</td>
                                <td>{{ $d->tanggal }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>{{ $d->produk }}</td>
                                <td>{{ $d->no_telp }}</td>
                                <td>{{ $d->quantity }}</td>
                                <td>Rp.{{ number_format($d['harga'],0,',','.') }}</td>
                                <td>Rp.{{ number_format($d['total'],0,',','.') }}</td>
                                <td>
                                  <a href="#" class="btn btn-success btn-lg p-2 text-white"><i
                                      class="fa-solid fa-magnifying-glass-arrow-right"></i></a>
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
              <!-- //Row : Data Mentah -->

              {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <div>
                  <!-- <button class="btn b9tn-dark btn-lg text-white mb-0 me-0" type="button">Export Data</button> -->
                  <a href="{{ route('store_export') }}" class="btn btn-dark btn-lg text-white mb-0 me-0"><i
                      class="fa-solid fa-file-export fa-flip-horizontal" style="margin-right: 8px;"></i>Export excel</a>
                </div>
                <div>
                  <button class="btn btn-success btn-lg text-white mb-0 me-0" type="button" data-bs-toggle="modal"
                    data-bs-target="#formSettingsMinPembelian"><i class="fa-solid fa-gear"
                      style="margin-right: 8px;"></i>Min Pembelian</button>
                </div>
                <div>
                  <a href="{{ route('index') }}" class="btn btn-warning btn-lg text-white"><i
                      class="fa-solid fa-arrows-rotate" style="margin-right: 8px;"></i>Refresh</a>
                  <!-- <button class="btn btn-warning btn-lg text-white mb-0 me-0" type="button"><a href="{{ route('index') }}">Refresh</a></button> -->

                </div>
              </div>

              <!-- Modal Settings Minimal Pembelian -->
              <div class="modal fade" id="formSettingsMinPembelian" tabindex="-1" aria-labelledby="formUploadLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Settings Minimal Pembelian</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('store_min') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                          <label for="" class="col-form-label">Input Nominal:</label>
                          <div class="input-group mb-3 col-6">
                            <span class="input-group-text">Rp.</span>
                            <input type="text" name="nominal" class="form-control" placeholder="Ex:1000000">
                            @if($errors->has('nominal'))
                            <div class="text-danger col-6">
                              {{ $errors->first('nominal')}}
                            </div>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark btn-lg text-white"
                        data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-lg text-white">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Batas Settings  Minimal  Pembelian --> --}}

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
    new DataTable('#table-dataMentah', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
            });

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
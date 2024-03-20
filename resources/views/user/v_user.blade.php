<head>
    <!-- CSS DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
      .card-produk{
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        margin-bottom: 40px;
      }
      .card-produk-info{
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
                    
                  <!-- Pesan  kesalan  dari  form  + user  -->
                    @if($errors->any())
                        <div class="row-sm-12">
                            <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                    @endif

                     <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                      <div>
                          <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button" data-bs-toggle="modal" data-bs-target="#formTambahUser"><i class="fa-solid fa-plus fa-xs" style="margin-right: 8px;"></i>User Baru</button>
                      </div>
                     </div>
                     <br>
          
                     <!-- Modal Tambah  User Baru -->
                    <div class="modal fade" id="formTambahUser" tabindex="-1" aria-labelledby="#formTambahUserLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Tambah User Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="{{route('listUser.storeUser') }}" method="post" class="form-sample"> 
                            @csrf
                            <div class="form-group">
                                <label for="username" style="font-size: 16px;">Username<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username" placeholder="Input Username">
                                </div>
                                <div class="form-group">
                                    <label for="role" style="font-size: 16px;">Role<span style="color: red;">*</span></label>
                                    <select name="role" id="role" class="form-select">
                                        <option value="">--Pilih Role--</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email" style="font-size: 16px;">Email<span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Input Email Anda">
                                </div>
                                <div class="form-group">
                                    <label for="password" style="font-size: 16px;">Password<span style="color: red;">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Input Password Anda">
                                </div>
                                <div class="form-group">
                                    <label for="conf-password" style="font-size: 16px;">Confirm Password<span style="color: red;">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="conf-password" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-dark btn-lg text-white" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-lg text-white">Simpan</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
                      <!-- //Batas Modal Tambah  User Baru -->
                    
                    <!-- Row : Data Mentah-->
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-start align-items-center">
                                  <div>
                                    <h1 class="card-title">Data User</h1>
                                    <p class="card-subtitle">Berikut adalah kumpulan data User dan Admin</p>
                                  </div>
                                </div>
                                  <table id="table-dataMentah" class="display wrap table-sm" style="width:100%">
                                    <thead>
                                      <tr style="font-size: 90%;">
                                        <th>#</th>
                                        <th>username</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $no =1;
                                    @endphp
                                    @foreach($data as $d)
                                      <tr style="font-size: 90%;">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $d->username  }}</td>
                                        <td>{{ $d->role  }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->created_at}}</td>
                                        <td>{{ $d->updated_at}}</td>
                                        <td>
                                          <a href="#" class="btn btn-success btn-lg text-white p-2"><i class="fa-solid fa-edit"></i></a>
                                          <a href="#" class="btn btn-danger btn-lg  text-white p-2"><i class="fa-solid fa-trash"></i></a>
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
                    </div><br><br>
                    <!-- //Row : Data Mentah -->

        
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
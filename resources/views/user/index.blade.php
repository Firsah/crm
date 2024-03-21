@include('dash.header')
@include('dash.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List User</h4>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Profil
                                        </th>
                                        <th>
                                            First name
                                        </th>
                                        <th>
                                            Posisi
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('assets/images/user.png') }}" alt="image" />
                                        </td>
                                        <td>
                                            Herman Beck
                                        </td>
                                        <td>
                                            Advertiser
                                        </td>
                                        <td>
                                            akjsdkj@gmoy.cpom
                                        </td>
                                        <td>
                                            <a href="{{ route('profil') }}" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                            <a href="{{ route('profil') }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            <a href="{{ route('edit') }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dash.footer')
</div>
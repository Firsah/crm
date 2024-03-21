@include('dash.header')
@include('dash.sidebar')
<style>
    .profile-picture {
        width: 150px;
        /* Sesuaikan ukuran yang diinginkan */
        height: 150px;
        /* Sesuaikan ukuran yang diinginkan */
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-header text-center">

                            <h4 class="card-title text-center mt-4">My Profile</h4>
                            <div class="profile-img">
                                <img src="{{ asset('assets/images/user.png') }}" alt="Profile Picture" class="rounded-circle profile-picture">
                            </div>
                            <br>
                            <h4 class="card-title">John Doe</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nama</h4>
                        <p class="card-description">
                            John Doe
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <p class="fw-bold">Posisi</p>
                                    <p>
                                        Advertiser
                                    </p>
                                    <p>
                                        Digitalk Insight
                                    </p>
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address class="text-primary">
                                    <p class="fw-bold">
                                        E-mail
                                    </p>
                                    <p class="mb-2">
                                        johndoe@examplemeail.com
                                    </p>
                                    <p class="fw-bold">
                                        Nomor HP
                                    </p>
                                    <p>
                                        087367389
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Lead</h4>
                        <p class="card-description">
                            Use class <code>.lead</code>
                        </p>
                        <p class="lead">
                            Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dash.footer')
</div>
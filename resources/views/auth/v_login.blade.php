
@include('dash.header')

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../assets/images/logo.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="fw-light">Sign in to continue.</h6>
              <form action="{{ route('auth.storeLogin') }}" method="post" class="pt-3">
                <div class="form-group" >
                  <input type="text" class="form-control form-control" id="exampleInputEmail1"
                    placeholder="Input Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control" id="exampleInputPassword1"
                    placeholder="Input Password">
                </div>
                <div class="my-2 d-flex justify-content-end align-items-center">
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary text-bold" href="{{ route('admin.index') }}">Sign In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


@include('dash.footer')
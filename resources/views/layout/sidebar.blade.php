<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        @php
        $setting = \App\Models\Setting::first();
    @endphp
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <p>            {{ optional($setting)->nama_sekolah }} </p>
         <img src="{{ asset('storage/back/logo/'. optional($setting)->logo) }}" alt="logo" width="50px" class="rounded-circle">
        </a>
      </div>

      <ul class="navbar-nav flex-fill w-100 mb-2">

        <li class="nav-item dropdown">
          <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
            <i class="fe fe-users fe-16"></i>
            <span class="ml-3 item-text">Users</span><span class="sr-only">(current)</span>
          </a>
          <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
            @if (auth()->user()->level != 'user')
            <li class="nav-item active">

              <a class="nav-link pl-3" href="{{ route('user.petugas') }}"><span class="ml-1 item-text">Users</span></a>
            </li>
            @endif
            {{-- <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('user.siswa') }}"><span class="ml-1 item-text">Data siswa</span></a>
            </li> --}}
            @if (auth()->user()->level != 'user')
            <li class="nav-item">
              <a class="nav-link pl-3" href="{{ route('kelas.index') }}"><span class="ml-1 item-text">Kelas</span></a>
            </li>

            @endif
          </ul>

          @if (auth()->user()->level != 'user')
          <li class="nav-item">
            <a href="{{route('pembayaran.index')}}" class=" nav-link">
              <i class="fe fe-dolars fe-16"></i>
              <span class="ml-3 item-text">Metode Pembayaran</span><span class="sr-only"></span>
            </a>
            </li>
            @endif
          @if (auth()->user()->level != 'user')
          <li class="nav-item">
            <a href="{{route('spp.index')}}" class=" nav-link">
              <i class="fe fe-dolars fe-16"></i>
              <span class="ml-3 item-text">Harga Spp</span><span class="sr-only"></span>
            </a>
            </li>

            <li class="nav-item">
              <a href="{{route('bayar.spp')}}" class=" nav-link">
                <i class="fe fe-dolars fe-16"></i>
                <span class="ml-3 item-text">Bayar Spp</span><span class="sr-only"></span>
              </a>
              </li>
              @endif
              @if (auth()->user()->level == 'user')
              <li class="nav-item">
                <a href="{{route('history.spp')}}" class=" nav-link">
                  <i class="fe fe-dolars fe-16"></i>
                  <span class="ml-3 item-text">history bayar spp</span><span class="sr-only"></span>
                </a>
                </li>

              @endif
              @if (auth()->user()->level !== 'user')
              <li class="nav-item">
                <a href="{{route('ajaran.index')}}" class=" nav-link">
                  <i class="fe fe-dolars fe-16"></i>
                  <span class="ml-3 item-text">Ajaran</span><span class="sr-only"></span>
                </a>
                </li>

              <li class="nav-item">
                <a href="{{route('setting.index')}}" class=" nav-link">
                  <i class="fe fe-dolars fe-16"></i>
                  <span class="ml-3 item-text">Setting</span><span class="sr-only"></span>
                </a>
                </li>
                @endif
        </li>

      </ul>



    </nav>
  </aside>

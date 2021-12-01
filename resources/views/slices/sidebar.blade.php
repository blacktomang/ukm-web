 @php
 $paths = Request::path();
 @endphp
 <div class="main-sidebar">
   <aside id="sidebar-wrapper">
     <div class="sidebar-brand">
       <a href="/dashboard">UKM Tombolo</a>
     </div>
     <div class="sidebar-brand sidebar-brand-sm">
       <a href="index.html">UT</a>
     </div>
     <ul class="sidebar-menu">
       @hasrole('seller')
       <li class=" @if($paths=='dashboard'||$paths=='admin') active @endif"><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
       @endhasrole
       @hasrole('admin')
       <li class=" @if($paths=='dashboard'||$paths=='admin') active @endif"><a class="nav-link" href="/admin"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
       <li class="@if($paths=='admin/banners') active @endif"><a class="nav-link" href="/admin/banners"><i class="fas fa-images"></i><span>Web Banner</span></a></li>
       <li class=" @if($paths=='admin/initiators') active @endif"><a class="nav-link" href="/admin/initiators"><i class="fas fa-fire-alt"></i><span>Penggagas Ukm</span></a></li>
       <li class=" @if($paths=='admin/users') active @endif"><a class="nav-link" href="/admin/users"><i class="fas fa-users"></i><span>Users</span></a></li>
       <li class=" @if($paths=='admin/stores') active @endif"><a class="nav-link" href="/admin/stores"><i class="fas fa-store"></i><span>Ukm</span></a></li>
       <li class="@if($paths=='admin/products') active @endif"><a class="nav-link" href="/admin/products"><i class="fas fa-list-alt"></i><span>Produk</span></a></li>
       <li class="@if($paths=='admin/grafik') active @endif"><a class="nav-link" href="{{route('grafik.ukm')}}"><i class="fas fa-chart-bar"></i><span>Grafik</span></a></li>
       @endhasrole
       @hasrole('seller')
       <li class="@if($paths=='stores') active @endif"><a class="nav-link" href="/stores"><i class="fas fa-store"></i> <span>Profil UKM</span></a></li>
       <li class="@if($paths=='product') active @endif"><a class="nav-link" href="/product"><i class="fas fa-list-alt"></i><span>Produk</span></a></li>
       {{-- <li><a class="nav-link" href="/memo"><i class="fas fa-comments"></i> <span>Memo</span></a></li> --}}
       @endhasrole
       {{-- <li class="menu-header">Pengaturan</li>
      <li><a class="nav-link" href="/type"><i class="fas fa-folder"></i> <span>Tipe Surat</span></a></li>
      <li><a class="nav-link" href="/laporan"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li> --}}
     </ul>

     <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
       @hasrole('admin')
       <a href="#" onclick="resetData()" class="btn btn-danger btn-lg btn-block btn-icon-split">
         <i class="fas fa-rocket"></i> Reset Data
       </a>
       @endhasrole
       @hasrole('seller')
       <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
         <i class="fas fa-rocket"></i> DEV
       </a>
       @endhasrole
     </div>
   </aside>
 </div>
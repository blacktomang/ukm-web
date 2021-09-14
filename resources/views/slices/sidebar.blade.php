 @php
 $paths = Request::path();
 @endphp
 <div class="main-sidebar">
   <aside id="sidebar-wrapper">
     <div class="sidebar-brand">
       <a href="/dashboard">UKM Bontolo</a>

     </div>
     <div class="sidebar-brand sidebar-brand-sm">
       <a href="index.html">UB</a>
     </div>
     <ul class="sidebar-menu">
       <li class=" @if($paths=='dashboard'||$paths=='admin') active @endif"><a class="nav-link" href="/admi"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
       <li class=" @if($paths=='penggagas') active @endif"><a class="nav-link" href="/admin/initiators"><i
            class="fas fa-fire"></i> <span>Penggagas Ukm</span></a></li>
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
       <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
         <i class="fas fa-rocket"></i> DEV
       </a>
     </div>
   </aside>
 </div>
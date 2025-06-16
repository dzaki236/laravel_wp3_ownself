<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item"> <a
                        class="sidebar-link waves-effect waves-dark sidebar-link {{ $page == 'dashboard' ? 'active' : '' }}"
                        href="{{ route('backend.dashboard.index') }}" aria-expanded="false"><i
                            class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span></a></li>
                @if (auth()->user()->role == 'super_admin')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="charts.html" aria-expanded="false"><i class="mdi mdi-account"></i><span
                                class="hide-menu">User</span></a></li>
                @endif
                @if (in_array(auth()->user()->role, ['super_admin', 'admin']))
                    <li class="sidebar-item"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link {{ $page == 'customer' ? 'active' : '' }}"
                            href="{{ route('backend.customer.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-box"></i><span class="hide-menu">Customer</span></a></li>
                    <li class="sidebar-item {{ in_array($page, ['kategori', 'produk']) ? 'selected' : '' }}"> <a
                            class="sidebar-link has-arrow waves-effect waves-dark {{ in_array($page, ['kategori', 'produk']) ? 'active' : '' }}"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                                class="hide-menu">Data Produk </span></a>
                        <ul aria-expanded="false"
                            class="collapse first-level {{ in_array($page, ['kategori', 'produk']) ? 'in' : '' }}">
                            <li class="sidebar-item {{ $page == 'kategori' ? 'active' : '' }}"><a
                                    href="{{ route('backend.kategori.index') }}" class="sidebar-link"><i
                                        class="mdi mdi-chevron-right"></i><span class="hide-menu"> Kategori
                                    </span></a></li>
                            <li class="sidebar-item {{ $page == 'produk' ? 'active' : '' }}"><a
                                    href="{{ route('backend.produk.index') }}" class="sidebar-link"><i
                                        class="mdi mdi-chevron-right"></i><span class="hide-menu">
                                        Produk
                                    </span></a></li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->role == 'super_admin')
                    <li class="sidebar-item {{ $page == 'laporan' ? 'selected' : '' }}"> <a
                            class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><i class="mdi mdi-chart-gantt"></i><span class="hide-menu">Laporan
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item {{ $page == 'laporan_transaksi' ? 'active' : '' }}"><a
                                    href="{{ route('backend.report.transaksi') }}" class="sidebar-link"><i
                                        class="mdi mdi-chevron-right"></i><span class="hide-menu">
                                        Transaksi
                                    </span></a></li>
                            <li class="sidebar-item {{ $page == 'laporan_produk' ? 'active' : '' }}"><a
                                    href="{{ route('backend.report.produk') }}" class="sidebar-link"><i
                                        class="mdi mdi-chevron-right"></i><span class="hide-menu">
                                        Produk
                                    </span></a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

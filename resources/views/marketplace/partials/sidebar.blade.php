<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
            @if(GlobalHelper::session()=='admin')
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('transactions')}} " href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([0,1])}}</span>
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('complaint')}}" href="/complaint">
                        <i class="far fa-fw fa-file "></i>
                        <p>Complaint</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('mutation')}}" href="/mutation">
                        <i class="far fa-fw fa-file "></i>
                        <p>Mutasi Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('redeem')}}" href="/redeem">
                        <i class="far fa-fw fa-file "></i>
                        <p>Pencairan Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('data-products')}} " href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-header ">MAIN DATA</li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('produsen')}}" href="/produsen">
                        <i class="fas fa-file "></i>
                        <p>Produsen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('products-types')}} " href="/products-types">
                        <i class="fas fa-file "></i>
                        <p>Product Types</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('products-category')}}" href="/products-category">
                        <i class="fas fa-file "></i>
                        <p>Product Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('payments')}}" href="/payments">
                        <i class="fas fa-file "></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li class="nav-header ">
                    DATA MASTER
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('roles')}}" href="/roles">
                        <i class="fas fa-file "></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('users')}} " href="/users">
                        <i class="fas fa-file "></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-header ">
                    KONFIGURASI
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('sliders')}}" href="/sliders">
                        <i class="far fa-fw fa-circle text-red"></i>
                        <p>Sliders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('banners')}}" href="/banners">
                        <i class="far fa-fw fa-circle text-green"></i>
                        <p>Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('menus')}}" href="/menus">
                        <i class="far fa-fw fa-circle text-blue"></i>
                        <p>Menus</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('configurations')}}" href="/configurations">
                        <i class="far fa-fw fa-circle text-yellow"></i>
                        <p>Configurations</p>
                    </a>
                </li>
            @endif

            @if(GlobalHelper::session()=='produsen')
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('transactions')}}" href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([1])}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('complaint')}}" href="/complaint">
                        <i class="fas fa-file "></i>
                        <p>Complaint</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('mutation')}}" href="/mutation">
                        <i class="far fa-fw fa-file "></i>
                        <p>Mutasi Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('redeem')}}" href="/redeem">
                        <i class="far fa-fw fa-file "></i>
                        <p>Pencairan Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('data-products')}}" href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-header ">MAIN DATA</li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('products-types')}}" href="/products-types">
                        <i class="fas fa-file "></i>
                        <p>Product Types</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('products-category')}}" href="/products-category">
                        <i class="fas fa-file "></i>
                        <p>Product Category</p>
                    </a>
                </li>
            @endif

            @if(GlobalHelper::session()=='seller')
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('transactions')}}" href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([1])}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('mutation')}}" href="/mutation">
                        <i class="far fa-fw fa-file "></i>
                        <p>Mutasi Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('redeem')}}" href="/redeem">
                        <i class="far fa-fw fa-file "></i>
                        <p>Pencairan Saldo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{GlobalHelper::activeMenu('data-products')}} " href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{GlobalHelper::activeMenu('complaint')}}" href="/complaint">
                        <i class="far fa-fw fa-file "></i>
                        <p>Complaint</p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
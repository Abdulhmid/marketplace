<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
            @if(GlobalHelper::session()=='admin')
                <li class="nav-item">
                    <a class="nav-link  " href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([0,1])}}</span>
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-header ">MAIN DATA</li>
                <li class="nav-item">
                    <a class="nav-link  " href="/produsen">
                        <i class="fas fa-address-book "></i>
                        <p>Produsen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/products-types">
                        <i class="fas fa-bookmark "></i>
                        <p>Product Types</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/products-category">
                        <i class="fas fa-bookmark "></i>
                        <p>Product Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/payments">
                        <i class="fas fa-credit-card "></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li class="nav-header ">
                    DATA MASTER
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/roles">
                        <i class="fas fa-users "></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/users">
                        <i class="fas fa-user "></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-header ">
                    KONFIGURASI
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/sliders">
                        <i class="far fa-fw fa-circle text-red"></i>
                        <p>Sliders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/banners">
                        <i class="far fa-fw fa-circle text-green"></i>
                        <p>Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/menus">
                        <i class="far fa-fw fa-circle text-blue"></i>
                        <p>Menus</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/configurations">
                        <i class="far fa-fw fa-circle text-yellow"></i>
                        <p>Configurations</p>
                    </a>
                </li>
            @endif

            @if(GlobalHelper::session()=='produsen')
                <li class="nav-item">
                    <a class="nav-link  " href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([1])}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-header ">MAIN DATA</li>
                <li class="nav-item">
                    <a class="nav-link  " href="/produsen">
                        <i class="fas fa-address-book "></i>
                        <p>Produsen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/products-types">
                        <i class="fas fa-bookmark "></i>
                        <p>Product Types</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="/products-category">
                        <i class="fas fa-bookmark "></i>
                        <p>Product Category</p>
                    </a>
                </li>
            @endif

            @if(GlobalHelper::session()=='seller')
                <li class="nav-item">
                    <a class="nav-link  " href="/transactions">
                        <i class="far fa-fw fa-file "></i>
                        <p>Transaction
                            <span class="badge badge-success right">{{GlobalHelper::transactionCount([1])}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="/data-products">
                        <i class="far fa-fw fa-file "></i>
                        <p>Product</p>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
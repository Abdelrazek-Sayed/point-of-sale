<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
        <img src="{{asset('dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{__('site.dashboard')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>

            <div class="text-center d-flex">
                <span class="text-blue">{{ auth()->user()->first_name .' '. auth()->user()->last_name  }}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        @lang('site.dashboard')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if(auth()->user()->hasPermission('users_read'))
                        <li class="nav-item">
                            <a href="{{route('dashboard.users.index')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('site.users')}}</p>
                            </a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="" class="nav-link disabled">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('site.users')}}</p>
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->hasPermission('categories_read'))
                        <li class="nav-item">
                            <a href="{{route('dashboard.categories.index')}}" class="nav-link active">
                                <i class="far fa-bookmark"></i>
                                <p>{{__('site.categories')}}</p>
                            </a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="" class="nav-link disabled">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('site.categories')}}</p>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasPermission('products_read'))
                        <li class="nav-item">
                            <a href="{{route('dashboard.products.index')}}" class="nav-link active">
                                <i class="far fa-product-hunt"></i>
                                <p>{{__('site.products')}}</p>
                            </a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="" class="nav-link disabled">
                                <i class="far fa-product-hunt nav-icon"></i>
                                <p>{{__('site.products')}}</p>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->hasPermission('clients_read'))
                        <li class="nav-item">
                            <a href="{{route('dashboard.clients.index')}}" class="nav-link active">
                                <i class="far fa-user-alt-slash"></i>
                                <p>{{__('site.clients')}}</p>
                            </a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a href="" class="nav-link active">
                                <i class="far fa-user-alt-slash"></i>
                                <p>{{__('site.clients')}}</p>
                            </a>
                        </li>

                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link bg-fuchsia" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
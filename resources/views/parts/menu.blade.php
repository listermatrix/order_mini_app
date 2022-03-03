@php($route = \Illuminate\Support\Facades\Route::currentRouteName())
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand text-center" href="">
{{--                <img src="{{asset("img/new.png")}}" class="navbar-brand-img" width="%" height="70%">--}}
               SIMBA APP
            </a>
            <div class="ml-auto">
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ preg_match('/dashboard/', $route)    ? 'active' : '' }}" href="{{route('dashboard.index')}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>

                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{route('dashboard.index')}}" class="nav-link {{ preg_match('/marketing.tags.index/', $route) ? 'text-orange' : '' }}">Dashboard</a>
                            </li>
                        </ul>

                    </li>


                        <li class="nav-item">
                            <a class="nav-link {{ preg_match('/_tran/', $route) ? 'active' : '' }}" href="#navbar-applicant" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-applicant">
                                <i class="fa fa-money-bill text-default"></i>
                                <span class="nav-link-text">Transfer</span>
                            </a>
                            <div class="collapse {{ preg_match('/trans/', $route) ? 'show' : '' }}" id="navbar-applicant">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="{{route('trans.account.index')}}" class="nav-link {{ preg_match('/trans.account.index/', $route) ? 'text-success' : '' }}"> <i class="fas fa-money-check"></i> Accounts</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('transactions.index')}}" class="nav-link {{ preg_match('/transactions.index/', $route) ? 'text-success' : '' }}"> <i class="fab fa-bitcoin"></i> All Transactions</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('trans.exchange.index')}}" class="nav-link {{ preg_match('/exchange.index/', $route) ? 'text-success' : '' }}"> <i class="fas fa-exchange-alt"></i> Exchange Rates </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('trans.currency.index')}}" class="nav-link {{ preg_match('/currency.index/', $route) ? 'text-success' : '' }}"> <i class="fas fa-coins"></i> Currency </a>
                                    </li>

                                </ul>
                            </div>
                        </li>




                </ul>
            </div>
        </div>
    </div>
</nav>

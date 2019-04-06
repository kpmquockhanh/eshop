<div class="sidebar" data-color="brown" data-active-color="danger">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->avatar
                ?'/images/avatars/'.\Illuminate\Support\Facades\Auth::guard('admin')->user()->avatar
                :asset('backend/img/logo-small.png')}}">
            </div>
        </a>
        <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
            Admin Area
            <!-- <div class="logo-image-big">
              <img src="../assets/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->avatar
                ?'/images/avatars/'.\Illuminate\Support\Facades\Auth::guard('admin')->user()->avatar
                :asset('backend/img/faces/ayo-ogunseinde-2.jpg')}}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                  <strong>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name_type}}</strong>
                {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
                <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<span class="sidebar-mini-icon">MP</span>--}}
                                {{--<span class="sidebar-normal">My Profile</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<span class="sidebar-mini-icon">EP</span>--}}
                                {{--<span class="sidebar-normal">Edit Profile</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li>
                            <a href="{{route('admin.salers.edit', \Illuminate\Support\Facades\Auth::guard('admin')->id())}}">
                                <span class="sidebar-mini-icon">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.logout')}}">
                                <span class="sidebar-mini-icon">L</span>
                                <span class="sidebar-normal">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ request()->segment(2) == null ? 'active':'' }}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Tổng quan</p>
                </a>
            </li>
            <li class="{{ request()->segment(2) == 'flowers' ? 'active':'' }}">
                <a data-toggle="collapse" href="#flower">
                    <i class="nc-icon nc-diamond"></i>
                    <p>
                        Sản phẩm
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ request()->segment(2) == 'flowers' ? 'show':'' }}" id="flower">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.products.list')}}">
                                <span class="sidebar-mini-icon">H</span>
                                <span class="sidebar-normal"> Danh sách sản phẩm </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.categories.list')}}">
                                <span class="sidebar-mini-icon">T</span>
                                <span class="sidebar-normal"> Thể loại </span>
                            </a>
                        </li>
                        @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->isOperator())
                            <li>
                                <a href="{{route('admin.products.images')}}">
                                    <span class="sidebar-mini-icon">I</span>
                                    <span class="sidebar-normal"> Ảnh đã upload </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.crawler.index')}}">
                                    <span class="sidebar-mini-icon">C</span>
                                    <span class="sidebar-normal">Crawler </span>
                                </a>
                            </li>
                        @endif

                        {{--<li>--}}
                            {{--<a href="">--}}
                                {{--<span class="sidebar-mini-icon">X</span>--}}
                                {{--<span class="sidebar-normal"> Danh sách hoa đã xóa </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </li>
            <li class="{{ request()->segment(2) == 'categories' ? 'active':'' }}">
                <a data-toggle="collapse" href="#categories">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p>
                        Thể loại
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ request()->segment(2) == 'categories' ? 'show':'' }}" id="categories">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.categories.list')}}">
                                <span class="sidebar-mini-icon">T</span>
                                <span class="sidebar-normal"> Danh sách thể loại </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->isOperator())
                <li class="{{ request()->segment(2) == 'salers' || request()->segment(2) == 'users' ? 'active':'' }}">
                    <a data-toggle="collapse" href="#account">
                        <i class="nc-icon nc-shop"></i>
                        <p>
                            Tài khoản
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ request()->segment(2) == 'salers' || request()->segment(2) == 'users' ?'show':'' }}" id="account">
                        <ul class="nav">
                            <li>
                                <a href="{{route('admin.salers.list')}}">
                                    <span class="sidebar-mini-icon">T</span>
                                    <span class="sidebar-normal"> Danh sách tài khoản saler </span>

                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.users.list')}}">
                                    <span class="sidebar-mini-icon">T</span>
                                    <span class="sidebar-normal"> Danh sách tài khoản user </span>

                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class="{{ request()->segment(2) == 'orders' ? 'active':'' }}">
                <a data-toggle="collapse" href="#bill">
                    <i class="nc-icon nc-paper"></i>
                    <p>
                        Hóa đơn
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ request()->segment(2) == 'orders'? 'show':'' }}" id="bill">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.orders.list')}}">
                                <span class="sidebar-mini-icon">H</span>
                                <span class="sidebar-normal"> Danh sách hóa đơn </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        @if (\Illuminate\Support\Facades\Auth::guard('admin')->user()->isOperator())
                <li class="{{ request()->segment(2) == 'payments' ? 'active':'' }}">
                    <a data-toggle="collapse" href="#payment">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>
                            Thanh toán
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ request()->segment(2) == 'payments'? 'show':'' }}" id="payment">
                        <ul class="nav">
                            <li>
                                <a href="{{route('admin.payments.list')}}">
                                    <span class="sidebar-mini-icon">T</span>
                                    <span class="sidebar-normal"> Danh sách thanh toán</span>

                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="{{ request()->segment(2) == 'shippers' ? 'active':'' }}">
                    <a data-toggle="collapse" href="#delivery">
                        <i class="nc-icon nc-delivery-fast"></i>
                        <p>
                            Vận chuyển
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ request()->segment(2) == 'shippers'? 'show':'' }}" id="delivery">
                        <ul class="nav">
                            <li>
                                <a href="{{route('admin.shippers.list')}}">
                                    <span class="sidebar-mini-icon">V</span>
                                    <span class="sidebar-normal"> Danh sách vận chuyển </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            <li>
                <a href="https://demos.creative-tim.com/paper-dashboard-2-pro/examples/charts.html">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Demo</p>
                </a>
            </li>
        </ul>
    </div>
</div>

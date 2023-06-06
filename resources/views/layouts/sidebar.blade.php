 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="{{asset('/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     <span class="brand-text font-weight-light">Mr.Dung</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img style="    height: 40px;
    width: 2.4rem;" src="{{asset('dist/img/admin.jpg')}}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block" style="    color: azure;
    font-family: inherit;
    font-weight: 800;
    margin-top: 5px;">{{ Auth::user()->name }}</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <div class="form-inline">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" style="color:black;background: cornsilk; border:1px solid aquamarine;" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
           <a href="{{url('home')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/dashboard.png')}}" alt="">
             <p>
               Dashboard
               <span class="right badge badge-danger">(0)</span>
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="#" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/pro.png')}}" alt="">
             <p>
               Sản Phẩm
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('products.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách sản phẩm</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{route('products.add')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm sản phẩm</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{route('categories.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh mục sản phẩm</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{url('comment')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/comment.png')}}" alt="">
             <p>
               Bình luận đánh giá sản phẩm
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="{{route('posts.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/post.png')}}" alt="">
             <p>
               Bài Viết
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('posts.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách bài viết</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{route('posts.add')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm bài viết</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{route('posts.indexcategory')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 Danh Mục Bài Viết
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/page.png')}}" alt="">
             <p>
               Trang
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('contacts.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Liên hệ</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="#" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/order.png')}}" alt="">
             <p>
               Dơn Hàng
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('order.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách đặt hàng</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('slider.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/silder.png')}}" alt="">
             <p>
               Slider (Hình ảnh)
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('slider.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách slider</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{route('slider.create')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm slider</p>
               </a>
             </li>

           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('menu.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/menu.png')}}" alt="">
             <p>
               Menus
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('menu.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách menu</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{route('menu.create')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm menu</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('setting.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/set.png')}}" alt="">
             <p>
               Cài đặt
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('setting.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách Settings</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{route('setting.add')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm Setting</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('users.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/menu.png')}}" alt="">
             <p>
               Thành Viên
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('users.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách thành viên</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{route('users.add')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm thành viên</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('roles.index')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/p.png')}}" alt="">
             <p>
               Phân quyền thành viên
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('roles.index')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Danh sách quyền</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{route('roles.add')}}" class="nav-link">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Thêm quyền</p>
               </a>
             </li>
           </ul>
         </li>
         <li class="nav-item">
           <a href="{{route('permission.create')}}" class="nav-link">
             <img style="padding-right:8px;" height="25" src="{{asset('images/p.png')}}" alt="">
             <p>
                Tạo dữ liệu Quyền (Permissions)
               <i class="fas fa-angle-left right"></i>
             </p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>
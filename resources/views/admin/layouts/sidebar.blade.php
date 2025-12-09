<!-- Admin Sidebar Navigation -->
<div class="sidebar">
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li><a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}"><i class="fas fa-shopping-cart mr-2"></i>Orders</a></li>
        <li><a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}"><i class="fas fa-box mr-2"></i>Products</a></li>
        <li><a href="{{ route('admin.florists.index') }}" class="{{ request()->routeIs('admin.florists*') ? 'active' : '' }}"><i class="fas fa-leaf mr-2"></i>Florists</a></li>
        <li><a href="{{ route('admin.menus.index') }}" class="{{ request()->routeIs('admin.menus*') ? 'active' : '' }}"><i class="fas fa-utensils mr-2"></i>Menus</a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}"><i class="fas fa-tags mr-2"></i>Categories</a></li>
        <li><a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders*') ? 'active' : '' }}"><i class="fas fa-images mr-2"></i>Sliders</a></li>
    </ul>
</div>

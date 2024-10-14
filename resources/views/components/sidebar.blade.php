<div class="center-item">
    <ul class="menu-list">
        <li
            class="menu-item has-children {{ in_array(Route::currentRouteName(), ['add.product', 'product.list', 'product.gallery', 'product.review']) ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-shopping-cart"></i></div>
                <div class="text">Products</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.product') }}"
                        class="{{ Route::currentRouteName() == 'add.product' ? 'active' : '' }}">
                        <div class="text">Add Product</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('product.list') }}"
                        class="{{ Route::currentRouteName() == 'product.list' ? 'active' : '' }}">
                        <div class="text">Products</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('product.gallery') }}"
                        class="{{ Route::currentRouteName() == 'product.gallery' ? 'active' : '' }}">
                        <div class="text">Gallery</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('product.review') }}"
                        class="{{ Route::currentRouteName() == 'product.review' ? 'active' : '' }}">
                        <div class="text">Products Review</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.brand' || Route::currentRouteName() == 'brand.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-layers"></i></div>
                <div class="text">Brand</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.brand') }}"
                        class="{{ Route::currentRouteName() == 'add.brand' ? 'active' : '' }}">
                        <div class="text">New Brand</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('brand.list') }}"
                        class="{{ Route::currentRouteName() == 'brand.list' ? 'active' : '' }}">
                        <div class="text">Brands</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.category' || Route::currentRouteName() == 'category.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-layers"></i></div>
                <div class="text">Category</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.category') }}"
                        class="{{ Route::currentRouteName() == 'add.category' ? 'active' : '' }}">
                        <div class="text">New Category</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('category.list') }}"
                        class="{{ Route::currentRouteName() == 'category.list' ? 'active' : '' }}">
                        <div class="text">Categories</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.size' || Route::currentRouteName() == 'size.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-layers"></i></div>
                <div class="text">Size</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.size') }}"
                        class="{{ Route::currentRouteName() == 'add.size' ? 'active' : '' }}">
                        <div class="text">New size</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('size.list') }}"
                        class="{{ Route::currentRouteName() == 'size.list' ? 'active' : '' }}">
                        <div class="text">sizes</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.color' || Route::currentRouteName() == 'color.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-layers"></i></div>
                <div class="text">color</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.color') }}"
                        class="{{ Route::currentRouteName() == 'add.color' ? 'active' : '' }}">
                        <div class="text">New color</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('color.list') }}"
                        class="{{ Route::currentRouteName() == 'color.list' ? 'active' : '' }}">
                        <div class="text">colors</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item has-children {{ Route::currentRouteName() == 'order.lists' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-file-plus"></i></div>
                <div class="text">Order</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('order.lists') }}"
                        class="{{ Route::currentRouteName() == 'order.lists' ? 'active' : '' }}">
                        <div class="text">Orders</div>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.coupons' || Route::currentRouteName() == 'coupons.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-grid"></i></div>
                <div class="text">Coupns</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.coupons') }}"
                        class="{{ Route::currentRouteName() == 'add.coupons' ? 'active' : '' }}">
                        <div class="text">New coupons</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('coupons.list') }}"
                        class="{{ Route::currentRouteName() == 'coupons.list' ? 'active' : '' }}">
                        <div class="text">coupons</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.slides' || Route::currentRouteName() == 'slides.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="icon-image"></i></div>
                <div class="text">Home Slider</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.slides') }}"
                        class="{{ Route::currentRouteName() == 'add.slides' ? 'active' : '' }}">
                        <div class="text">New slides</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('slides.list') }}"
                        class="{{ Route::currentRouteName() == 'slides.list' ? 'active' : '' }}">
                        <div class="text">slides</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.deals' || Route::currentRouteName() == 'deals.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="text">Hot Deals</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.deals') }}"
                        class="{{ Route::currentRouteName() == 'add.deals' ? 'active' : '' }}">
                        <div class="text">New deal</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('deals.list') }}"
                        class="{{ Route::currentRouteName() == 'deals.list' ? 'active' : '' }}">
                        <div class="text">deals</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.type' || Route::currentRouteName() == 'type.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-brands fa-pagelines"></i></div>
                <div class="text">Latest Type</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.type') }}"
                        class="{{ Route::currentRouteName() == 'add.type' ? 'active' : '' }}">
                        <div class="text">New Type</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('type.list') }}"
                        class="{{ Route::currentRouteName() == 'type.list' ? 'active' : '' }}">
                        <div class="text">Types</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.shop.slides' || Route::currentRouteName() == 'shop.slides.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-seedling"></i></div>
                <div class="text">Shop Slider</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.shop.slides') }}"
                        class="{{ Route::currentRouteName() == 'add.shop.slides' ? 'active' : '' }}">
                        <div class="text">New Shop slider</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('shop.slides.list') }}"
                        class="{{ Route::currentRouteName() == 'shop.slides.list' ? 'active' : '' }}">
                        <div class="text">sliders</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item has-children {{ Route::currentRouteName() == 'contact.lists' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                <div class="text">Contact</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('contact.lists') }}"
                        class="{{ Route::currentRouteName() == 'contact.lists' ? 'active' : '' }}">
                        <div class="text">Contact List</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.about' || Route::currentRouteName() == 'about.list' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-street-view"></i></div>
                <div class="text">About</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.about') }}"
                        class="{{ Route::currentRouteName() == 'add.about' ? 'active' : '' }}">
                        <div class="text">Add About</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('about.list') }}"
                        class="{{ Route::currentRouteName() == 'about.list' ? 'active' : '' }}">
                        <div class="text">Abouts</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'admin.users' || Route::currentRouteName() == 'customer.users' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-users"></i></div>
                <div class="text">Users</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('admin.users') }}"
                        class="{{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}">
                        <div class="text">Admin Users</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('customer.users') }}"
                        class="{{ Route::currentRouteName() == 'customer.users' ? 'active' : '' }}">
                        <div class="text">Customer Users</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ Route::currentRouteName() == 'add.faddress' || Route::currentRouteName() == 'faddress.lists' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-yin-yang"></i></div>
                <div class="text">F Address</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('add.faddress') }}"
                        class="{{ Route::currentRouteName() == 'add.faddress' ? 'active' : '' }}">
                        <div class="text">Add Faddress</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('faddress.lists') }}"
                        class="{{ Route::currentRouteName() == 'faddress.lists' ? 'active' : '' }}">
                        <div class="text">Faddress Lists</div>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="menu-item has-children {{ in_array(Route::currentRouteName(), [
                'edit.careers',
                'edit.affiliates',
                'edit.cService',
                'edit.findStore',
                'edit.Privacy',
                'edit.gCard',
            ])
                ? 'active'
                : '' }}">
            <a href="javascript:void(0);" class="menu-item-button">
                <div class="icon"><i class="fa-solid fa-shoe-prints"></i></div>
                <div class="text">Footer Data</div>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="{{ route('edit.careers') }}"
                        class="{{ Route::currentRouteName() == 'edit.careers' ? 'active' : '' }}">
                        <div class="text">Careers</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="{{ route('edit.affiliates') }}"
                        class="{{ Route::currentRouteName() == 'edit.affiliates' ? 'active' : '' }}">
                        <div class="text">Affiliates</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="" class="{{ Route::currentRouteName() == 'edit.affiliates' ? 'active' : '' }}">
                        <div class="text">Customer Service</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="" class="{{ Route::currentRouteName() == 'edit.affiliates' ? 'active' : '' }}">
                        <div class="text">Find a Store</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="" class="{{ Route::currentRouteName() == 'edit.affiliates' ? 'active' : '' }}">
                        <div class="text">Privacy & Policy</div>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="" class="{{ Route::currentRouteName() == 'edit.affiliates' ? 'active' : '' }}">
                        <div class="text">Gift Card</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

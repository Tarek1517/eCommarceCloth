<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CustomerController;
use App\Http\Controllers\frontend\Home;
use App\Http\Controllers\frontend\ShopController;
use App\Http\Controllers\frontend\wishlistController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\AboutUsController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\FooterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlidesController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\HotDealController;
use App\Http\Controllers\TypeCOntroller;
use App\Http\Controllers\ShopSliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FaddressController;
use App\Http\Controllers\AdminFooterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

#home route
Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/customer/search', [Home::class, 'customer_search'])->name('customer.search');

#shop route
Route::get('/shop', [ShopController::class, 'index'])->name('index.shop');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::post('/wishlist/add', [wishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('index.wishlist');
Route::DELETE('/wishlist/remove/item/{rowId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy.item');
Route::DELETE('/wishlist/clear/item', [WishlistController::class, 'clear_wishlist'])->name('clear.wishlist');
Route::post('/move/to/cart/{rowId}', [wishlistController::class, 'move_to_cart'])->name('move.to.cart');

#cart route
Route::get('/cart', [CartController::class, 'index'])->name('index.cart');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase_quantity/{rowId}', [CartController::class, 'increaseQuantity'])->name('cart.qty.increase');
Route::put('/cart/decrease_quantity/{rowId}', [CartController::class, 'decreaseQuantity'])->name('cart.qty.decrease');
Route::DELETE('/cart/remove/item/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy.item');
Route::DELETE('/cart/clear/item', [CartController::class, 'clear_cart'])->name('clear.cart');
Route::post('/cart/apply/coupon', [CartController::class, 'apply_coupon'])->name('cart.apply.coupon');
Route::DELETE('/coupon/clear', [CartController::class, 'clear_coupon'])->name('clear.coupon');
Route::get('/checkout', [CartController::class, 'checkout'])->name('show.checkout');
Route::post('/place/an/order', [CartController::class, 'place_an_order'])->name('place.order');
Route::get('/order/confirmation', [CartController::class, 'confirmation'])->name('order.confirmation');

#contact route
Route::get('/contact/form', [ContactController::class, 'contact'])->name('contact.form');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

#about us
Route::get('/aboutus', [AboutUsController::class, 'index'])->name('index.aboutus');

#Footer Pages 
Route::get('/Career/info', [FooterController::class, 'index'])->name('Career.info');
Route::get('/affiliates/info', [FooterController::class, 'affiliates'])->name('affiliates.info');
Route::get('/customer/service', [FooterController::class, 'customer_service'])->name('customer.service');
Route::get('/find/store', [FooterController::class, 'find_store'])->name('find.store');
Route::get('/legal/privacy', [FooterController::class, 'legal_privacy'])->name('legal.privacy');
Route::get('/gift/card', [FooterController::class, 'gift_card'])->name('gift.card');

#customer login route

Route::get('/Customer/login', [Home::class, 'login'])->name('Customer.login');
Route::get('/Customer/register', [Home::class, 'register'])->name('customer.register');
Route::post('/submit/login', [Home::class, 'loginSubmit'])->name('submit.login');
Route::post('/store/customer', [Home::class, 'store'])->name('store.customer');
Route::post('/submit/login', [Home::class, 'loginSubmit'])->name('submit.login');

Route::middleware('auth:customer')->group(function () {

    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('logout', [CustomerController::class, 'logout'])->name('customer.logout');
    Route::get('/customer/orders', [CustomerController::class, 'create'])->name('customer.orders');
    Route::get('/customer/order/details/{order_id}', [CustomerController::class, 'show'])->name('customer.order.details');
    Route::put('/customer/cancel/order', [CustomerController::class, 'cancel_order'])->name('customer.cancel.order');
    Route::get('/customer/address', [CustomerController::class, 'address'])->name('customer.address');
    Route::get('/edit/customer/{id}', [CustomerController::class, 'edit'])->name('edit.customer');
    Route::post('/update/address/{id}', [CustomerController::class, 'update'])->name('update.address');
    Route::get('/account/details/{id}', [CustomerController::class, 'details'])->name('account.details');
    Route::post('/update/details/{id}', [CustomerController::class, 'update_details'])->name('update.details');
    Route::get('/customer/wishlist', [CustomerController::class, 'wishlist'])->name('customer.wishlist');

});

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    #Brand Section
    Route::get('/add/brand', [BrandController::class, 'create'])->name('add.brand');
    Route::post('/store/brand', [BrandController::class, 'store'])->name('store.brand');
    Route::get('/brand/list', [BrandController::class, 'index'])->name('brand.list');
    Route::get('/delete/brand/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
    Route::get('/edit/brand/{id}', [BrandController::class, 'edit'])->name('edit.brand');
    Route::post('/update/brand/{id}', [BrandController::class, 'update'])->name('update.brand');

    #Category Section
    Route::get('/add/category', [CategoryController::class, 'create'])->name('add.category');
    Route::post('/store/category', [CategoryController::class, 'store'])->name('store.category');
    Route::get('/category/list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/delete/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('edit.category');

    #size Section
    Route::get('/add/size', [SizeController::class, 'create'])->name('add.size');
    Route::post('/store/size', [SizeController::class, 'store'])->name('store.size');
    Route::get('/size/list', [SizeController::class, 'index'])->name('size.list');
    Route::get('/delete/size/{id}', [SizeController::class, 'destroy'])->name('size.delete');
    Route::get('/edit/size/{id}', [SizeController::class, 'edit'])->name('edit.size');
    Route::post('/update/size/{id}', [SizeController::class, 'update'])->name('update.size');

    #color Section
    Route::get('/add/color', [ColorController::class, 'create'])->name('add.color');
    Route::post('/store/color', [ColorController::class, 'store'])->name('store.color');
    Route::get('/color/list', [ColorController::class, 'index'])->name('color.list');
    Route::get('/delete/color/{id}', [ColorController::class, 'destroy'])->name('color.delete');
    Route::get('/edit/color/{id}', [ColorController::class, 'edit'])->name('edit.color');
    Route::post('/update/color/{id}', [ColorController::class, 'update'])->name('update.color');

    #Product Section
    Route::get('/add/product', [ProductController::class, 'create'])->name('add.product');
    Route::POST('/store/product', [ProductController::class, 'store'])->name('store.product');
    Route::get('/product/list', [ProductController::class, 'index'])->name('product.list');
    Route::get('/product/gallery', [ProductController::class, 'create_Gallery'])->name('product.gallery');
    Route::get('/delete/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/edit/product/{id}', [ProductController::class, 'edit'])->name('edit.product');
    Route::post('/update/product/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::get('/product/review', [ProductController::class, 'review'])->name('product.review');
    Route::get('/approved/review/{id}', [ProductController::class, 'approved_review'])->name('approved.review');
    Route::get('/pending/review/{id}', [ProductController::class, 'pending_review'])->name('pending.review');
    Route::get('/delete/review/{id}', [ProductController::class, 'destroy_Review'])->name('review.delete');
    Route::post('/ckeditor/upload', [ProductController::class, 'storeCKeditor'])->name('ckeditor.upload');

    #coupon section
    Route::get('/add/coupons', [CouponController::class, 'create'])->name('add.coupons');
    Route::POST('/store/coupons', [CouponController::class, 'store'])->name('store.coupons');
    Route::get('/coupons/list', [CouponController::class, 'index'])->name('coupons.list');
    Route::get('/delete/coupons/{id}', [CouponController::class, 'destroy'])->name('coupons.delete');
    Route::get('/edit/coupons/{id}', [CouponController::class, 'edit'])->name('edit.coupons');
    Route::post('/update/coupons/{id}', [CouponController::class, 'update'])->name('update.coupons');
    Route::get('/active/coupons/{id}', [CouponController::class, 'activeCoupons'])->name('active.coupons');
    Route::get('/pending/coupons/{id}', [CouponController::class, 'pendingCoupons'])->name('pending.coupons');

    #order section
    Route::get('/order/lists', [OrderController::class, 'create'])->name('order.lists');
    Route::get('/order/details/{order_id}', [OrderController::class, 'show'])->name('order.details');
    Route::delete('/delete/order/{id}', [OrderController::class, 'destroy'])->name('order.delete');
    Route::put('/order/update/status', [OrderController::class, 'update_status'])->name('order.update.status');

    #home page Slides
    Route::get('/add/slides', [SlidesController::class, 'create'])->name('add.slides');
    Route::POST('/store/slides', [SlidesController::class, 'store'])->name('store.slides');
    Route::get('/slides/list', [SlidesController::class, 'index'])->name('slides.list');
    Route::get('/delete/Slide/{id}', [SlidesController::class, 'destroy'])->name('Slide.delete');
    Route::get('/active/Slide/{id}', [SlidesController::class, 'activeSlide'])->name('active.Slide');
    Route::get('/inactive/Slide/{id}', [SlidesController::class, 'inactiveSlide'])->name('inactive.Slide');
    Route::get('/edit/Slide/{id}', [SlidesController::class, 'edit'])->name('edit.Slide');
    Route::post('/update/Slide/{id}', [SlidesController::class, 'update'])->name('update.Slide');

    #hot deals section
    Route::get('/add/deals', [HotDealController::class, 'create'])->name('add.deals');
    Route::POST('/store/deals', [HotDealController::class, 'store'])->name('store.deals');
    Route::get('/deals/list', [HotDealController::class, 'index'])->name('deals.list');
    Route::get('/delete/deals/{id}', [HotDealController::class, 'destroy'])->name('deals.delete');
    Route::get('/active/deals/{id}', [HotDealController::class, 'activeDeals'])->name('active.deals');
    Route::get('/inactive/deals/{id}', [HotDealController::class, 'inactiveDeals'])->name('inactive.deals');
    Route::get('/edit/deals/{id}', [HotDealController::class, 'edit'])->name('edit.deals');
    Route::post('/update/deals/{id}', [HotDealController::class, 'update'])->name('update.deals');


    #Latest Type
    Route::get('/add/type', [TypeCOntroller::class, 'create'])->name('add.type');
    Route::POST('/store/type', [TypeCOntroller::class, 'store'])->name('store.type');
    Route::get('/type/list', [TypeCOntroller::class, 'index'])->name('type.list');
    Route::get('/delete/type/{id}', [TypeCOntroller::class, 'destroy'])->name('type.delete');
    Route::get('/active/type/{id}', [TypeCOntroller::class, 'activeType'])->name('active.type');
    Route::get('/inactive/type/{id}', [TypeCOntroller::class, 'inactiveType'])->name('inactive.type');
    Route::get('/edit/type/{id}', [TypeCOntroller::class, 'edit'])->name('edit.type');
    Route::post('/update/type/{id}', [TypeCOntroller::class, 'update'])->name('update.type');

    #Shop Sliders
    Route::get('/add/shop/slides', [ShopSliderController::class, 'create'])->name('add.shop.slides');
    Route::POST('/store/shop/slides', [ShopSliderController::class, 'store'])->name('store.shop.slides');
    Route::get('/shop/slides/list', [ShopSliderController::class, 'index'])->name('shop.slides.list');
    Route::get('/delete/shop/slides/{id}', [ShopSliderController::class, 'destroy'])->name('shop.slides.delete');
    Route::get('/active/shop/slides/{id}', [ShopSliderController::class, 'activeShSlides'])->name('active.shop.slides');
    Route::get('/inactive/shop/slides/{id}', [ShopSliderController::class, 'inactiveShSlides'])->name('inactive.shop.slides');
    Route::get('/edit/shop/slides/{id}', [ShopSliderController::class, 'edit'])->name('edit.shop.slides');
    Route::post('/update/type/{id}', [ShopSliderController::class, 'update'])->name('update.shop.slides');

    #contact Section
    Route::get('/contact/lists', [ContactController::class, 'index'])->name('contact.lists');
    Route::get('/delete/contact/{id}', [ContactController::class, 'destroy'])->name('contact.delete');
    Route::get('/contact/details/{id}', [ContactController::class, 'show'])->name('contact.details');

    #about section
    Route::get('/add/about', [AboutController::class, 'create'])->name('add.about');
    Route::POST('/store/about', [AboutController::class, 'store'])->name('store.about');
    Route::get('/about/list', [AboutController::class, 'index'])->name('about.list');
    Route::get('/delete/about/{id}', [AboutController::class, 'destroy'])->name('about.delete');
    Route::get('/active/about/{id}', [AboutController::class, 'activeAbout'])->name('active.about');
    Route::get('/pending/about/{id}', [AboutController::class, 'pendingAbout'])->name('pending.about');
    Route::get('/edit/about/{id}', [AboutController::class, 'edit'])->name('edit.about');
    Route::post('/update/about/{id}', [AboutController::class, 'update'])->name('update.about');

    #user section 
    Route::get('/admin/users', [AdminController::class, 'admin_users'])->name('admin.users');
    Route::get('/delete/admin/{id}', [AdminController::class, 'destroy'])->name('delete.admin');
    Route::get('/add/admin', [AdminController::class, 'create'])->name('add.admin');
    Route::POST('/store/admin', [AdminController::class, 'store'])->name('store.admin');

    Route::get('/customer/users', [AdminController::class, 'customer_users'])->name('customer.users');
    Route::get('/delete/customer/{id}', [AdminController::class, 'destroy_customer'])->name('delete.customer');

    #settings section
    Route::get('/admin/settings/{id}', [AdminController::class, 'edit'])->name('admin.settings');
    Route::post('/update/settings/{id}', [AdminController::class, 'update'])->name('update.settings');
    Route::get('admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
    Route::get('/add/logo', [AdminController::class, 'add_logo'])->name('add.logo');
    Route::post('/update/logo', [AdminController::class, 'update_logo'])->name('update.logo');

    #search 
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');

    #footer section
    Route::get('/add/faddress', [FaddressController::class, 'create'])->name('add.faddress');
    Route::POST('/store/faddress', [FaddressController::class, 'store'])->name('store.faddress');
    Route::get('/faddress/lists', [FaddressController::class, 'index'])->name('faddress.lists');
    Route::get('/delete/faddress/{id}', [FaddressController::class, 'destroy'])->name('faddress.delete');
    Route::get('/active/faddress/{id}', [FaddressController::class, 'activeFaddress'])->name('active.faddress');
    Route::get('/pending/faddress/{id}', [FaddressController::class, 'pendingFaddress'])->name('pending.faddress');

    Route::get('/edit/careers', [AdminFooterController::class, 'edit_careers'])->name('edit.careers');
    Route::post('/upload-image/{id}', [AdminFooterController::class, 'uploadImage'])->name('upload.image');
    Route::post('/store/career', [AdminFooterController::class, 'store_career'])->name('store.career');


});

require __DIR__ . '/auth.php';

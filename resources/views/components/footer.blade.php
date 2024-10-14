<footer class="footer footer_type_2">
    <div class="footer-middle container">
        <div class="row row-cols-lg-5 row-cols-2">
            <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
                @php
                    $siteLogo = \App\Models\SiteLogo::first();
                @endphp
                <div class="logo">
                    <a href="{{ route('home') }}">
                        @if ($siteLogo && $siteLogo->image)
                            <img src="{{ asset('storage/img/' . $siteLogo->image) }}" alt="Uomo"
                                class="logo__image d-block">
                        @else
                            <img src="{{ asset('default-logo.png') }}" alt="Uomo" class="logo__image d-block">
                        @endif
                    </a>
                </div>
                @php
                    $FaddressContent = \App\Models\Faddress::where('status', 'active')->first();
                @endphp
                <p class="footer-address">{{ $FaddressContent->address }}</p>
                <p class="m-0"><strong>{{ $FaddressContent->email }}</strong></p>
                <p><strong class="fw-medium">{{ $FaddressContent->phone }}</strong></p>

                <ul class="social-links list-unstyled d-flex flex-wrap mb-0">
                    @if ($FaddressContent->f_link)
                        <li>
                            <a href="{{ $FaddressContent->f_link }}" class="footer__social-link d-block">
                                <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_facebook" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($FaddressContent->t_link)
                        <li>
                            <a href="{{ $FaddressContent->t_link }}" class="footer__social-link d-block">
                                <svg class="svg-icon svg-icon_twitter" width="14" height="13" viewBox="0 0 14 13"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_twitter" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($FaddressContent->I_link)
                        <li>
                            <a href="{{ $FaddressContent->I_link }}" class="footer__social-link d-block">
                                <svg class="svg-icon svg-icon_instagram" width="14" height="13"
                                    viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_instagram" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($FaddressContent->Y_link)
                        <li>
                            <a href="{{ $FaddressContent->Y_link }}" class="footer__social-link d-block">
                                <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($FaddressContent->p_link)
                        <li>
                            <a href="{{ $FaddressContent->p_link }}" class="footer__social-link d-block">
                                <svg class="svg-icon svg-icon_pinterest" width="14" height="15"
                                    viewBox="0 0 14 15" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_pinterest" />
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Company</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('index.aboutus') }}"
                            class="menu-link menu-link_us-s">About Us</a></li>
                    <li class="sub-menu__item"><a href="{{ route('Career.info') }}"
                            class="menu-link menu-link_us-s">Careers</a></li>
                    <li class="sub-menu__item"><a href="{{ route('affiliates.info') }}"
                            class="menu-link menu-link_us-s">Affiliates</a></li>
                    <li class="sub-menu__item"><a href="{{ route('contact.form') }}"
                            class="menu-link menu-link_us-s">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Shop</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('index.shop', ['order' => 1]) }}"
                            class="menu-link menu-link_us-s">New Arrivals</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('index.shop', ['slug' => 'accessories']) }}"
                            class="menu-link menu-link_us-s">Accessories</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('index.shop', ['slug' => 'men']) }}"
                            class="menu-link menu-link_us-s">Men</a></li>
                    <li class="sub-menu__item"><a href="{{ route('index.shop', ['slug' => 'women']) }}"
                            class="menu-link menu-link_us-s">Women</a></li>
                    <li class="sub-menu__item"><a href="{{ route('index.shop') }}"
                            class="menu-link menu-link_us-s">Shop
                            All</a></li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Help</h6>
                <ul class="sub-menu__list list-unstyled">
                    <li class="sub-menu__item"><a href="{{ route('customer.service') }}"
                            class="menu-link menu-link_us-s">Customer Service</a>
                    </li>
                    @guest('customer')
                        <li class="sub-menu__item"><a href="{{ route('Customer.login') }}"
                                class="menu-link menu-link_us-s">My
                                Account</a>
                        </li>
                    @else
                        <li class="sub-menu__item"><a href="{{ route('customer.dashboard') }}"
                                class="menu-link menu-link_us-s">My
                                Account</a>
                        </li>
                    @endguest
                    
                    <li class="sub-menu__item"><a href="{{ route('legal.privacy') }}"
                            class="menu-link menu-link_us-s">Legal & Privacy</a>
                    </li>
                    <li class="sub-menu__item"><a href="{{ route('gift.card') }}"
                            class="menu-link menu-link_us-s">Gift Card</a></li>
                </ul>
            </div>

            <div class="footer-column footer-menu mb-4 mb-lg-0">
                <h6 class="sub-menu__title text-uppercase">Categories</h6>
                @php
                    $categories = \App\Models\Category::orderBy('created_at', 'DESC')->take(5)->get();
                @endphp
                <ul class="sub-menu__list list-unstyled">
                    @foreach ($categories as $category)
                        <li class="sub-menu__item">
                            <a href="{{ route('index.shop', ['categories' => $category->id]) }}"
                                class="menu-link menu-link_us-s">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-md-flex align-items-center">
            <span class="footer-copyright me-auto">©2024 Surfside Media</span>
            <div class="footer-settings d-md-flex align-items-center">
                <a href="privacy-policy.html">Privacy Policy</a> &nbsp;|&nbsp; <a href="terms-conditions.html">Terms
                    &amp;
                    Conditions</a>
            </div>
        </div>
    </div>
</footer>

<footer class="footer-mobile container w-100 px-5 d-md-none bg-body">
    <div class="row text-center">
        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_home" />
                </svg>
                <span>Home</span>
            </a>
        </div>

        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <svg class="d-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_hanger" />
                </svg>
                <span>Shop</span>
            </a>
        </div>

        <div class="col-4">
            <a href="index.html" class="footer-mobile__link d-flex flex-column align-items-center">
                <div class="position-relative">
                    <svg class="d-block" width="18" height="18" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_heart" />
                    </svg>
                    <span class="wishlist-amount d-block position-absolute js-wishlist-count">3</span>
                </div>
                <span>Wishlist</span>
            </a>
        </div>
    </div>
</footer>

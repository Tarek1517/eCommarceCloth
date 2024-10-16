<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>SurfsideMedia</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css') }}"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>


</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                <div class="section-menu-left">
                    <div class="box-logo">
                        @php
                            $siteLogo = \App\Models\SiteLogo::first();
                        @endphp
                        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
                            @if ($siteLogo && $siteLogo->image)
                                <img src="{{ asset('storage/img/' . $siteLogo->image) }}" alt="Site Logo">
                            @else
                                <img src="{{ asset('default-logo.png') }}" alt="Default Logo">
                            @endif
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('admin.dashboard') }}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <x-sidebar />
                    </div>
                </div>
                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                @php
                                    $siteLogo = \App\Models\SiteLogo::first();
                                @endphp
                                <a href="index-2.html">
                                    @if ($siteLogo && $siteLogo->image)
                                        <img src="{{ asset('storage/img/' . $siteLogo->image) }}" alt="Site Logo">
                                    @else
                                        <img src="{{ asset('default-logo.png') }}" alt="Default Logo">
                                    @endif
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                <form class="form-search flex-grow" id="search-form">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" aria-required="true" required=""
                                            id="search-input" autocomplete="off" />
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search-wrapper">
                                        <ul id="box-content-search">
                                            <!-- Search results will be appended here -->
                                        </ul>
                                    </div>
                                </form>


                            </div>

                            <div class="header-grid">
                                <div class="popup-wrap message type-header p-2 mt-2">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny mb-1">{{ $newMessagesCount }}</span>
                                                <i class="fa-solid fa-envelope"></i>
                                            </span>
                                        </button>
                                        @if ($newMessagesCount == 0)
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <div class="message-item item-2">
                                                        <div class="image">
                                                            <i class="fa-solid fa-comments"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">New Message</div>
                                                            <div class="text-tiny mt-1">You have
                                                                {{ $newMessagesCount }}
                                                                new
                                                                Message(s)</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <div class="message-item item-2">
                                                        <div class="image">
                                                            <i class="fa-solid fa-comments"></i>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('messages.markAsRead') }}">
                                                                <div class="body-title-2">New Message</div>
                                                                <div class="text-tiny mt-1">You have
                                                                    {{ $newMessagesCount }}
                                                                    new
                                                                    Message(s)</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="popup-wrap message type-header p-2 mt-2">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny mb-1">{{ $newOrdersCount }}</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        @if ($newOrdersCount == 0)
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <div class="message-item item-1">
                                                        <div class="image">
                                                            <i class="fa-solid fa-globe"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">New Orders</div>
                                                            <div class="text-tiny mt-1">{{ $newOrdersCount }} new
                                                                Order(s) Pending</div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton2">

                                                <li>
                                                    <div class="message-item item-1">
                                                        <div class="image">
                                                            <i class="fa-solid fa-globe"></i>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('order.lists') }}">
                                                                <div class="body-title-2">New Orders</div>
                                                                <div class="text-tiny mt-1">{{ $newOrdersCount }} new
                                                                    Order(s) Pending</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{ url('/storage/img/' . Auth::user()->image) }}"
                                                        alt="" class="img-fluid"
                                                        style="height: 36px; width: auto;">
                                                </span>

                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                                    <span class="text-tiny">{{ Auth::user()->u_type }}</span>
                                                </span>
                                            </span>
                                        </button>
                                        @if (Auth::user()->u_type === 'administrator')
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton3">
                                                <li>
                                                    <a href="{{ route('add.logo') }}" class="user-item">
                                                        <div class="icon">
                                                            <i class="fa-brands fa-pied-piper"></i>
                                                        </div>
                                                        <div class="body-title-2">Site Logo</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.settings', Auth::user()->id) }}"
                                                        class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-settings"></i>
                                                        </div>
                                                        <div class="body-title-2">Settings</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.logout') }}" class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">Log out</div>
                                                    </a>
                                                </li>
                                            </ul>
                                        @else
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton3">
                                                <li>
                                                    <a href="{{ route('admin.settings', Auth::user()->id) }}"
                                                        class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-settings"></i>
                                                        </div>
                                                        <div class="body-title-2">Settings</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.logout') }}" class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">Log out</div>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-content">

                        @yield('dashboardContent')

                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 SurfsideMedia</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Define the route using Blade syntax before the AJAX call
            var searchRoute = "{{ route('admin.search') }}"; // Place this line at the top of the script

            $("#search-input").on("keyup", function() {
                var searchQuery = $(this).val();

                if (searchQuery.length > 3) {
                    $.ajax({
                        type: "GET",
                        url: searchRoute, // Use the variable here
                        data: {
                            query: searchQuery
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#box-content-search").html("");

                            $.each(data, function(index, item) {
                                var url =
                                    "{{ route('edit.product', ['id' => 'product_id']) }}";
                                var link = url.replace("product_id", item.id);
                                var imageUrl = item.galleryImages.length > 0 ? item
                                    .galleryImages[0] : '/storage/img/default.jpg';

                                $("#box-content-search").append(`
                                    <li>
                                        <ul>
                                            <div class="product-item gap14 mb-10">
                                                <div class="image no-bg">
                                                    <img src="${imageUrl}" alt="${item.name}" class="image">
                                                </div>
                                                <div class="items-center justify-between gap20 flex-grow">
                                                    <div class="name">
                                                        <a href="${link}" class="body-text">${item.name}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                `);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', xhr.responseText);
                        }
                    });
                } else {
                    $("#box-content-search").html("");
                }
            });
        });
    </script>
    <script src="{{ asset('js/layout.js') }}"></script>
    <script src="{{ asset('js/dashlayout.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

</body>

</html>

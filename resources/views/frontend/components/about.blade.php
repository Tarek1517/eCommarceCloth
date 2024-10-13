@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">About US</h2>
            </div>
            @foreach ($aboutContents as $about)
                <div class="about-us__content pb-5 mb-5">
                    <p class="mb-5">
                        <img loading="lazy" class="w-100 h-auto d-block" src="{{ url('/storage/img/' . $about->image) }}"
                            width="1410" height="550" alt="" />
                    </p>
                    <div class="mw-930">
                        <h3 class="mb-4">{{ $about->title }}</h3>
                        <p class="fs-6 fw-medium mb-4">{{ $about->bdescription }}</p>
                        <p class="mb-4">{{ $about->description }}</p>
                    </div>

                    @php
                        // Separate by side, but allow items with or without images
                        $left = $about->aboutsidebar
                            ->where('side', 'left')
                            ->where('about_id', $about->id)
                            ->values(); // Reindexing after fetching
                        $right = $about->aboutsidebar
                            ->where('side', 'right')
                            ->where('about_id', $about->id)
                            ->values(); // Reindexing after fetching
                    @endphp

                    <div class="mw-930">
                        @for ($i = 0; $i < max($left->count(), $right->count()); $i++)
                            <div class="row mb-4">
                                <!-- Left column content -->
                                <div class="col-lg-6">
                                    @if ($left->get($i))
                                        <h5 class="mb-3">{{ $left[$i]->stitle }}</h5>
                                        <p>{{ $left[$i]->sdescription }}</p>

                                        <!-- Show image only if it exists -->
                                        @if (!empty($left[$i]->simage))
                                            <img class="img-fluid h-auto mt-3" loading="lazy"
                                                src="{{ url('/storage/img/' . $left[$i]->simage) }}"
                                                alt="{{ $left[$i]->stitle }}">
                                        @endif
                                    @endif
                                </div>

                                <!-- Right column content -->
                                <div class="col-lg-6">
                                    @if ($right->get($i))
                                        <h5 class="mb-3">{{ $right[$i]->stitle }}</h5>
                                        <p>{{ $right[$i]->sdescription }}</p>

                                        <!-- Show image only if it exists -->
                                        @if (!empty($right[$i]->simage))
                                            <img class="img-fluid h-auto mt-3" loading="lazy"
                                                src="{{ url('/storage/img/' . $right[$i]->simage) }}"
                                                alt="{{ $right[$i]->stitle }}">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>



                </div>
            @endforeach
        </section>


    </main>
@endsection

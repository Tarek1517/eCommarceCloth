@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">{{ $careerContents->name }}</h2>
            </div>
        </section>
        
        <!-- Divider -->
        <hr class="custom-divider">

        <section class="container mw-930 lh-30">
            <h3>{!! $careerContents->description !!}</h3>
        </section>

    </main>
@endsection

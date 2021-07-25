@if (count($sliderData))
<div class="container">
    <section class="slider-block">
        <image-slider :slides='@json($sliderData)' public_path="{{ url()->to('/') }}"></image-slider>
    </section>
</div>
@endif
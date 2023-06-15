@extends('frontlayout')
@section('content')
	<div class="text-start mt-4" style="margin-left: 105px;">
    @if(Session::has('guestlogin'))
    <div class="text-muted fs-5">
        Welcome,<span class="fw-bold" style="padding-left: 8px;">{{ session('data')[0]->full_name }}</span>
  	</div>
    @endif
	</div>
    
<!-- map
<div class="contact-in">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.551746954215!2d126.97522138339006!3d37.56562345210068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca2f208c205d7%3A0xfd82ff77088737d0!2sLa%20Seine!5e0!3m2!1sen!2sph!4v1685073924013!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contact-form">
            <h1>Contact Us</h1>
            <form action="" method="post">
                <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="contact-form-txt" />
                <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="contact-form-txt" />
                <input type="number" name="number" required maxlength="10" min="0" max="9999999999" placeholder="enter your number" class="contact-form-txt" />
                <textarea name="message" class="contact-form-textarea" required maxlength="1000" placeholder="enter your message" cols="30" rows="10"></textarea>
                <input type="submit" value="send message" name="send" class="contact-form-btn" />
            </form>
        </div>
</div> -->
<!-- Gallery Section Start -->
<div class="container my-4 mt-4">
	<h1 class="text-center border-bottom" id="gallery">Gallery</h1>
	<div class="row my-4">
		@foreach($roomTypes as $rtype)
		<div class="col-md-3">
			<div class="card">
				<h5 class="card-header">{{$rtype->title}}</h5>
				<div class="card-body">
					@foreach($rtype->roomtypeimgs as $index => $img)
												<a href="{{ asset('storage/' . str_replace('public/', '', $img->img_src)) }}" data-lightbox="rgallery{{$rtype->id}}">
													@if($index > 0)
													<img class="img-fluid hide" src="{{ asset('storage/' . str_replace('public/', '', $img->img_src)) }}" />
													@else
													<img class="img-fluid" src="{{ asset('storage/' . str_replace('public/', '', $img->img_src)) }}" />
													@endif
												</a>
											</td>
											@endforeach
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<!-- Gallery Section End -->

	<!-- Service Section Start -->
	<div class="container my-4"> 
		<h1 class="text-center border-bottom" id="services">Services</h1>
		@foreach($services as $service)
		<div class="row my-4">
			<div class="col-md-3">
				<a href="{{url('service/'.$service->id)}}"><img class="img-thumbnail" style="width:100%;" src="{{ asset('storage/' . str_replace('public/', '', $service->photo)) }}" /></a>
			</div>
			<div class="col-md-8">
				<h3>{{$service->title}}</h3>
				<p>{{$service->small_desc}}</p>
				<p>
					<a href="{{url('service/'.$service->id)}}" class="btn btn-primary">Read More</a>
				</p>
			</div>
		</div>
		@endforeach
	</div>
	<!-- Service Section End -->
	

	<!-- Slider Section Start -->
	<h1 class="text-center mt-5" id="gallery">Testimonials</h1>
	<div id="testimonials" class="carousel slide p-5 bg-secondary text-white border mb-5" data-bs-ride="carousel">
	  <div class="carousel-inner">
		@foreach($testimonials as $index => $testi)
    <div class="carousel-item @if($index==0) active @endif">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>{{$testi->testi_cont}}</p>
            </blockquote>
            <figcaption class="blockquote-footer text-white">
                {{$testi->guest->full_name}}
            </figcaption>
        </figure>
    </div>
		@endforeach
	  </div>
	  <button class="carousel-control-prev" type="button" data-bs-target="#testimonials" data-bs-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="visually-hidden">Previous</span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#testimonials" data-bs-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="visually-hidden">Next</span>
	  </button>
	</div>
	<!-- Slider Section End -->

<!-- LightBox css -->
<link rel="stylesheet" type="text/css" href="{{asset('/vendor')}}/lightbox2-2.11.3/dist/css/lightbox.min.css" />
<!-- LightBox Js -->
<script type="text/javascript" src="{{asset('/vendor')}}/lightbox2-2.11.3/dist/js/lightbox.min.js"></script>
<style type="text/css">
	.hide{
		display: none;
	}
</style>
@endsection

</body>
</html>
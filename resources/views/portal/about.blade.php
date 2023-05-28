@include('portal.common.header')
<!-- Header Start -->
<div class="container-xxl py-5 bg-dark page-header mb-5">
   <div class="container my-5 pt-5 pb-4">
      <h1 class="display-3 text-white mb-3 animated slideInDown">About us</h1>
   </div>
</div>
<!-- About Start -->
<div class="container-xxl py-5">
   <div class="container">
      <div class="row g-5 align-items-center">
         <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="row g-0 about-bg rounded overflow-hidden">
               <div class="col-6 text-start">
                  <img class="img-fluid w-100" src="{{ asset('assets/portal/company/pic1.jpeg') }}">
               </div>
               <div class="col-6 text-start">
                  <img class="img-fluid" src="{{ asset('assets/portal/company/pic2.jpeg') }}" style="width: 85%; margin-top: 15%;">
               </div>
               <div class="col-6 text-end">
                  <img class="img-fluid" src="{{ asset('assets/portal/company/pic3.jpeg') }}" style="width: 85%;">
               </div>
               <div class="col-6 text-end">
                  <img class="img-fluid w-100" src="{{ asset('assets/portal/company/pic4.jpeg') }}">
               </div>
            </div>
         </div>
         <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <h1 class="mb-4" style="text-transform: capitalize">Empowering professonals to era of new Learning</h1>
            <p class="mb-4">The Holistic approach for the professionals have lead us the way to start an amazing platform For all Medical Fraternity (Medical, Dental, Ayurveda,  Homeopathy ,Nursing, Naturopathy).</p>
            <p><i class="fa fa-check text-primary me-3"></i>Mediyush is Centre of excellence for medical practitioners and students.</p>
            <p><i class="fa fa-check text-primary me-3"></i>Our top priority is providing you best medical fraternity speaker and help you to grow your knowledge and practice.</p>
            <p><i class="fa fa-check text-primary me-3"></i>We strive to discover new ways of learning</p>
            <p><i class="fa fa-check text-primary me-3"></i>Mediyush makes courses, webinars, workshops easily available for students and practitioners with affordable price.</p>
            <p><i class="fa fa-check text-primary me-3"></i>Start your Journey with us whether you are Allopathic, Dental, Ayurvedic, Homeopathic practitioner or student with our vast library of various courses</p>
            <p><i class="fa fa-check text-primary me-3"></i>You don't need to waste your valuable time in finding a right course or fall for a lucrative advertisements as on mediyush you get to choose your mentor and the topic of your interest.</p>
            <p><i class="fa fa-check text-primary me-3"></i>we have a passion and desire of changing the era of courses in medical Fraternity</p>
         </div>
      </div>
   </div>
</div>
<!-- About End -->
@include('portal.common.footer')
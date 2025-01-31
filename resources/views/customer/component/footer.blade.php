 <!-- Footer -->


 <footer class="pt-10 pb-10 bg-success">
    <div>
      <div class="flex flex-col w-10/12 mx-auto gap-9 md:flex-row">
        <!-- Div1 -->
        <div class="flex-auto text-gray-200 intro-x md:w-72 ">
            <p class="mb-4 text-lg font-semibold md:text-center">{{ config('app.name') }} </p>
            <span class="text-xl font-light mb-7">
                Our products are Original and Genuine. usually may video muna ng order/pacel bago i-pack and i-ship out. You can chat with us
                if you have any question. Happy shopping! from Team Pasay
            </span>
        </div>
        <!-- Contact Us / Div2 -->
        <div class="text-gray-200 intro-x md:w-48">
              <ul>
                    <a href="{{ Route('contact') }}" class="text-lg font-semibold">Contact Us</a>
                    <li>
                        <div class="flex items-center mt-2 mb-2 intro-x">
                            <i class="text-base fas fa-phone pr-1"></i>
                            <p class="text-base leading-loose text-body-color group">
                                <span>{{ config('app.contact') }} </span>
                                <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                            </p>
                        <div>
                    </li>
                    <li>
                        <div class="flex items-center intro-x">
                            <i class="text-base fas fa-envelope pr-1"></i>
                            <p class="text-base leading-loose text-body-color group">
                                <span>{{ config('app.email') }} </span>
                                <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center mt-2 mb-2 intro-x">
                            <i class="text-base fa-brands fa-facebook-f pr-1"></i>
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=61555294767667">
                                <p class="text-base leading-loose text-body-color group">
                                    <span>Maliknet Team Pasay</span>
                                    <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                                </p>
                            </a>

                        <div>
                    </li>

              </ul>
              <!-- Legal / Div2.1 -->

        </div>

        <!-- Our Address / Div4 -->
          <div class="intro-x md:w-96">
            <h4 class="mb-2 text-lg font-semibold text-gray-200 intro-x">Our Address</h4>
                <p class="inline-block mb-2 text-base leading-loose text-gray-200">
                    {{ env('APP_ADDRESS') }}
                </p>

          </div>
      </div>
    </div>
</footer>

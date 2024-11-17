 <!-- Footer -->


 <footer class="pt-10 bg-success">
    <div>
      <div class="flex flex-col w-10/12 mx-auto gap-9 md:flex-row">
        <!-- Div1 -->
        <div class="flex-auto text-gray-200 intro-x md:w-72 ">
            <p class="mb-4 text-lg font-semibold md:text-center">{{ env('APP_NAME') }}</p>
            <span class="text-xl font-light mb-7">
                Our products are Original and Genuine. usually may video muna ng order/pacel bago i-pack and i-ship out. You can chat with us
                if you have any question. Happy shopping! from Team Pasay
            </span>
        </div>
        <!-- Contact Us / Div2 -->
        <div class="text-gray-200 intro-x md:w-48">
            <h4 class="mb-2 text-md font-semibold text-gray-200">Customer Care</h4>
              <ul>
                    <li>
                        <a href="{{ Route('faq') }}" class="relative inline-block mb-2 text-base leading-loose text-body-color group">
                            <span>Help Center</span>
                            <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                        </a>
                    </li>
                    <a href="{{ Route('contact') }}" class="text-lg font-semibold">Contact Us</a>
                    <li>
                        <div class="flex items-center mt-2 mb-2 intro-x">
                            <i class="text-base fas fa-phone"></i>
                            <p class="text-base leading-loose text-body-color group">
                                <span>+639 (612) 126 52</span>
                                <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                            </p>
                        <div>
                    </li>
                    <li>
                        <div class="flex items-center intro-x">
                            <i class="text-base fas fa-envelope"></i>
                            <p class="text-base leading-loose text-body-color group">
                                <span>godentalph@gmail.com</span>
                                <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                            </p>
                        </div>
                    </li>
              </ul>
              <!-- Legal / Div2.1 -->

        </div>
        <!-- Customer Care / Div3 -->
        <div class="text-gray-200 intro-x md:w-48">
            <h4 class="mb-2 text-lg font-semibold text-gray-200">{{ env('APP_NAME') }} </h4>
            <ul>

              <li>
                <a href="{{ Route('about') }}" class="relative inline-block mb-2 text-base leading-loose text-body-color group">
                  <span>About Us</span>
                  <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                </a>
              </li>
              <h4 class="mb-2 text-lg font-semibold text-gray-200">Legal</h4>
                <li>
                    <a href="{{ Route('terms') }}" class="relative inline-block mb-2 text-base leading-loose text-body-color group">
                        <span>Terms and Condition</span>
                        <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('privacy') }}" class="relative inline-block mb-2 text-base leading-loose text-body-color group">
                        <span>Privacy Policy</span>
                        <span class="absolute -bottom-0.5 left-0 w-0 h-0.5 bg-slate-100 transition-all group-hover:w-full"></span>
                    </a>
                </li>
              </ul>
        </div>
        <!-- Our Address / Div4 -->
          <div class="intro-x md:w-96">
            <h4 class="mb-2 text-lg font-semibold text-gray-200 intro-x">Our Address</h4>
                <p class="inline-block mb-2 text-base leading-loose text-gray-200">
                    {{ env('APP_ADDRESS') }}
                </p>
                <h4 class="mb-2 text-lg font-semibold text-center text-gray-200">Follow Us</h4>
                <div class="flex flex-row mx-auto justify-evenly">
                    <div class="flex justify-center flex-none px-1 hover:scale-125">
                        <a href="{{ url('https://www.instagram.com/godentalsph/') }}" class="">
                            <i class="text-4xl text-gray-700 fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <div class="flex justify-center flex-none hover:scale-125">
                        <a href="{{ url('https://www.facebook.com/GoDentals') }}" class="">
                            <i class="text-4xl text-gray-700 fa fa-facebook-f"></i>
                        </a>
                    </div>
                    <div class="flex justify-center flex-none hover:scale-125">
                        <a href="{{ url('https://twitter.com/GoDentals?t=QY7sxhxreDBsxUHKBwxEbA&s=09') }}" target="_blank" class="hover:text-primary">
                            <i class="text-4xl text-gray-700 fa-brands fa-twitter"></i>
                        </a>
                    </div>
                </div>
          </div>
      </div>
    </div>
</footer>

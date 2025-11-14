@php
    $usability = App\Models\Usability::find(1);
@endphp

  <div class="lonyo-section-padding bg-heading position-relative sectionn">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="lonyo-video-thumb">
            <img src="{{ asset($usability->image)}}" alt="">
            {{-- <img src="{{ asset('frontend/assets/images/v1/video-thumb.png')}}" alt=""> --}}
            <a class="play-btn video-init" href="{{ $usability->youtube }}">
            {{-- <a class="play-btn video-init" href="https://www.youtube.com/watch?v=fgZc7mAYIY8"> --}}
              <img src="{{ asset('frontend/assets/images/v1/play-icon.svg')}}" alt="">
              <div class="waves wave-1"></div>
              <div class="waves wave-2"></div>
              <div class="waves wave-3"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-7 d-flex align-items-center">
          <div class="lonyo-default-content lonyo-video-section pl-50" data-aos="fade-up" data-aos-duration="500">
            <h2>{{ $usability->title }}</h2>
            {{-- <h2>Its usability is simple and intuitive for users</h2> --}}
            <p>{{ $usability->description }}</p>
            {{-- <p>It's a cloud-based accounting tool ideal for individuals & businesses to easily manage finances, invoices & payroll. Unlock the 3-step path to enhanced financial control. </p> --}}
            <div class="mt-50" data-aos="fade-up" data-aos-duration="700">
              <a class="lonyo-default-btn video-btn" href="{{ $usability->link }}">Download the app</a>
            </div>
          </div>
        </div>
      </div>
      @php
          $connects = App\Models\Connect::limit(3)->get();
      @endphp
      <div class="row">
        @foreach ($connects as $connect)
        <div class="col-xl-4 col-md-6">
          <div class="lonyo-process-wrap" data-aos="fade-up" data-aos-duration="500">
            <div class="lonyo-process-number">
              <img src="{{ asset('frontend/assets/images/v1/n'. $connect->id .'.svg')}}" alt="">
            </div>
            <div class="lonyo-process-title">
              <h4 class="connect-title" contenteditable="{{ auth()->user() ? 'true' : 'false' }}"
                data-id="{{ $connect->id }}">{{ $connect->title }}</h4>
            </div>
            <div class="lonyo-process-data">
              <p class="connect-description" contenteditable="{{ auth()->user() ? 'true' : 'false' }}"
                data-id="{{ $connect->id }}">{{ $connect->description }}</p>
            </div>
          </div>
        </div>
        @endforeach

        {{-- <div class="col-xl-4 col-md-6">
          <div class="lonyo-process-wrap" data-aos="fade-up" data-aos-duration="700">
            <div class="lonyo-process-number">
              <img src="{{ asset('frontend/assets/images/v1/n2.svg')}}" alt="">
            </div>
            <div class="lonyo-process-title">
              <h4>Set Budgets & Goals</h4>
            </div>
            <div class="lonyo-process-data">
              <p>Define your spending limits and savings goals for categories like groceries, bills or future investments to stay on track.</p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="lonyo-process-wrap" data-aos="fade-up" data-aos-duration="900">
            <div class="lonyo-process-number">
              <img src="{{ asset('frontend/assets/images/v1/n3.svg')}}" alt="">
            </div>
            <div class="lonyo-process-title">
              <h4>Monitor & Automate</h4>
            </div>
            <div class="lonyo-process-data">
              <p>Check your financial dashboard for regular updates and set up automatic payments or savings to simplify management.</p>
            </div>
          </div>
        </div> --}}
        <div class="border-bottom" data-aos="fade-up" data-aos-duration="500"></div>
      </div>
    </div>
  </div>

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener("DOMContentLoaded", function () {

        function saveChanges(element) {
            let connectId = element.dataset.id;
            let field = element.classList.contains("connect-title") ? "title" : "description";
            let newValue = element.innerText.trim();
            console.log(newValue)

            fetch(`/update-connect/${connectId }`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    [field]: newValue
                })
            }).then(response => response.json())
                .then((data) => {
                    console.log(`${field} updated successfully`);
                })
                .catch(error => console.error('Error:', error));
        }

        // Auto save on enter Key
        document.addEventListener("keydown", function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                saveChanges(e.target);
            }
        })

        // Auto save on losing focus
        document.querySelectorAll(".connect-title, .connect-description").forEach(el => {
            el.addEventListener("blur", function() {
                saveChanges(el);
            }); 
        });
    });
</script>

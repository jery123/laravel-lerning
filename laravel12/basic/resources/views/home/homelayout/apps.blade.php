 @php
    $app = App\Models\App::find(1);
 @endphp

 <section class="lonyo-cta-section bg-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="lonyo-cta-thumb" data-aos="fade-up" data-aos-duration="500">
            <img id="appImage" src="{{ asset($app->image)}}" alt="" style="cursor: pointer; with: 100%; max-with:300px;">
            @if (auth()->check())
                <input type="file" id="uploadImage" style="">
            @endif
          </div>
        </div>
        <div class="col-lg-6">
          <div class="lonyo-default-content lonyo-cta-wrap" data-aos="fade-up" data-aos-duration="700">
            <h2 class="app-title" class="hero-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $app->id }}">{{ $app->title }}</h2>
            <p class="app-description" class="hero-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $app->id }}">{{ $app->description }}</p>
            <div class="lonyo-cta-info mt-50" data-aos="fade-up" data-aos-duration="900">
              <ul>
                <li>
                  <a href="https://www.apple.com/app-store/"><img src="{{ asset('frontend/assets/images/v1/app-store.svg') }}" alt=""></a>
                </li>
                <li>
                  <a href="https://playstore.com/"><img src="{{ asset('frontend/assets/images/v1/play-store.svg') }}" alt=""></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener("DOMContentLoaded", function () {

        function saveChanges(element) {
            let connectId = element.dataset.id;
            let field = element.classList.contains("app-title") ? "title" : "description";
            let newValue = element.innerText.trim();
            console.log(newValue)

            fetch(`/update-app/${connectId }`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    [field]: newValue
                })
            })
            .then(response => response.json())
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
        document.querySelectorAll(".app-title, .app-description").forEach(el => {
            el.addEventListener("blur", function() {
                saveChanges(el);
            });
        });

        // Image Uploaded function start
        let imageElement = document.getElementById("appImage");
        let uploadInput = document.getElementById("uploadImage");

        imageElement.addEventListener("click", function(){
            console.log("Cliked.....")
            @if (auth()->check())
                uploadInput.click();
            @endif
        });

        uploadInput.addEventListener("change", function(){
            console.log("Cliked.....")
            let file = this.files[0];

            if(!file) return;

            let formData = new FormData();
            formData.append("image", file);
            formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute("content"));

            fetch("/update-app-image/1", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data = >{
                if(data.success) {
                    imageElement.src = data.image_url;
                    console.log(`Image updated successfully`)
                }
            })
            .catch(error => console.error("Error: ", error));
        })
    });
</script>

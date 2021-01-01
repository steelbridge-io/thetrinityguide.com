<?php
  add_action('genesis_after_header', 'add_testimonial_carousel', 5);
  function add_testimonial_carousel()
  {
    if(is_front_page() || is_home()) {
      echo '
            <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                <div class="container narrow">
                <p class="text-center">“Alex is a professional at whatever he does. Fishing and hunting being number one. If there’s a fish to be caught, Alex will find it! He’s a pleasure to be around and knows how to make everyone’s day one to remember. Don’t hesitate to give him a call, and get out on the water with him. You won’t regret it.”</p>
                    <p class="text-center fw-bolder">Aaron Martin<br>
                    Fisheries Biologist, Trinity River</p>
                </div>
                </div>
                
                <div class="carousel-item">
                  <div class="container narow">
                  <p class="text-center">"We love fishing with Alex. He works really hard to find the fish and we\'ve caught a lot of them on our trips. What makes it really great is his beautiful comfortable boat (you can get out of the sun) and the great conversation. He\'s a serious fisherman, but a lot of fun too. We have a blast"</p>
                  </div>
                </div>
                
                <div class="carousel-item">
                <div class="container narow">
                <p class="text-center">"Alex is an amazing guide - we hit our limit on Kokanee and Browns each time we’ve been out with him and had a hell of a time doing it. Great conversations, lots of fun, and plenty of fish to bring home and smoke. The Trinity Guide Company boat was definitely the envy of the lake. Highly recommended to book a day with him, you won’t regret it."</p>
                <p class="text-center fw-bolder">
                Matt RyderSan Francisco, CA
                </p>
                </div>
                </div>
              </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-2x fa-chevron-left"></i></span>
            <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-2x fa-chevron-right"></i></span>
            <span class="visually-hidden">Next</span>
            </a>
            </div>
           ';
    }
  }

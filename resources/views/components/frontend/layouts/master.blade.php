<!DOCTYPE html>
<html>
    <x-frontend.layouts.partials.css/>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <x-frontend.layouts.partials.header/>
         <!-- end header section -->
         <!-- slider section -->
      {{ $slot }}
      <!-- end client section -->
      <!-- footer start -->
      <x-frontend.layouts.partials.footer/>
       
      <!-- jQery -->
      <x-frontend.layouts.partials.js/>
   </body>
</html>
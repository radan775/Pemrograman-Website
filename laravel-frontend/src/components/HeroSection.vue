<template>
    <section class="hero">
      <div class="hero-content">
        <div class="hero-text">
          <h5>#Coffee for hot days</h5>
          <h1>- Caramel</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit euismod leo nec tincidunt. Ut porta facilisis diam nec condimentum. Nulla facilisi. Vestibulum ultricies eros lectus, eu vulputate dolor gravida.</p>
          <div class="main-hero">
            <a href="#" class="btn">Order Now</a>
            <a href="#" class="price">Rp16.000<span>Reguler price</span></a>
          </div>
        </div>
        <div class="hero-img">
          <img src="../assets/hero.png">
        </div>
      </div>
    </section>
</template>
  
  
  <script>
  export default {
    name: 'HeroSection'
  }
  </script>
  
  
  <style scoped>
  .hero-text {
    text-align: left;
  }
  
  
  .hero-text h5 {
    text-align: left;
  }
  
  
  .hero-text h1 {
    text-align: left;
  }
  
  
  .hero-text p {
    text-align: left;
    margin-left: 0;
    padding-right: 50px; /* Tambahkan sedikit padding agar teks tidak terlalu dekat dengan tepi */
  }
  
  
  .main-hero {
    justify-content: flex-start;
  }
  </style>
<template>
  <div id="app">
    <TheHeader :class="{ scrolled: scrollPosition > 0 }" />
    <HeroSection />
    <ProductList />
    <TheFooter />
  </div>
</template>


<script>
import TheHeader from './components/TheHeader.vue'
import HeroSection from './components/HeroSection.vue'
import ProductList from './components/ProductList.vue'
import TheFooter from './components/TheFooter.vue'


export default {
  name: 'App',
  components: {
    TheHeader,
    HeroSection,
    ProductList,
    TheFooter
  },
  data() {
    return {
      scrollPosition: 0
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.scrollPosition = window.scrollY;
    }
  }
}
</script>


<style>


*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    font-family: "Roboto", sans-serif;
}

:root {
    --bg-color: #0c0c0c;
    --text-color: #fff;
    --main-color: #ae8957;

    --big-font: 6.6rem;
    --p-font: 1rem;
}

body{
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
}


header {
    position: fixed;
    width: 100%;
    top: 0;
    right: 0;
    z-index: 1000;
    padding: 35px 7%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all .50s ease;
    background: transparent;
}

header.scrolled {
    background: rgba(0, 0, 0, 0.7); /* Warna hitam transparan saat di-scroll */
    backdrop-filter: blur(10px); /* Efek blur */
}

.logo img{
    width: 100%;
    height: auto;
}

.navlist{
    display: flex;
}

.navlist a{
    display: inline-block;
    margin: 0 35px;
    color: var(--text-color);
    font-size: var(--p-font);
    transition: all .6s ease;
}

.navlist a:hover{
    color: var(--main-color);
}

.right-content{
    display: flex;
    align-items: center;
}

.nav-btn{
    display: inline-block;
    padding: 9px 24px;
    background: transparent;
    border: 2px solid var(--text-color);
    border-radius: 7px;
    color: var(--text-color);
    font-size: 15px;
    font-weight: 500;
    transition: all .6s ease;
}

.nav-btn:hover{
    transform: translateY(-5px);
    border: 2px solid var(--main-color);
    color: var(--main-color);
}

section{
    padding: 0 14%;
}

.hero {
    position: relative;
    width: 100vw;
    height: 100vh;
    background: url('./assets/bg.png') no-repeat center top;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}


.hero-content {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    align-items: center;
    gap: 2rem;
    width: 100%;
    max-width: 1200px; /* Sesuaikan dengan lebar maksimum yang diinginkan */
    padding: 0 5%; /* Tambahkan padding horizontal */
}

.hero-img img {
    width: 100%;
    height: auto;
}

.hero-text h1{
    font-size: var(--big-font);
    font-weight: 900;
    margin: 15px 0;
}

.hero-text h5{
    font-size: 18px;
    font-weight: 400;
    letter-spacing: 1px;
}

.main-hero{
    display: flex;
    align-items: center;
}

.btn{
    display: inline-block;
    padding: 13px 32px;
    background: var(--main-color);
    border: 2px solid transparent;
    border-radius: 7px;
    color: var(--text-color);
    font-size: 15px;
    font-weight: 500;
    transition: all .6s ease;
    margin-right: 20px;
}

.btn:hover{
    transform: scale(1.1);
}

.price{
    display: flex;
    align-items: center;
    font-size: 28px;
    font-weight: bold;
    color: var(--text-color);
}

.price span{
    font-size: 17px;
    font-weight: 400;
    color: var(--main-color);
    margin-left: 10px;
}

.price span:hover{
    color: var(--text-color);
}

footer{
    text-align: center;
    width: 100%;
}

footer a{
    display: inline-block;
    margin-bottom: 2px;
    color: var(--text-color);
    font-size: var(--p-font);
}

footer a:hover{
    color: var(--main-color);
}

footer p{
    color: var(--main-color);
    font-size: 20px;
}

#product-list {
    padding: 50px 20px;
    background-color: #1a1a1a;
    text-align: center;
    color: var(--text-color);
}

#product-list h2 {
    font-size: 2.5rem;
    margin-bottom: 30px;
    color: var(--main-color);
}

.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-items: center;
}

.product-card {
    background: #333;
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    width: 250px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    margin-bottom: 15px;
    border-radius: 10px;
}

.product-card h3 {
    font-size: 1.2rem;
    margin: 10px 0;
}

.product-card p {
    font-size: 1rem;
    color: var(--main-color);
    margin: 5px 0 15px;
}

.product-card button {
    padding: 10px 20px;
    background: var(--main-color);
    color: var(--text-color);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.product-card button:hover {
    background: #bf7c4d;
    transform: scale(1.1);
}

#add-product-btn {
    margin-top: 20px;
    padding: 12px 24px;
    background-color: var(--main-color);
    color: var(--text-color);
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

#add-product-btn:hover {
    background-color: #bf7c4d;
    transform: scale(1.05);
}

.edit-btn {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.edit-btn:hover {
    background-color: #45a049;
    transform: scale(1.1);
}

</style>
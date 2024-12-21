<template>
  <header>
    <a href="#" class="logo">
      <img src="../assets/logo.png">
    </a>
    <ul class="navlist">
      <li><a href="#">About</a></li>
      <li><a href="#">Membership</a></li>
      <li><a href="#">Events</a></li>
    </ul>
    <div class="right-content">
      <div class="cart-icon" @click="toggleCartSidebar">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count">{{ cartItemCount }}</span>
      </div>
    </div>


    <!-- Cart Sidebar -->
    <div :class="['cart-sidebar', { 'open': isCartSidebarOpen }]">
      <div class="cart-header">
        <h3>Keranjang</h3>
        <button @click="toggleCartSidebar" class="close-cart">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="cart-items">
        <div v-for="item in cartItems" :key="item.id" class="cart-item">
          <img :src="item.image_url" :alt="item.nama_product">
          <div class="cart-item-details">
            <h4>{{ item.nama_product }}</h4>
            <p>Rp{{ item.harga_product.toLocaleString() }}</p>
            <div class="cart-item-actions">
              <button @click="decreaseQuantity(item)">-</button>
              <span>{{ item.quantity }}</span>
              <button @click="increaseQuantity(item)">+</button>
              <button @click="removeFromCart(item)" class="remove-btn">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="cart-total">
        <p>Total: Rp{{ calculateTotal().toLocaleString() }}</p>
        <button class="checkout-btn">Checkout</button>
      </div>
    </div>
  </header>
</template>


<script>
import axios from 'axios'


export default {
  name: 'TheHeader',
  data() {
    return {
      isCartSidebarOpen: false,
      cartItems: [],
      cartItemCount: 0,
      productItems: []
    }
  },
  methods: {
    toggleCartSidebar() {
      this.isCartSidebarOpen = !this.isCartSidebarOpen
      if (this.isCartSidebarOpen) {
        this.fetchCartItems()
      }
    },
    async fetchCartItems() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/carts')
        this.cartItems = response.data.data.data.map(item => ({
          ...item,
          quantity: item.stok_product 
        }))
        const responseProducts = await axios.get('http://127.0.0.1:8000/api/products')
        this.productItems = responseProducts.data.data.data.map(item => ({
          ...item,
          quantity: item.stok_product 
        }))
        this.cartItemCount = this.cartItems.length
      } catch (error) {
        console.error('Error fetching cart items:', error)
      }
    },
    async increaseQuantity(item) {
      try {
        if (item.quantity < 100) {
          item.quantity += 1
          await axios.put(`http://127.0.0.1:8000/api/carts/${item.id}`, {
            quantity: item.quantity
          })
        } else {
          alert('Stok produk tidak mencukupi')
        }
      } catch (error) {
        console.error('Error increasing quantity:', error)
      }
    },
    async decreaseQuantity(item) {
      try {
        if (item.quantity > 1) {
          item.quantity -= 1
          await axios.put(`http://127.0.0.1:8000/api/carts/${item.id}`, {
            quantity: item.quantity
          })
        } else {
          await this.removeFromCart(item)
        }
      } catch (error) {
        console.error('Error decreasing quantity:', error)
      }
    },
    async removeFromCart(item) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/carts/${item.id}`)
        this.cartItems = this.cartItems.filter(cartItem => cartItem.id !== item.id)
        this.cartItemCount = this.cartItems.length
      } catch (error) {
        console.error('Error removing from cart:', error)
      }
    },
    calculateTotal() {
      return this.cartItems.reduce((total, item) => {
        return total + (item.harga_product * item.quantity)
      }, 0)
    }
  }
}
</script>


<style scoped>
.cart-icon {
  position: relative;
  cursor: pointer;
  color: var(--text-color);
  font-size: 1.5rem;
}


.cart-count {
  position: absolute;
  top: -10px;
  right: -10px;
  background-color: var(--main-color);
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.7rem;
}


.cart-sidebar {
  position: fixed;
  top: 0;
  right: -400px;
  width: 400px;
  height: 100%;
  background-color: #2a2a2a;
  transition: right 0.3s ease;
  z-index: 2000;
  color: var(--text-color);
  padding: 20px;
  box-shadow: -2px 0 5px rgba(0,0,0,0.5);
}


.cart-sidebar.open {
  right: 0;
}


.cart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}


.close-cart {
  background: none;
  border: none;
  color: var(--text-color);
  font-size: 1.5rem;
  cursor: pointer;
}


.cart-item {
  display: flex;
  margin-bottom: 15px;
  border-bottom: 1px solid #444;
  padding-bottom: 15px;
}


.cart-item img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  margin-right: 15px;
}


.cart-item-details {
  flex-grow: 1;
}


.cart-item-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
}


.cart-item-actions button {
  background-color: var(--main-color);
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}


.remove-btn {
  background-color: #ff4d4d !important;
}


.cart-total {
  position: absolute;
  bottom: 20px;
  left: 20px;
  right: 20px;
}


.checkout-btn {
  width: 100%;
  padding: 10px;
  background-color: var(--main-color);
  color: white;
  border: none;
  border-radius: 5px;
  margin-top: 10px;
  cursor: pointer;
}
</style>
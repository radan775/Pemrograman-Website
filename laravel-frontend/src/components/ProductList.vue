<template>
  <section id="product-list">
    <div class="product-list-content">
      <h2>Our Coffee Products</h2>
      <div class="product-container">
        <ProductCard 
          v-for="product in products" 
          :key="product.id" 
          :product="product" 
          @delete="deleteProduct"
          @edit="openEditProductModal"
          @order="orderNow"
        />
      </div>
      <button @click="showAddProductModal" class="add-product-btn">
        <i class="fas fa-plus"></i> Add New Product
      </button>


      <!-- Modal Tambah Produk -->
      <div v-if="isAddProductModalVisible" class="modal-overlay">
        <div class="modal-content">
          <h3>Add New Product</h3>
          <form @submit.prevent="addProduct">
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input 
                type="text" 
                id="productName" 
                v-model="newProduct.nama_product" 
                required
              >
            </div>
            <div class="form-group">
              <label for="productPrice">Price</label>
              <input 
                type="number" 
                id="productPrice" 
                v-model="newProduct.harga_product" 
                required
              >
            </div>
            <div class="form-group">
              <label for="productStock">Stock</label>
              <input 
                type="number" 
                id="productStock" 
                v-model="newProduct.stok_product" 
                required
                min="0"
              >
            </div>
            <div class="form-group">
              <label for="productImage">Image URL</label>
              <input 
                type="text" 
                id="productImage" 
                v-model="newProduct.image_url"
                placeholder="Enter image URL"
              >
            </div>
            <div class="modal-actions">
              <button type="button" class="btn-cancel" @click="closeAddProductModal">Cancel</button>
              <button type="submit" class="btn-submit">Add Product</button>
            </div>
          </form>
        </div>
      </div>


      <!-- Modal Edit Produk -->
      <div v-if="isEditProductModalVisible" class="modal-overlay">
        <div class="modal-content">
          <h3>Edit Product</h3>
          <form @submit.prevent="updateProduct">
            <div class="form-group">
              <label for="editProductName">Product Name</label>
              <input 
                type="text" 
                id="editProductName" 
                v-model="editProduct.nama_product" 
                required
              >
            </div>
            <div class="form-group">
              <label for="editProductPrice">Price</label>
              <input 
                type="number" 
                id="editProductPrice" 
                v-model="editProduct.harga_product" 
                required
                min="0"
              >
            </div>
            <div class="form-group">
              <label for="editProductStock">Stock</label>
              <input 
                type="number" 
                id="editProductStock" 
                v-model="editProduct.stok_product" 
                required
                min="0"
              >
            </div>
            <div class="form-group">
              <label for="editProductImage">Image URL</label>
              <input 
                type="text" 
                id="editProductImage" 
                v-model="editProduct.image_url"
                placeholder="Enter image URL"
              >
            </div>
            <div class="modal-actions">
              <button type="button" class="btn-cancel" @click="closeEditProductModal">Cancel</button>
              <button type="submit" class="btn-submit">Update Product</button>
            </div>
          </form>
        </div>
      </div>


      <!-- Modal Konfirmasi Hapus -->
      <div v-if="confirmDeleteModal.show" class="modal-overlay">
        <div class="modal-content">
          <h3>Confirm Delete</h3>
          <p>Are you sure you want to delete product with ID {{ confirmDeleteModal.id }}?</p>
          <div class="modal-actions">
            <button class="btn-cancel" @click="cancelDelete">Cancel</button>
            <button class="btn-submit" @click="confirmDelete">Delete</button>
          </div>
        </div>
      </div>


      <!-- Modal Notifikasi -->
      <div v-if="notificationModal.show" class="modal-overlay">
        <div class="modal-content">
          <h3>{{ notificationModal.type === 'success' ? 'Success' : 'Error' }}</h3>
          <p>{{ notificationModal.message }}</p>
          <div class="modal-actions">
            <button class="btn-submit" @click="closeNotification">OK</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
import ProductCard from './ProductCard.vue'
import axios from 'axios'


export default {
  name: 'ProductList',
  components: {
    ProductCard
  },
  data() {
    return {
      products: [],
      baseUrl: 'http://127.0.0.1',
      isAddProductModalVisible: false,
      isEditProductModalVisible: false, // State untuk modal edit
      newProduct: {
        nama_product: '',
        harga_product: 0,
        stok_product: 0,
        image_url: 'img/default.jpg'
      },
      editProduct: { // Data untuk produk yang sedang diedit
        id: null,
        nama_product: '',
        harga_product: 0,
        stok_product: 0,
        image_url: ''
      },
      confirmDeleteModal: {
        show: false,
        id: null
      },
      notificationModal: {
        show: false,
        type: 'success',
        message: ''
      }
    }
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get(`${this.baseUrl}/app/main.php/products`)
        if (response.data.status === 200) {
          this.products = response.data.data
        }
      } catch (error) {
        console.error('Error fetching products:', error)
      }
    },


    showAddProductModal() {
      this.newProduct = {
        nama_product: '',
        harga_product: 0,
        stok_product: 0,
        image_url: 'img/default.jpg'
      }
      this.isAddProductModalVisible = true
    },


    closeAddProductModal() {
      this.isAddProductModalVisible = false
    },


    async addProduct() {
      try {
        const response = await axios.post(`${this.baseUrl}/app/main.php/products`, this.newProduct)
        if (response.data.status === 201) {
          this.notificationModal = {
            show: true,
            type: 'success',
            message: response.data.message
          }
          this.fetchProducts()
          this.closeAddProductModal()
        }
      } catch (error) {
        console.error('Error adding product:', error)
      }
    },


    openEditProductModal(product) {
      this.editProduct = { ...product } // Populate form with selected product data
      this.isEditProductModalVisible = true // Show the edit modal
    },


    closeEditProductModal() {
      this.isEditProductModalVisible = false
      this.editProduct = { // Reset edit product data
        id: null,
        nama_product: '',
        harga_product: 0,
        stok_product: 0,
        image_url: ''
      }
    },


    async updateProduct() {
      try {
        const response = await axios.put(`${this.baseUrl}/app/main.php/products/${this.editProduct.id}`, this.editProduct)
        if (response.data.status === 200) {
          this.notificationModal = {
            show: true,
            type: 'success',
            message: response.data.message
          }
          this.fetchProducts()
          this.closeEditProductModal()
        }
      } catch (error) {
        this.notificationModal = {
          show: true,
          type: 'error',
          message: 'Failed to update product'
        }
        console.error('Error updating product:', error)
      }
    },


    async deleteProduct(id) {
      this.confirmDeleteModal = {
        show: true,
        id: id
      }
    },


    cancelDelete() {
      this.confirmDeleteModal = {
        show: false,
        id: null
      }
    },


    async confirmDelete() {
      const id = this.confirmDeleteModal.id
      this.confirmDeleteModal = {
        show: false,
        id: null
      }


      try {
        const response = await axios.delete(`${this.baseUrl}/app/main.php/products/${id}`)
        if (response.data.status === 200) {
          this.notificationModal = {
            show: true,
            type: 'success',
            message: response.data.message
          }
          this.fetchProducts()
        }
      } catch (error) {
        this.notificationModal = {
          show: true,
          type: 'error',
          message: 'Failed to delete product'
        }
        console.error('Error deleting product:', error)
      }
    },


    closeNotification() {
      this.notificationModal = {
        show: false,
        type: 'success',
        message: ''
      }
    },



  async orderNow(product) {
  try {
    await this.addToCart(product)
  } catch (error) {
    console.error('Order failed:', error.response ? error.response.data : error)
    this.notificationModal = {
      show: true,
      type: 'error',
      message: this.getErrorMessage(error)
    }
  }
},


async addToCart(product) {
  try {
    // Pastikan semua field yang diperlukan ada
    const cartData = {
      nama_product: product.nama_product,
      harga_product: product.harga_product,
      stok_product: 1,
      image_url: product.image_url
    }


    // Tambahkan validasi sederhana
    if (!cartData.nama_product) {
      throw new Error('Nama produk tidak boleh kosong')
    }


    const response = await axios.post('http://127.0.0.1:8000/api/carts', cartData)
    
    if (response.data.success) {
      // Tampilkan notifikasi sukses
      this.notificationModal = {
        show: true,
        type: 'success',
        message: 'Produk berhasil ditambahkan ke keranjang'
      }
      
      // Trigger update keranjang
      this.updateCartCount()
    }
  } catch (error) {
    // Log error untuk debugging
    console.error('Detailed error:', error)


    // Lempar error untuk ditangani di pemanggil
    throw error
  }
},


// Metode tambahan untuk menerjemahkan error
getErrorMessage(error) {
  // Cek apakah ada respons dari server
  if (error.response) {
    // Cek status error
    switch (error.response.status) {
      case 422:
        // Validasi gagal, coba ambil pesan spesifik dari server
        return error.response.data.message || 'Data tidak valid'
      case 500:
        return 'Kesalahan server internal'
      case 404:
        return 'Endpoint tidak ditemukan'
      default:
        return 'Gagal menambahkan produk ke keranjang'
    }
  } else if (error.request) {
    // Request dibuat tapi tidak ada respons
    return 'Tidak ada respons dari server'
  } else {
    // Kesalahan lain
    return error.message || 'Gagal menambahkan produk ke keranjang'
  }
},


updateCartCount() {
  // Pastikan metode ini ada di komponen
  // Atau gunakan event bus/state management
  try {
    // Misalnya, panggil metode di header untuk refresh cart
    this.$root.$emit('update-cart-count')
  } catch (error) {
    console.error('Gagal memperbarui hitungan keranjang:', error)
  }
}



  },
  mounted() {
    this.fetchProducts()
  }
}
</script>


<style scoped>
/* Styling modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}


.modal-content {
  background: #2a2a2a;
  padding: 30px;
  border-radius: 10px;
  width: 100%;
  max-width: 500px;
  color: var(--text-color);
}


.modal-content h3 {
  text-align: center;
  margin-bottom: 20px;
  color: var(--main-color);
}


.modal-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}


.form-group {
  margin-bottom: 15px;
}


.form-group label {
  display: block;
  margin-bottom: 5px;
  color: var(--text-color);
}


.form-group input {
  width: 100%;
  padding: 10px;
  background: #333;
  border: 1px solid #444;
  border-radius: 5px;
  color: var(--text-color);
}


.btn-cancel, .btn-submit {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
}


.btn-cancel {
  background: #555;
  color: var(--text-color);
}


.btn-submit {
  background: var(--main-color);
  color: var(--text-color);
}


.btn-cancel:hover {
  background: #666;
}


.btn-submit:hover {
  background: #bf7c4d;
}


#product-list {
  background-color: #1a1a1a;
  padding: 80px 0;
  width: 100vw;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
  box-sizing: border-box; 
}


.product-list-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}


#product-list h2 {
  font-size: 3rem;
  color: var(--main-color);
  text-align: center;
  margin-bottom: 50px;
  position: relative;
}


.product-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
  justify-content: center;
}


.add-product-btn {
  display: block;
  margin: 40px auto 0;
  padding: 15px 30px;
  background-color: var(--main-color);
  color: var(--text-color);
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}


.add-product-btn:hover {
  background-color: #bf7c4d;
  transform: scale(1.05);
}


.add-product-btn i {
  font-size: 1.2rem;
}


@media (max-width: 768px) {
  .product-container {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
  }


  #product-list h2 {
    font-size: 2.5rem;
  }
}
</style>
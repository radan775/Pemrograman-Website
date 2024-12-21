<template>
  <div class="product-card">
    <img :src="product.image_url" :alt="product.nama_product">
    <h3>{{ product.nama_product }}</h3>
    <p>Rp{{ product.harga_product.toLocaleString() }}</p>
    <p>Stock: {{ product.stok_product }}</p>
    <div class="card-buttons">
      <button @click="$emit('order', product)">Order Now</button>
      <button @click="$emit('delete', product.id)" class="delete-btn">Delete</button>
      <button @click="$emit('edit', product)" class="edit-btn">Edit</button>
    </div>
  </div>
</template>


<script>
export default {
  name: 'ProductCard',
  props: {
    product: {
      type: Object,
      required: true
    }
  }
}
</script>


<style scoped>
.product-card {
  background-color: #2a2a2a;
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  transition: transform 0.3s ease;
}


.product-card:hover {
  transform: scale(1.05);
}


.product-card img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 15px;
}


.product-card h3 {
  color: var(--main-color);
  margin-bottom: 10px;
}


.product-card p {
  color: var(--text-color);
  margin-bottom: 15px;
}


.card-buttons {
  display: flex;
  justify-content: space-between;
  gap: 10px;
}


.card-buttons button {
  flex: 1;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}


.card-buttons button:first-child {
  background-color: var(--main-color);
  color: var(--text-color);
}


.delete-btn {
  background-color: #ff4d4d;
  color: white;
}


.edit-btn {
  background-color: #4CAF50;
  color: white;
}


.card-buttons button:hover {
  opacity: 0.9;
}
</style>
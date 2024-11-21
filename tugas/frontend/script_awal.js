
const products = [
    { name: "Espresso", price: "Rp20.000", image: "img/products/espresso.png" },
    { name: "Latte", price: "Rp25.000", image: "img/products/latte.png" },
    { name: "Cappuccino", price: "Rp22.000", image: "img/products/cappuccino.png" },
    { name: "Mocha", price: "Rp28.000", image: "img/products/mocha.png" }
];

// Menampilkan produk ke dalam container
const container = document.querySelector('.product-container');
const displayProducts = () => {
    container.innerHTML = ''; // Bersihkan container sebelum render
    products.forEach((product, index) => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>${product.price}</p>
            <div class="card-buttons">
                <button onclick="orderNow('${product.name}')">Order Now</button>
                <button onclick="deleteProduct(${index})" class="delete-btn">Delete</button>
                <button onclick="editProduct(${index})" class="edit-btn">Edit</button>
            </div>
        `;
        container.appendChild(card);
    });
};

// Fungsi untuk menghapus produk
function deleteProduct(index) {
    const confirmDelete = confirm(`Are you sure you want to delete ${products[index].name}?`);
    if (confirmDelete) {
        products.splice(index, 1); // Hapus produk berdasarkan indeks
        displayProducts(); // Render ulang daftar produk
    }
}

function editProduct(index) {
    const product = products[index];
    const newName = prompt("Edit product name:", product.name) || product.name;
    const newPrice = prompt("Edit product price:", product.price) || product.price;
    const newImage = prompt("Edit product image URL:", product.image) || product.image;

    // Perbarui produk dengan data baru
    products[index] = { name: newName, price: newPrice, image: newImage };
    displayProducts(); // Render ulang daftar produk
}

displayProducts();

// Fungsi untuk tombol Order Now
function orderNow(productName) {
    alert(`You have selected: ${productName}. Proceed to checkout!`);
}

// Tambahkan produk baru
const addProductBtn = document.getElementById('add-product-btn');
addProductBtn.addEventListener('click', () => {
    const newProduct = {
        name: prompt("Masukkan nama produk:") || "Produk Baru",
        price: prompt("Masukkan harga produk:") || "Rp0",
        image: prompt("Masukkan URL gambar produk:") || "img/default.jpg"
    };
    products.push(newProduct);
    displayProducts(); // Render ulang daftar produk
});

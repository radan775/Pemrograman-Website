function submitForm(event){
    event.preventDefault();
    var nama = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var alamat = document.getElementById('alamat').value;

    if (nama === '' || email === '' || alamat === ''){
        alert("Tidak boleh ada data yang kosong");
    } else {
        alert("Oke")
    }
}
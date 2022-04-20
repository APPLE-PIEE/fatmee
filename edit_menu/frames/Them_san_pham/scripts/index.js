function cancleInfo() {
    alert("Bạn chắc chắn muốn huỷ ?")
}

function saveInfo() {
    const SanPham = {
        name: document.getElementById("name").value,
        img: document.getElementById("img").value,
        money: document.getElementById("money1").value,
    }
    var x = SanPham;
    if (x.name == "") {
        document.getElementById("mon_an").innerHTML = "Vui lòng nhập tên sản phẩm";
        document.getElementById("name").style.borderColor = "red"
    } else if (x.img == "") {
        document.getElementById("img_error").innerHTML = "Vui lòng thêm hình ảnh";
    } else if (x.money == "") {
        document.getElementById("idMoney").innerHTML = "Vui lòng nhập giá tiền";
        document.getElementById("money1").style.borderColor = "red"
    } else alert("Lưu thành công")
}
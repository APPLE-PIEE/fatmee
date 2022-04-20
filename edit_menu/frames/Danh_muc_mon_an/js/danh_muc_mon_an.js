function add_danh_muc() {
    location.href = "Them_danh_muc/them_danh_muc.php";
}

function del() {
    if (confirm("Danh mục bạn chọn có chứa món ăn, bạn chắc chắn muốn xoá ?")) {
        alert("Xoá thành công");
    } else {
        alert("Đã huỷ");
    }
    // document.getElementById("demo").innerHTML = txt;
}
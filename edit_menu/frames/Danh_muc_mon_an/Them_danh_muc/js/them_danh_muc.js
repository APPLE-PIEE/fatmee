function cancle(){
    location.href ="/edit_menu/frames/Danh_muc_mon_an/danh_muc_mon_an.html";
}
function save(){
    const danh_muc ={
        name: document.getElementById("name").value,
        descript :document.getElementById("descript").value,
        time : document.getElementById("date").value,
    };
    var x = danh_muc;
    if(x.name == ""){
        document.getElementById("show_error").innerHTML = "Vui lòng nhập tên danh mục";
        document.getElementById("name").style.borderColor = "red";
    }
    else if(x.descript == ""){
        document.getElementById("content_error").innerHTML = "Vui lòng nhập nội dung danh mục";
        document.getElementById("descript").style.borderColor = "red";
    }
    else if(x.time == ""){
        document.getElementById("error").innerHTML = "Vui lòng chọn thời gian";
        document.getElementById("date").style.borderColor = "red";
    }
    else alert("Lưu thành công");

}
const addCustom = {
    code: document.getElementById("code").value,
    name: document.getElementById("name").value,
    date: document.getElementById("time").value,
    local: document.getElementById("local").value,
    email: document.getElementById("email").value,
    phone: document.getElementById("phone").value,
};
function save(){
    var x = addCustom;
    if (x.code == ""){}
}
function cancle(){
    var text ;
    if(confirm("Bạn chắc chắn muốnn huỷ ?")){
        location.href ="/edit_menu/frames/Khach_hang/khach_hang.html";
    }
    else{
        text = "Bạn huỷ thành công";        
    }
}
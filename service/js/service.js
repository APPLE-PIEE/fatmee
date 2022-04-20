function change(){
    let name = document.getElementById("changeOne");
    if(name.value =="Chọn gói STANDARD"){
        name.value = "Đã chọn";
    }
    else {
        name.value ="Chọn gói STANDARD"
    }
}
function change1(){
    let name = document.getElementById("changeTwo");
    if(name.value =="Chọn gói VIP"){
        name.value = "Đã chọn";
    }
    else {
        name.value ="Chọn gói VIP"
    }
}
function change2(){
    let name = document.getElementById("changeThree");
    if(name.value =="Chọn gói SUPER VIP"){
        name.value = "Đã chọn";
    }
    else {
        name.value ="Chọn gói SUPER VIP"
    }
}
function submit(){
    const info = {
        time : document.getElementById('time'),
        location : document.getElementById('location'),
        cus : document.getElementById('numCus'),
        desk : document.getElementById('numDesk'),
        showTime: document.getElementById('showTime'),
        showLocation: document.getElementById('showLcation'),
        showCus: document.getElementById('showCus'),
        showDesk: document.getElementById('showDesk'),

    };
    var x = info;
    if(x.time.value == ""){
        x.location.style = "border: 1px solid black;"
        x.desk.style = "border: 1px solid black;"
        x.cus.style = "border: 1px solid black;"
        x.showLocation.innerHTML = ""
        x.showCus.innerHTML = ""
        x.showDesk.innerHTML = ""

        x.showTime.innerHTML = "Vui lòng điền thời gian"
        x.showTime.style ="color: red; margin-left: 1rem; margin-top: 5px;"
        x.time.style = "border: 1px solid red;"
        alert("Bạn chưa chọn thời gian bắt đầu")
    }
    else if(x.location.value == ""){
        x.time.style = "border: 1px solid black;"
        x.desk.style = "border: 1px solid black;"
        x.cus.style = "border: 1px solid black;"
        x.showTime.innerHTML = ""
        x.showCus.innerHTML = ""
        x.showDesk.innerHTML = ""
        x.showLocation.innerHTML = "Vui lòng nhập địa chỉ"
        x.showLocation.style ="color: red; margin-left: 1rem; margin-top: 5px;"
        x.location.style = "border: 1px solid red;"
        alert("Bạn chưa nhập địa chỉ")
    }
    else if(x.cus.value == ""){
        x.time.style = "border: 1px solid black;"
        x.desk.style = "border: 1px solid black;"
        x.location.style = "border: 1px solid black;"
        x.showTime.innerHTML = ""
        x.showLocation.innerHTML = ""
        x.showDesk.innerHTML = ""

        x.showCus.innerHTML = "Vui lòng nhập số khách tham dự"
        x.showCus.style ="color: red; margin-left: 1rem; margin-top: 5px;"
        x.cus.style = "border: 1px solid red;"
        alert("Bạn chưa nhập số khách tham dự")
    }
    else if(x.desk.value == ""){
        x.time.style = "border: 1px solid black;"
        x.cus.style = "border: 1px solid black;"
        x.location.style = "border: 1px solid black;"
        x.showTime.innerHTML = ""
        x.showLocation.innerHTML = ""
        x.showCus.innerHTML = ""

        x.showDesk.innerHTML = "Vui lòng điền số bàn"
        x.showDesk.style ="color: red; margin-left: 1rem; margin-top: 5px;"
        x.desk.style = "border: 1px solid red;"
        alert("Bạn chưa nhập số bàn")
    }
    else{
        alert("Xác nhận thành công")
        location.href="../../../TongcongtyFATme/main-page/index.php";
    }
}
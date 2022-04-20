function openMore(khach_hang) {
    var i;
    var x = document.getElementsByClassName("more");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    document.getElementById(khach_hang).style.display = "block";  
  }

// function save(){

// }
// function cancle(){
//   location.href
// }
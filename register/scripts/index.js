//click icon to show password
function showPassword(id, el) {
    let x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
        el.className = "fas fa-eye-slash showpwd";
    } else {
        x.type = "password";
        el.className = "fas fa-eye showpwd";
    }
}
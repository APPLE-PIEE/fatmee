const inputElements = [...document.querySelectorAll("input.input-code")];

inputElements.forEach((ele, index) => {
  ele.addEventListener("keydown", (e) => {
    if (e.keyCode === 8 && e.target.value === "") inputElements[Math.max(0, index - 1)].focus();
  });
  ele.addEventListener("input", (e) => {
    const [first, ...rest] = e.target.value;
    e.target.value = first ?? "";
    if (index !== inputElements.length - 1 && first !== undefined) {
      inputElements[index + 1].focus();
      inputElements[index + 1].value = rest.join("");
      inputElements[index + 1].dispatchEvent(new Event("input"));
    }
  });
});
function onSubmit(e) {
  e.preventDefault();
  const code = [...document.getElementsByClassName("input-code")]
    .filter(({ name }) => name)
    .map(({ value }) => value)
    .join("");
  console.log(code);
}
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
//kiểm tra mật khẩu trùng khớp
function checkPassword(password, confirmPassword) {
  if (password != confirmPassword) {
    document.getElementsByClassName("error").innerHTML = "Mật khẩu không trùng khớp";
    return false;
  } else {
    document.getElementsByClassName("error").innerHTML = "";
    return true;
  }
}
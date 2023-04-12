function showPass() {
    var x = document.getElementsByClassName("password")[0];
    if (x.type === "password") {
        x.type = "text";
        var eye = document.getElementsByClassName("fa-eye")[0];
        eye.classList.toggle("fa-eye-slash");
    } else {
        x.type = "password";
        var eye = document.getElementsByClassName("fa-eye-slash")[0];
        eye.classList.toggle("fa-eye");
    }
}

function showPass2() {
    var x = document.getElementsByClassName("password")[1];
    var y = document.getElementsByClassName("password")[0];
    if (y.type === "password") {
        if (x.type === "password") {
            x.type = "text";
            var eye = document.getElementsByClassName("fa-eye")[1];
            eye.classList.toggle("fa-eye-slash");
        } else {
            x.type = "password";
            var eye = document.getElementsByClassName("fa-eye-slash")[0];
            eye.classList.toggle("fa-eye");
        }
    } else if (y.type === "text") {
        if (x.type === "password") {
            x.type = "text";
            var eye = document.getElementsByClassName("fa-eye")[1];
            eye.classList.toggle("fa-eye-slash");
        } else {
            x.type = "password";
            var eye = document.getElementsByClassName("fa-eye-slash")[0];
            eye.classList.toggle("fa-eye");
        }
    }
}
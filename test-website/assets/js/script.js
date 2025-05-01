document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        const nameInput = document.getElementById("name").value.trim();
        if (nameInput.length < 3) {
            event.preventDefault();
            alert("名字需至少包含3個字符");
        }
    });
});

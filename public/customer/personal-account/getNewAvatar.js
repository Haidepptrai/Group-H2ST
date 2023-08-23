document.addEventListener("DOMContentLoaded", function() {
    const avatarInput = document.getElementById("avatarInput");
    const changeAvatarBtn = document.getElementById("change-avatar-btn");

    changeAvatarBtn.addEventListener("click", function() {
        avatarInput.click();
    });

    avatarInput.addEventListener("change", function() {
        this.closest("form").submit();
    });
});

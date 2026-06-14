document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("loginForm");
    const errorAlert = document.getElementById("error-alert");

    form.addEventListener("submit", async (e) => {

        e.preventDefault();

        const formData = new FormData(form);

        try {

            const response = await fetch(
                "../controller/loginController.php",
                {
                    method: "POST",
                    body: formData
                }
            );

            const data = await response.json();

            if (data.success) {

                window.location.href = "../index.php";

            } else {

                errorAlert.classList.remove("hidden");

            }

        } catch (error) {

            console.error(error);

            errorAlert.classList.remove("hidden");

        }

    });

});
export function changeRoute(route) {
    window.location.href = `http://127.0.0.1:8000/${route}`;
}

export function getToken() {
    const url = "/api/v1/users/tokens";
    axios
        .get(url)
        .then((response) => {
            // token store sccussfully
        })
        .catch((error) => {
            console.error(error);
        });
}

export function autoCloseDropdown() {
    $(document).on("click", function (event) {
        // Check if the clicked element is a dropdown or its child
        if (!$(event.target).closest(".dropdown").length) {
            // Loop through each dropdown and remove the open attribute to close them
            $(".dropdown").each(function () {
                $(this).removeAttr("open");
            });
        }
    });
}

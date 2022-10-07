const logout = document.getElementById("logout");

logout.addEventListener("click", (e) => {
	e.preventDefault();
	fetch("http://localhost/ecommerce/signup/includes/logout.inc.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
		},
		
	})
		.then((response) => response.text())
		.then((res) => (location.href = res));
});

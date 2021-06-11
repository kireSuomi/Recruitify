//Apply for job
(() => {
  const applyJobButton = document.querySelectorAll(".applyJob")[0];
  if (applyJobButton) {
    applyJobButton.addEventListener("click", (e) => {
      const userID = e.target.getAttribute("user");
      if (userID !== "0") {
        e.preventDefault();

        applyJobButton.disabled = true;
        applyJobButton.classList.add("disabled");
        applyJobButton.innerHTML = "Sökt";

        const data = {
          id: userID,
          postID: applyJobButton.id,
        };

        const url = "/wp-json/job/apply";
        fetch(url, {
          method: "POST", // *GET, POST, PUT, DELETE, etc.
          mode: "cors", // no-cors, *cors, same-origin
          body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
      }
    });
  }
})();

//Search
(() => {
  const locationSelect = document.getElementById("searchLocation");
  const typeSelect = document.getElementById("searchType");
})();

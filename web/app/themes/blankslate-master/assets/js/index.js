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
  const buttonSearch = document.getElementById("btnSearch");
  const textSearch = document.getElementById("searchText");

  if (buttonSearch) {
    buttonSearch.addEventListener("click", () => {
      //Values
      const type = typeSelect.value;
      const location = locationSelect.value;
      console.clear();
      const listings = Array.from(document.querySelectorAll(".listing"));

      listings.forEach((listing) => {
        let listingType = listing.getAttribute("type");
        let listingLocation = listing.getAttribute("location");
        let listingTitle = listing
          .querySelectorAll(".title")[0]
          .innerHTML.toLowerCase();
        let listingExcerpt = listing
          .querySelectorAll(".excerpt")[0]
          .innerHTML.toLowerCase();

        let found = false;

        if (type !== "Yrke") {
          if (type == listingType) found = true;
        }

        if (location !== "Ort") {
          location == listingLocation ? (found = true) : (found = false);
        }

        if (textSearch.value !== "") {
          if (
            listingTitle.includes(textSearch.value.toLowerCase()) &&
            (location !== "Ort" ? location == listingLocation : true) &&
            (type !== "Yrke" ? type == listingType : true)
          ) {
            found = true;
          } else {
            if (listingExcerpt.includes(textSearch.value.toLowerCase())) {
              found = true;
            } else {
              found = false;
            }
          }
        }

        if (type == "Yrke" && location == "Ort" && textSearch.value == "")
          found = true;

        found
          ? (listing.style.display = "block")
          : (listing.style.display = "none");
      });
    });
  }
})();

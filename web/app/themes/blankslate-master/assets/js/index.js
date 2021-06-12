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

        //If the user has set a value for the select & the listing type or location matches the selected value
        let typeMatch = type == "Yrke" ? true : type == listingType;
        let locationMatch =
          location == "Ort" ? true : location == listingLocation;

        //If the search field has a value and the title contains the value
        let titleMatch = false;
        if (textSearch.value !== "") {
          titleMatch = listingTitle
            .toLocaleLowerCase()
            .includes(textSearch.value.toLowerCase());
        } else titleMatch = true;

        //If the search field has a value and the excerpt contains the value
        let excerptMatch = false;
        if (textSearch.value !== "") {
          excerptMatch = listingExcerpt
            .toLocaleLowerCase()
            .includes(textSearch.value.toLowerCase());
        } else excerptMatch = true;

        typeMatch && locationMatch && (titleMatch || excerptMatch)
          ? (listing.style.display = "block")
          : (listing.style.display = "none");
      });
    });
  }
})();

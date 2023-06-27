"use strict";

jQuery(function ($) {
  $(".dropdown").dropdown();
  $("#standard_calendar").calendar({
    type: "date",
    multiMonth: 1,
    monthOffset: -1, // current month will be shown in the middle of 3 months
  });
});

// Get a reference to the form element
const form = document.querySelector(".ui.segment.form");

// Function to handle form submission
const submitForm = (event) => {
  // Get a reference to the form element
  const submit = document.querySelector(".submit");
  // Add class
  submit.classList.contains("loading")
    ? false
    : submit.classList.add("loading");

  event.preventDefault(); // Prevent the default form submission

  // Get the form values
  const fullName = form.querySelector('input[name="user[full-name]"]').value;
  const email = form.querySelector('input[name="user[email]"]').value;
  const gender = form.querySelector('input[name="gender"]').value;
  const birthdate = form.querySelector(
    ".field > .ui.calendar > .input > input"
  ).value;
  const city = form.querySelector('input[name="city"]').value;
  const country = form.querySelector('input[name="country"]').value;

  // Create an object with the form data
  let formData = new FormData();
  formData.append("fullName", fullName);
  formData.append("email", email);
  formData.append("gender", gender);
  formData.append("birthdate", birthdate);
  formData.append("city", city);
  formData.append("country", country);
  formData.append("action", "astrokit_shuffle");
  // Send a POST request to the server
  fetch(astrokit.ajaxurl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    credentials: "same-origin",
    mode: "no-cors",
    body: formData,
  })
    .then((response) => response.json()) // Parse the response as JSON
    .then((result) => {
      // Handle the JSON response
      const msg = document.querySelector("#astrokit-msg");
      switch (result.success) {
        case false:
          while (msg.firstChild) {
            msg.firstElementChild.remove();
          }
          const error = document.createElement("div");
          error.className = "ui red message";
          error.style.color = "#000000";
          error.innerHTML = result.data;
          msg.appendChild(error);
          submit.classList.contains("loading")
            ? submit.classList.remove("loading")
            : false;
          break;
        case true:
          while (msg.firstChild) {
            msg.firstElementChild.remove();
          }
          const astrology = document.createElement("div");
          astrology.className = "ui green message";
          astrology.style.color = "#000000";
          astrology.innerHTML = JSON.parse(result.data).value;
          console.log();
          msg.appendChild(astrology);
          submit.classList.contains("loading")
            ? submit.classList.remove("loading")
            : false;
          break;
      }
    })
    .catch((error) => {
      console.log("Error:", error);
      // Handle any network errors or other exceptions
    });
};

// Add a submit event listener to the form
form.addEventListener("submit", submitForm);

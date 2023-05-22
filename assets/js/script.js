function setActiveTab(tab) {
  document.querySelectorAll(".tab-item").forEach(function (e) {
    if (e.getAttribute("data-for") === tab) {
      e.classList.add("active");
    } else {
      e.classList.remove("active");
    }
  });
}

function showTab() {
  if (document.querySelector(".tab-item.active")) {
    let activeTab = document
      .querySelector(".tab-item.active")
      .getAttribute("data-for");
    document.querySelectorAll(".tab-body").forEach(function (e) {
      if (e.getAttribute("data-item") === activeTab) {
        e.style.display = "block";
      } else {
        e.style.display = "none";
      }
    });
  }
}

if (document.querySelector(".tab-item")) {
  showTab();
  document.querySelectorAll(".tab-item").forEach(function (e) {
    e.addEventListener("click", function (r) {
      setActiveTab(r.target.getAttribute("data-for"));
      showTab();
    });
  });
}

let initial_value = document
  .querySelector(".feed-new-input-placeholder")
  .value.trim();
let feedSubmit = document.querySelector(".feed-new-send");
let arrowSendFeed = document.querySelector(".send-arrow-feed");
let content = document.querySelector(".feed-new-input-placeholder");

(function () {
  let value = content.value.trim();
  if (value === initial_value || value === "") {
    arrowSendFeed.style.cursor = "default";
    arrowSendFeed.style.opacity = "0.3";
  }
})();

content.addEventListener("input", function () {
  let value = this.value.trim();
  if (value !== initial_value && value !== "") {
    arrowSendFeed.style.transition = "opacity 0.3s ease-in-out";
    arrowSendFeed.style.cursor = "pointer";
    arrowSendFeed.style.opacity = "1";
  } else {
    arrowSendFeed.style.cursor = "default";
    arrowSendFeed.style.opacity = "0.3";
  }
  this.style.height = 'auto';
  this.style.height = this.scrollHeight + "px";
});

content.addEventListener("focus", function (obj) {
  let value = this.value.trim();
  if (value === initial_value) {
    content.value = "";
  }
});

feedSubmit.addEventListener("click", () => {
  let feedForm = document.querySelector(".feed-new-form");
  let value = content.value.trim();
  if (value === initial_value && value !== "") {
    feedSubmit.preventDefault();
  } else {
    feedForm.querySelector("input[name=body]").value = value;
    feedForm.submit();
  }
});

content.addEventListener("blur", function () {
  let value = this.value.trim();
  if (value === "") {
    this.value = initial_value;
    feedSubmit.style.cursor = "default";
    arrowSendFeed.style.opacity = "0.3";
  }
});

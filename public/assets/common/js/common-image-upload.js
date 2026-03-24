document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelectorAll(".upload_wrapper").length) {
    initFileUpload();
    checkPreExistingImages();
  }

  document.querySelectorAll(".upload_wrapper_container").forEach(container => {
    initSliderNavigation(container);
  });

  document.addEventListener("click", function (e) {
    const viewBtn = e.target.closest(".view_btn");
    if (!viewBtn) return;

    const card = viewBtn.closest(".upload-file-new, .view-img-wrap");
    if (!card) return;

    const img = card.querySelector("img.upload-file-new-img");
    if (!img) return;

    const actualSrc = img.getAttribute("data-src") || img.getAttribute("src");
    if (!actualSrc) return;

    const modalEl = document.getElementById("imageModal");
    const modalImg = modalEl?.querySelector(".imageModal_img");
    const downloadBtn = modalEl?.querySelector(".download_btn");

    if (!modalEl || !modalImg || !downloadBtn) return;

    modalImg.src = actualSrc;
    downloadBtn.href = actualSrc;

    const modal = new bootstrap.Modal(modalEl);
    modal.show();
  });
});

function setupCard(card) {
  const img = card.querySelector(".upload-file-new-img");
  const textbox = card.querySelector(".upload-file-new-textbox");
  const overlay = card.querySelector(".overlay");
  const removeBtn = card.querySelector(".remove_btn");
  const input = card.querySelector(".single_file_input");

  if (img) {
    img.src = "";
    img.style.display = "none";
  }
  if (textbox) textbox.style.display = "block";
  if (overlay) overlay.classList.remove("show");
  if (removeBtn) removeBtn.style.opacity = 0;
  if (input) input.value = "";

  card.classList.remove("input-disabled");
}

function fillCardWithFile(card, file) {
  const img = card.querySelector(".upload-file-new-img");
  const textbox = card.querySelector(".upload-file-new-textbox");
  const overlay = card.querySelector(".overlay");
  const removeBtn = card.querySelector(".remove_btn");

  const reader = new FileReader();
  reader.onload = function (e) {
    img.src = e.target.result;
    img.style.display = "block";
    if (textbox) textbox.style.display = "none";
    if (overlay) overlay.classList.add("show");
    if (removeBtn) removeBtn.style.opacity = 1;
    card.classList.add("input-disabled");
  };
  reader.readAsDataURL(file);
}

function createNewCard(wrapper) {
  const templateCard = wrapper.querySelector(".upload-file-new");
  if (!templateCard) return null;

  const newCard = templateCard.cloneNode(true);

  const oldInput = newCard.querySelector(".single_file_input");
  const newInput = document.createElement("input");

  newInput.type = "file";
  newInput.className = "upload-file-new__input single_file_input";
  newInput.accept = ".webp, .jpg, .jpeg, .png, .gif";

  if (wrapper.dataset.multiple === "true") {
    newInput.setAttribute("multiple", true);
  }

  if (oldInput && oldInput.name) {
    newInput.setAttribute("name", oldInput.name);
  }

  oldInput.replaceWith(newInput);
  setupCard(newCard);

  return newCard;
}


function updateLastSlot(wrapper) {
  const maxLimit = parseInt(wrapper.dataset.maxLimit) || 5;
  const filledCards = wrapper.querySelectorAll(".upload-file-new.input-disabled");
  const emptyCards = wrapper.querySelectorAll(".upload-file-new:not(.input-disabled)");
  const totalCards = filledCards.length + emptyCards.length;

  if (emptyCards.length === 0 && totalCards < maxLimit) {
    const newCard = createNewCard(wrapper);
    if (!newCard) return;

    wrapper.insertBefore(newCard, wrapper.firstChild);

    const allPlaceholders = wrapper.querySelectorAll(".upload-file-new:not(.input-disabled)");
    allPlaceholders.forEach((card, index) => {
      if (index > 0) card.remove();
    });
  }

  const updatedEmptyCards = wrapper.querySelectorAll(".upload-file-new:not(.input-disabled)");
  if (updatedEmptyCards.length > 1) {
    for (let i = 1; i < updatedEmptyCards.length; i++) {
      updatedEmptyCards[i].remove();
    }
  }
}

function initFileUpload() {
  document.querySelectorAll(".upload_wrapper").forEach(wrapper => {

    const debugWrapperFiles = () => {
      const inputs = wrapper.querySelectorAll("input[type='file']");
      const debugData = [];

      inputs.forEach((input, idx) => {
        const name = input.getAttribute("name") || "(no name)";
        const fileList = input.files;

        if (fileList && fileList.length > 0) {
          [...fileList].forEach((file, i) => {
            debugData.push({
              inputIndex: idx,
              inputName: name,
              fileIndex: i,
              fileName: file.name,
              fileSize: `${file.size} B`,
              fileType: file.type
            });
          });
        } else {
          debugData.push({
            inputIndex: idx,
            inputName: name,
            fileIndex: "-",
            fileName: "(no file)",
            fileSize: "-",
            fileType: "-"
          });
        }
      });

      console.log("Input file values---");
      console.table(debugData);
    };


    wrapper.addEventListener("change", function (e) {
      const input = e.target;
      if (!input.classList.contains("single_file_input")) return;

      const files = input.files;
      if (!files.length) return;

      const currentCard = input.closest(".upload-file-new");
      const container = currentCard.closest(".upload_wrapper_container");
      const maxLimit = parseInt(wrapper.dataset.maxLimit) || 5;
      const isMultiple = wrapper.dataset.multiple === "true";

      if (isMultiple && files.length > 1) {
        fillCardWithFile(currentCard, files[0]);

        for (let i = 1; i < files.length; i++) {
          const currentCount = wrapper.querySelectorAll(".upload-file-new.input-disabled").length;
          if (currentCount >= maxLimit) break;

          const newCard = createNewCard(wrapper);
          if (!newCard) break;

          wrapper.insertBefore(newCard, wrapper.children[1]);
          fillCardWithFile(newCard, files[i]);
        }
        updateLastSlot(wrapper);
      } else {
        fillCardWithFile(currentCard, files[0]);

        if (isMultiple) {
          currentCard.classList.add("input-disabled");

          const currentCount = wrapper.querySelectorAll(".upload-file-new.input-disabled").length;
          if (currentCount < maxLimit) {
            updateLastSlot(wrapper);
          }
        }
      }

      if (container) {
        setTimeout(() => {
          container.dataset.sliderInit = "false";
          initSliderNavigation(container);
        }, 100);
      }

      console.log("Uploaded files:");
      debugWrapperFiles();
    });

    wrapper.addEventListener("click", function (e) {
      const removeBtn = e.target.closest(".remove_btn");
      const editBtn = e.target.closest(".edit_btn");

      if (removeBtn) {
        const card = removeBtn.closest(".upload-file-new");
        const container = card.closest(".upload_wrapper_container");
        const isMultiple = wrapper.dataset.multiple === "true";

        if (isMultiple) {
          card.remove();
          updateLastSlot(wrapper);
        } else {
          setupCard(card);
        }

        if (container) {
          setTimeout(() => initSliderNavigation(container), 100);
        }

        console.log("Files after removal---");
        debugWrapperFiles();
        return;
      }

      if (editBtn) {
        debugWrapperFiles();
        e.stopImmediatePropagation();
        const card = editBtn.closest(".upload-file-new");
        if (card) {
          card.classList.remove("input-disabled");
          const input = card.querySelector(".single_file_input");
          if (input) input.click();
        }
      }
    });
  });
}



function checkPreExistingImages() {
  document.querySelectorAll(".upload-file-new").forEach(card => {
    const textbox = card.querySelector(".upload-file-new-textbox");
    const imgElement = card.querySelector(".upload-file-new-img");
    const removeBtn = card.querySelector(".remove_btn");
    const overlay = card.querySelector(".overlay");

    const src = imgElement?.getAttribute("src");

    if (src && src !== window.location.href && src !== "") {
      imgElement.setAttribute("data-src", src);
      if (textbox) textbox.style.display = "none";
      if (imgElement) imgElement.style.display = "block";
      if (overlay) overlay.classList.add("show");
      if (removeBtn) removeBtn.style.opacity = 1;
      card.classList.add("input-disabled");
    }
  });
}

function makeWrapperDraggable(wrapper) {
  let isDown = false;
  let startX;
  let scrollLeft;

  wrapper.style.cursor = "grab";

  wrapper.addEventListener("mousedown", (e) => {
    isDown = true;
    wrapper.style.cursor = "grabbing";
    startX = e.pageX - wrapper.offsetLeft;
    scrollLeft = wrapper.scrollLeft;
    e.preventDefault();
  });

  wrapper.addEventListener("mouseleave", () => {
    isDown = false;
    wrapper.style.cursor = "grab";
  });

  wrapper.addEventListener("mouseup", () => {
    isDown = false;
    wrapper.style.cursor = "grab";
  });

  wrapper.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - wrapper.offsetLeft;
    const walk = (x - startX) * 2; 
    wrapper.scrollLeft = scrollLeft - walk;
  });

  // Touch support
  wrapper.addEventListener("touchstart", (e) => {
    isDown = true;
    startX = e.touches[0].pageX - wrapper.offsetLeft;
    scrollLeft = wrapper.scrollLeft;
  });

  wrapper.addEventListener("touchend", () => {
    isDown = false;
  });

  wrapper.addEventListener("touchmove", (e) => {
    if (!isDown) return;
    const x = e.touches[0].pageX - wrapper.offsetLeft;
    const walk = (x - startX) * 2;
    wrapper.scrollLeft = scrollLeft - walk;
  });
}

function initSliderNavigation(container) {
  const wrapper = container.querySelector(".upload_wrapper");
  const prevBtn = container.querySelector(".prev_btn");
  const nextBtn = container.querySelector(".next_btn");
  const isRTL = document.documentElement.getAttribute("dir") === "rtl";

  if (!wrapper || !prevBtn || !nextBtn) return;
  if (container.dataset.sliderInit === "true") return;
  container.dataset.sliderInit = "true";

  function checkOverflow() {
    const scrollLeft = wrapper.scrollLeft;
    const scrollWidth = wrapper.scrollWidth;
    const clientWidth = wrapper.clientWidth;
    const maxScroll = scrollWidth - clientWidth;

    let normalizedScrollLeft;

    if (isRTL) {
      normalizedScrollLeft = scrollLeft < 0 ? -scrollLeft : maxScroll - scrollLeft;
    } else {
      normalizedScrollLeft = scrollLeft;
    }

    nextBtn.style.display = normalizedScrollLeft < maxScroll - 1 ? "block" : "none";
    prevBtn.style.display = normalizedScrollLeft > 1 ? "block" : "none";
  }

  function scrollByAmount(amount) {
    wrapper.scrollBy({
      left: isRTL ? -amount : amount,
      behavior: "smooth",
    });
  }

  prevBtn.addEventListener("click", () => scrollByAmount(isRTL ? 200 : -200));
  nextBtn.addEventListener("click", () => scrollByAmount(isRTL ? -200 : 200));
  wrapper.addEventListener("scroll", checkOverflow);
  window.addEventListener("resize", checkOverflow);

  makeWrapperDraggable(wrapper);

  setTimeout(checkOverflow, 100);
}

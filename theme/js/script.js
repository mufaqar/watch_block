// Toggle Mobile Menu 
document.addEventListener('DOMContentLoaded', () => {
  const menuButton = document.querySelector('#menu-button'); // Select the button
  const navMenu = document.getElementById('nav-menu'); // Select the nav menu
  if (menuButton && navMenu) {
    menuButton.addEventListener('click', () => {
      navMenu.classList.toggle('hidden'); // Toggle the 'hidden' class
    });
  }
});


// Products Tabs
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab-button");
  const contents = document.querySelectorAll(".tab-content");

  // Set the first tab and content as active by default
  if (tabs.length > 0 && contents.length > 0) {
    tabs[0].classList.add("active", "border-black", "text-black");
    contents[0].classList.remove("hidden");
  }

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // Remove active class from all tabs
      tabs.forEach((item) => {
        item.classList.remove("active", "border-black", "text-black");
        item.classList.add("text-black", "border-transparent");
      });

      // Add active class to the clicked tab
      tab.classList.add("active", "border-black", "text-black");

      // Hide all tab content and show the relevant one
      contents.forEach((content) => content.classList.add("hidden"));
      document.getElementById(tab.dataset.tab).classList.remove("hidden");
    });
  });
});

// Press Revieww Tabs 
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".ra_tab-button");
  const contents = document.querySelectorAll(".ra_tab-content");

  // Ensure tabs and contents are correctly selected
  if (!tabs.length || !contents.length) {
    console.error("Tabs or content elements are missing.");
    return;
  }

  // Set the first tab and content as active by default
  tabs[1].classList.add("active", "border-black");
  contents[1].classList.remove("hidden");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      // Remove active class from all tabs
      tabs.forEach((item) => item.classList.remove("active", "border-black"));

      // Add active class to the clicked tab
      tab.classList.add("active", "border-black");

      // Hide all content and show the relevant one
      contents.forEach((content) => content.classList.add("hidden"));
      const targetContent = document.getElementById(tab.dataset.tab);
      if (targetContent) {
        targetContent.classList.remove("hidden");
      } else {
        console.error(`No content found for tab: ${tab.dataset.tab}`);
      }
    });
  });
});


// Faq 
document.addEventListener('DOMContentLoaded', () => {
  const faqQuestions = document.querySelectorAll('.faq-question');

  faqQuestions.forEach(question => {
      question.addEventListener('click', () => {
          const faqItem = question.closest('.faq-item');
          faqItem.classList.toggle('open');
      });
  });
});


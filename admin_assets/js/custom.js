$(document).ready(function () {
  const dropdownHeader = document.querySelector(".dropdown-header");
  const dropdownContent = document.querySelector(".dropdown-content");
  const dropdownIcon = document.querySelector(".dropdown-icon");

  if (dropdownHeader && dropdownContent && dropdownIcon) {
    dropdownHeader.addEventListener("click", () => {
      dropdownContent.style.display =
        dropdownContent.style.display === "block" ? "none" : "block";
      dropdownIcon.classList.toggle("open");
    });

  
    dropdownContent.style.display = "none";
   
    document.addEventListener("click", (event) => {
      if (dropdownHeader && dropdownContent) {
        if (
          !dropdownHeader.contains(event.target) &&
          !dropdownContent.contains(event.target)
        ) {
          dropdownContent.style.display = "none";
          dropdownIcon?.classList.remove("open");
        }
      }
    });

  }

  $(".custom_dropdown").on("click", function () {
    $(".dropdown-icon i").toggleClass("bi-chevron-down bi-chevron-up");
  });

  $(".toggle-sidebar").on("click", function () {
    $(".sidebar").toggleClass("hidden-sidebar");
    $(".toggle-sidebar i").toggleClass("fa-chevron-right fa-chevron-left");
  });

  
  $(".toggle-s").on("click", function () {
    $(".sidebar").toggleClass("hidden-sidebar");
    $(".toggle-s i").toggleClass("fa-chevron-right fa-chevron-left");
  });


 if (window.innerWidth <= 768) {
  $(".sidebar").addClass("hidden-sidebar");
}




   document.addEventListener("click", (event) => {    if (!dropdownHeader.contains(event.target) && !dropdownContent.contains(event.target)) {      dropdownContent.style.display = "none";      dropdownIcon.classList.remove("open");    }  });
  
});




// $(document).ready(function() {
  
//   $('#addNewDropdownBtn').click(function(e) {
//     e.stopPropagation();
//     $('#addNewDropdownMenu').toggleClass('show');
//     $(this).attr('aria-expanded', $('#addNewDropdownMenu').hasClass('show'));
//   });
  
 
//   $(document).click(function() {
//     $('#addNewDropdownMenu').removeClass('show');
//     $('#addNewDropdownBtn').attr('aria-expanded', 'false');
//   });
  

//   $('#addNewDropdownMenu').click(function(e) {
//     e.stopPropagation();
//   });
  
 
//   $('.custom-dropdown-item').click(function(e) {
//     e.preventDefault();
//     const menuItemText = $(this).find('.custom-dropdown-item-text').text();
//     console.log(`Clicked on: ${menuItemText}`);
    
   
//     $('#addNewDropdownMenu').removeClass('show');
//     $('#addNewDropdownBtn').attr('aria-expanded', 'false');
//   });
// });

function removeActiveClass() {
    $('.nav-link.dropdown-toggle').each(function () {
        $(this).removeClass("nav_active");
    });
    $('.dropdown-menu.child_menu').each(function () {
        $(this).removeClass("show");
    });
}

$(document).ready(function () {
    $('li.nav-item').click(function (e) {
        e.stopPropagation();
        const isActive = $(this).find('.nav-link.dropdown-toggle').hasClass("nav_active");
        removeActiveClass();

        if (!isActive) {
            $(this).find('.nav-link.dropdown-toggle').addClass("nav_active");
            $(this).find('.dropdown-menu.child_menu').addClass("show");
        }
    });


});


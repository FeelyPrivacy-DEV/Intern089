const 
      sidebar = document.querySelector('nav'),
      toggle = document.querySelector(".toggle"),
      searchBtn = document.querySelector(".search-box"),
      modeSwitch = document.querySelector(".toggle-switch"),
      modeText = document.querySelector(".mode-text");


$(document).on("click", '#toggleSidebar', function() {
    $('.sidebar').toggleClass("close");
    $('.d-dash-content') .toggleClass("sidebarGap");
});

// searchBtn.addEventListener("click" , () =>{
//     sidebar.classList.remove("close");
// })

 


//   themee setting
$(document).on('click', '.themeBtn', function() {
    let name = $(this).attr('id'); 

    if(name == 'dark') {
        $(this).attr('id', 'light');
        $(document.documentElement).css({ 
            '--theam-bg-dark': '#1f2128', 
            '--text-light': '#000000', 
        });
    }
    else {
        $(this).attr('id', 'dark');
        $(document.documentElement).css({ 
            '--theam-bg-dark': '#ffffff',
            '--text-light': '#ffffff', 
        });
    }




    $()
})
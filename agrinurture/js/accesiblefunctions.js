


const sidebar = document.querySelector(".sidebar");
const toggleSidebar = document.querySelector(".toggle-sidebar");   
const logobox = document.querySelector(".logo-box") 

// Toggle sidebar on button click
export function MenuBar() {
    
        

    if(toggleSidebar){
        toggleSidebar.addEventListener("click", () => {
            sidebar.classList.toggle("close");
         });
    
    } 

}

    // Toggle sidebar on logo click
    // logobox.addEventListener("click", () => {
    //     sidebar.classList.toggle("close");
    // });
     
  
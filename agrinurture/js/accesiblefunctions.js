

const sidebar = document.querySelector(".sidebar");
const toggleSidebar = document.querySelector(".toggle-sidebar");  
const logoBox = document.querySelector(".logo-box")

// Toggle sidebar on button click
export function MenuBar() {
    
    if(toggleSidebar){
        toggleSidebar.addEventListener("click", () => {
            sidebar.classList.toggle("close");
         });
    
    } 
}

export function logoBoxMenuBarButton() {
    if(logoBox){
        logoBox.addEventListener("click", () => {
            sidebar.classList.toggle("close");
         });
    
    } 
}

    // Toggle sidebar on logo click
    // logobox.addEventListener("click", () => {
    //     sidebar.classList.toggle("close");
    // });
     
    const showPassCheckbox = document.getElementById('showpass');
    const passwordInput = document.getElementById('loginpassword');
    
    
    export function showPassword() {
        document.addEventListener("DOMContentLoaded", function() {
            showPassCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordInput.type = 'text';
                    
                } else {
                    passwordInput.type = 'password';
                   
                }
            });
            
        });
    }
    
    const passwordCheckbox = document.getElementById('showpassWord')
    const createPassword = document.getElementById('createpassword')
    const confirmPass = document.getElementById('confirmpassword')
    const check = document.getElementById('check')
    
   export function passwordCheck() {
        document.addEventListener("DOMContentLoaded", function() {
            
            passwordCheckbox.addEventListener('change', function() {
    
                if(this.checked){
                    createPassword.type = 'text'
                    confirmPass.type = 'text'
                } else{
                    createPassword.type = 'password'
                    confirmPass.type = 'password'
                }
            });
    
           
        
        });
    }
        
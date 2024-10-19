
register()
showPassword()
passwordCheck() 

const showPassCheckbox = document.getElementById('showpass');
const passwordInput = document.getElementById('password');


function showPassword() {
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

function passwordCheck() {
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
    



var signupContainer = document.getElementById('signup-container')
var registerContainer = document.getElementById('register-container')
var cancel = document.getElementById('cancel')
var register = document.getElementById('register')


function register(){
    document.addEventListener("DOMContentLoaded", function() {
      
       if(register){    
        register.addEventListener("click", function(e) {
            e.preventDefault();
            signupContainer.style.display = "none";
            registerContainer.style.display = "block";
        })
        
       }  
       
       if(cancel){
        cancel.addEventListener("click", function(e) {
           
            signupContainer.style.display = "block";
            registerContainer.style.display = "none";
        })
       }
        
    });
}


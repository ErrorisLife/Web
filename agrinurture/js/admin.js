
import { MenuBar } from './accesiblefunctions.js';

MenuBar(); // 

// Call the function to initialize the dashboard

AdminButton()

// Admin Dashboard

    var adminContainer = document.querySelector('.admin-container');
    var adminDashboard = document.getElementById("adminDashboard");
    var newAdminContainer = document.querySelector(".new-admin-container");
    
function AdminButton() {
    document.addEventListener('DOMContentLoaded', function() {
       

        if (adminDashboard) {
            adminDashboard.addEventListener("click", function(e) {
                e.preventDefault();
                console.log('adminDashboard was clicked');              

                if (adminContainer) {
                    adminContainer.style.display = "flex"; // Show the dashboard
                    console.log('adminContainer was shown');

                } else {
                    console.error('The container element was not found.');
                }
            });
        } else {
            console.error('The adminDashboard element was not found.');
        }
    });
}





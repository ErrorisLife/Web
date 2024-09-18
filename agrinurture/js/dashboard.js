
import { MenuBar } from './accesiblefunctions.js';

MenuBar(); 
initialize()




    // Function Initialization

    function initialize(){   
        MainDashButton()
        UploadButton() 
    }

   
    const sidebar = document.querySelector(".sidebar");
    const uploadBox = document.querySelector('.upload-box');
    const contentContainer = document.querySelector('.content-container');

   
    
    
    /**
     * Crop/Livestock DashBoard Button
     * Handles the click event on the dashboard button, toggling the sidebar and displaying the dashboard content.
     */
    function MainDashButton() {
        document.addEventListener('DOMContentLoaded', function() {
            
            
            document.getElementById("dashboard").addEventListener("click", (e) => {
                e.preventDefault();
                sidebar.classList.toggle("open");
               
                if (contentContainer) {
                    contentContainer.style.display = "flex"; // Show the dashboard
                    uploadBox.style.display = "none";
                } else {
                    console.error('The container element was not found.');  
                   
                }
            })
        });
    }
  
   
 
    /**
     * Crop/Livestock Upload Button 
     * Handles the click event on the upload link, toggling the sidebar and displaying the upload box.
     */
    function UploadButton() {
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('upload-link').addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior
                sidebar.classList.toggle("open");
    
                if (uploadBox) {
                    uploadBox.style.display = "block"; // Show the upload box
                    contentContainer.style.display = "none";
                } else {
                    console.error('The upload box element was not found.');
                }
            });
        });
    }

    
    /**
     * Handles the click event on the upload link, toggling the sidebar and displaying the upload box.
     */
    function UploadButton() {
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('upload-link').addEventListener('click', (e) =>{
                e.preventDefault(); // Prevent default link behavior
                 sidebar.classList.toggle("open");
                
                if (uploadBox) {
                    uploadBox.style.display = "block"; // Show the upload box
                    contentContainer.style.display = "none";
                       
                } else {
                    console.error('The upload box element was not found.');
                    
                }
            });
        });
    }
  
   


    // Upload Page Variables
    const dropArea = document.querySelector('.drop-section')
    const listSection = document.querySelector('.list-section')
    const listContainer = document.querySelector('.list')
  

    // Allowed MIME types for videos, PDFs, and document files
    const allowedFileTypes = [
        'application/pdf',
        'application/msword', // for .doc files
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // for .docx files
        'video/mp4',
        'video/avi',
        'video/mpeg',
        'video/quicktime'
    ];



// upload files with browse button
   
    // fileSelector.onclick = () => fileSelectorInput.click()
    //  fileSelectorInput.onchange = () => {
    //      [...fileSelectorInput.files].forEach((file) => {
    //          if(typeValidation(file.type)){
    //              uploadFile(file)
    //          }
    //      })
    //  }  
    
    /**
     * Handles the file selection and upload process when the user clicks the file selector button.
     * When the user clicks the file selector button, it triggers a click on the hidden file input element, allowing the user to select files from their file system.
     */
    document.addEventListener("DOMContentLoaded", function() {
        const fileSelector = document.querySelector('.file-selector')
         const fileSelectorInput = document.querySelector('.file-selector-input')
        
        if (fileSelector && fileSelectorInput) {
            fileSelector.onclick = () => fileSelectorInput.click();
            
            fileSelectorInput.onchange = () => {
                [...fileSelectorInput.files].forEach((file) => {
                    if(typeValidation(file.type)){
                        uploadFile(file);
                    }
                });
            };
        } else {
            console.error("fileSelector or fileSelectorInput is null");
        }
    });
    


    function typeValidation(type){
        return allowedFileTypes.includes(type);
    }


    
// upload file function
    function uploadFile(file){
        listSection.style.display = 'block'
        var li = document.createElement('li')
        li.classList.add('in-prog')
        li.innerHTML = `
            <div class="col">
                <img src="../image/${iconSelector(file.type)}" alt="">
            </div>
            <div class="col">
                <div class="file-name">
                    <div class="name">${file.name}</div>
                    <span>0%</span>
                </div>
                <div class="file-progress">
                    <span></span>
                </div>
                <div class="file-size">${(file.size/(1024*1024)).toFixed(2)} MB</div>
            </div>
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" class="cross" height="20" width="20"><path d="m5.979 14.917-.854-.896 4-4.021-4-4.062.854-.896 4.042 4.062 4-4.062.854.896-4 4.062 4 4.021-.854.896-4-4.063Z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="tick" height="20" width="20"><path d="m8.229 14.438-3.896-3.917 1.438-1.438 2.458 2.459 6-6L15.667 7Z"/></svg>
            </div>
        `
        listContainer.prepend(li)
        var http = new XMLHttpRequest()
        var data = new FormData()
        data.append('file', file)
        http.onload = () => {
            li.classList.add('complete')
            li.classList.remove('in-prog')
        }
        http.upload.onprogress = (e) => {
            var percent_complete = (e.loaded / e.total)*100
            li.querySelectorAll('span')[0].innerHTML = Math.round(percent_complete) + '%'
            li.querySelectorAll('span')[1].style.width = percent_complete + '%'
        }
        http.open('POST', 'upload.php', true)
        http.send(data)
        li.querySelector('.cross').onclick = () => http.abort()
        http.onabort = () => li.remove()
    }




// find icon for file
    function iconSelector(type){
        var splitType = (type.split('/')[0] == 'application') ? type.split('/')[1] : type.split('/')[0];
        return splitType + '.png'
    }



  

// When file is over the drag area
document.addEventListener("DOMContentLoaded", function() {
    dropArea.ondragover = (e) => {
        e.preventDefault();
        [...e.dataTransfer.items].forEach((item) => {
            if(typeValidation(item.type)){
                dropArea.classList.add('drag-over-effect')
            }
        })
     }
});


 // When file leave the drag area

    dropArea.ondragleave = () => {
        dropArea.classList.remove('drag-over-effect')
     }
 
 

//  When file is drop on the drag area, 
//also check if the format of file is among the accepted
document.addEventListener("DOMContentLoaded", function() {
    dropArea.ondrop = (e) => {
        e.preventDefault();
        dropArea.classList.remove('drag-over-effect');
        if(e.dataTransfer.items){
            [...e.dataTransfer.items].forEach((item) => {
                if(item.kind === 'file'){
                    const file = item.getAsFile();
                    if(typeValidation(file.type)){
                        uploadFile(file)
                    } else {
                        alert(`File type ${file.type} is not supported`)
                    }
                }
            })
        } else{
            [...e.dataTransfer.files].forEach((file) => {
                if(typeValidation(file.type)){
                    uploadFile(file)
                } else {
                    alert(`File type ${file.type} is not supported`)
                }
            })
        }
     }

});


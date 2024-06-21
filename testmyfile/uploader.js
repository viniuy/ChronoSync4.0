// Firebase configuration
  const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "myfiles-d289f.firebaseapp.com",
    projectId: "myfiles-d289f",
    storageBucket: "myfiles-d289f.appspot.com",
    messagingSenderId: "949856614113",
    appId: "1:949856614113:web:03b45744af8daaffae69a0",
  };

  // Initialize Firebase
  const app = firebase.initializeApp(firebaseConfig);
  const storage = firebase.storage();

  // DOM elements
  const fileData = document.querySelector(".filedata");
  const loading = document.querySelector(".loading");
  const uploadedFilesCard = document.getElementById("uploadedFilesCard");
  const uploadedFilesList = document.getElementById("uploadedFilesList");
  const recentlyUploadedFiles = document.getElementById("recentlyUploadedFiles");

  // Function to open file selection dialog
  const uploadImage = () => {
    document.querySelector(".inp").click();
  };

  // Function to handle drag over event
  const handleDragOver = (event) => {
    event.preventDefault();
  };

  // Function to handle drop event
  const handleDrop = (event) => {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    uploadFile(file, file.name);
  };

  // Function to get image data when a file is selected
  const getImageData = (e) => {
    const file = e.target.files[0];
    uploadFile(file, file.name);
  };

  // Function to upload file to Firebase storage
  const uploadFile = (file, fileName) => {
    loading.style.display = "block";
    const storageRef = storage.ref().child("myimages");
    const folderRef = storageRef.child(fileName);
    const uploadtask = folderRef.put(file);
    uploadtask.on(
      "state_changed",
      (snapshot) => {
        // Progress tracking can be added here if needed
      },
      (error) => {
        console.log(error);
      },
      () => {
        storage
          .ref("myimages")
          .child(fileName)
          .getDownloadURL()
          .then((url) => {
            loading.style.display = "none";
            uploadedFilesCard.style.display = "block";
            const fileItem = document.createElement('div');
            fileItem.className = 'col-md-3 file-item';
            const icon = getFileIcon(fileName); // Get icon based on file extension
            const fileSize = getFileSize(file.size); // Get file size
            const uploadDate = new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric' }); // Get month and day
            fileItem.innerHTML = `
              <i class="${icon} file-icon"></i>
              <div class="file-details">
                <p class="file-name">${fileName}</p>
                <p class="file-info">${uploadDate} | ${fileSize}</p>
              </div>
            `;
            
            uploadedFilesList.appendChild(fileItem);

            // Add the recently uploaded file to the modal
            const recentFileItem = document.createElement('div');
              recentFileItem.className = 'file-item';
              recentFileItem.innerHTML = `
                <div class="file-details">
                    <p class="file-name">${fileName} | ${uploadDate} | ${fileSize}</p>
                </div>
              `;
              recentlyUploadedFiles.appendChild(recentFileItem);
            });
          console.log("File Uploaded Successfully");
        }
      );
    };
        

  // Function to get icon based on file extension
  const getFileIcon = (fileName) => {
    const extension = fileName.split('.').pop();
    switch (extension) {
      case 'pdf':
        return 'far fa-file-pdf';
      case 'doc':
      case 'docx':
        return 'far fa-file-word';
      case 'xls':
      case 'xlsx':
        return 'far fa-file-excel';
      case 'ppt':
      case 'pptx':
        return 'far fa-file-powerpoint';
      case 'jpg':
      case 'jpeg':
      case 'png':
      case 'gif':
        return 'far fa-file-image';
      case 'wmv':
      case 'mp4':
        return 'bi bi-filetype-mp4';
      case 'mp3':
      case 'm4a':
        return 'bi bi-filetype-mp3';
      default:
        return 'far fa-file';
    }
  };

  // Function to get human-readable file size
  const getFileSize = (bytes) => {
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes === 0) return '0 Byte';
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
  };

  // Adding click event listener to the "New Folder" dropdown item
  document.querySelector('.dropdown-item[href="#"]').addEventListener('click', createNewFolder);

    // Function to add three dots icon for file actions
    const addFileActions = (fileName) => {
      const fileItem = document.createElement('div');
      fileItem.className = 'file-item';
      fileItem.innerHTML = `
        <p class="file-name">${fileName}</p>
        <div class="dropdown">
          <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton${fileName}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${fileName}">
            <button class="dropdown-item delete-file" data-file="${fileName}">Delete</button>
            <button class="dropdown-item rename-file" data-file="${fileName}">Rename</button>
          </div>
        </div>
      `;
      return fileItem;
    };
    const createFolder = () => {
      const folderName = document.getElementById('folderName').value.trim();
      if (folderName !== '') {
        // Create a reference to the new folder
        const folderRef = storage.ref().child(folderName);
        // Create the folder
        folderRef
          .putString('')
          .then(() => {
            console.log('Folder created successfully:', folderName);
            // Optionally, you can perform additional actions here, such as updating UI
            $('#createFolderModal').modal('hide');
          })
          .catch((error) => {
            console.error('Error creating folder:', error);
            // Optionally, you can display an error message to the user
          });
      } else {
        console.error('Folder name cannot be empty');
        // Optionally, you can display a validation message to the user
      }
    };
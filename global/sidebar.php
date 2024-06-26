<div class="dlabnav">
	<div class="dlabnav-scroll">
		<ul class="metismenu" id="menu">
			<li><a href="index.php" aria-expanded="false">
					<i class="bi bi-house"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>

			<li><a href="calendar.php" aria-expanded="false">
					<i class="bi bi-calendar-check"></i>

					<span class="nav-text">Calendar</a></span>

			</li>

			<li><a href="Anouncement.php" aria-expanded="false">
					<i class="bi bi-chat"></i>

					<span class="nav-text">Announcement</a></span>

			</li>



			<li><a href="todolist.php" aria-expanded="false">
					<i class="bi bi-check2-square"></i>
					<span class="nav-text">Todo list</a></span>

			</li>

			<li><a href="myfile.php" aria-expanded="false">
					<i class="bi bi-file-earmark"></i>
					<span class="nav-text">MyFile</span>
				</a>
			</li>

			<li><a href="resources.php" aria-expanded="false">
					<i class="bi bi-folder-symlink"></i>
					<span class="nav-text">Resources</span>
				</a>
			</li>
			<div class="col-xl-12 col-lg-12">

            

                <style>
          

            .editor-container {
                color: white;
                padding: 1px;
                border-radius: 10px;
                width: 300px;
                max-width: 100%;
                position: relative;
                justify-content: flex-end;

                background-color: #E2F1FF;


            }

            .toolbar {
                display: flex;
                justify-content: space-around;
                background-color: #E2F1FF;
                padding: 5px;
                border-radius: 5px;
                margin-bottom: 10px;
                margin: 0 auto;
                width: 90%;
            }

            .toolbar button {
                background-color: transparent;
                border: none;
                color: black;
                cursor: pointer;
                border-radius: 10px;
                width: 300px;
                max-width: 10%;
                font-size: 13px;
            }

            .toolbar button:hover {
                color: #ddd;
            }

            #editor {
                background-color: #E2F1FF;
                border: 1px solid #ccc;
                padding: 10px;
                box-sizing: border-box;
                color: black;
                min-height: 150px;
                width: 90%;
                height: 210px; /* Adjust height as needed */
                margin: 0 auto;
                border-radius: 5px;
                overflow-y: auto;
                position: relative;

            }



            #editor:focus {
                outline: none;
            }

            .placeholder {
    color: #999;
    font-style: italic;
}

.toolbar {
    display: flex;
    margin-top: 1px; 
}

        </style>
    </head>
    <body>

    


    <!-- <div class="editor-container">
 <div class="color-selector">
        <select onchange="changeColor(this.value)">
            <option value="">Change Color</option>
            <option value="green"style="background-color: green;">green</option>
            <option value="yellow"style="background-color: yellow;">Yellow</option>
            <option value="grey"style="background-color: grey;">Grey</option>
            <option value="pink"style="background-color: pink;">Pink</option>
        </select>
        </div></div> -->

        <div id="editor" contenteditable="true" class="placeholder">Take a note...</div>
        <div class="toolbar">
            <button onclick="execCmd('bold')"><b>B</b></button>
            <button onclick="execCmd('italic')"><i>I</i></button>
            <button onclick="execCmd('underline')"><u>U</u></button>
            <button onclick="execCmd('strikeThrough')"><s>ab</s></button>
            <button onclick="execCmd('insertUnorderedList')">&#8226;</button>
            <input type="file" id="imageUploader" onchange="uploadImage()" style="display:none;">
            
            <button onclick="document.getElementById('imageUploader').click()">&#128247;</button>
        </div>
    

    <script>
        document.getElementById('editor').addEventListener('focus', function() {
            if (this.textContent === 'Take a note...') {
                this.textContent = '';
                this.classList.remove('placeholder');
            }
        });

        document.getElementById('editor').addEventListener('blur', function() {
            if (this.textContent.trim() === '') {
                this.textContent = 'Take a note...';
                this.classList.add('placeholder');
            }
        });

        function execCmd(command) {
            document.execCommand(command, false, null);
        }

        function uploadImage() {
            var file = document.getElementById('imageUploader').files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100%';
                document.getElementById('editor').appendChild(img);
            }
            reader.readAsDataURL(file);
        }

        function changeColor(color) {
    var editor = document.getElementById('editor');
    var toolbar = document.querySelector('.toolbar');

    switch (color) {
        case 'green':
            editor.style.backgroundColor = 'green';
            editor.style.color = 'black'; 
            toolbar.style.backgroundColor = 'green';
            toolbar.style.color = 'white'; 
            break;
        case 'yellow':
            editor.style.backgroundColor = 'yellow';
            editor.style.color = 'black';
            toolbar.style.backgroundColor = 'yellow';
            toolbar.style.color = 'black';
            break;
        case 'grey':
            editor.style.backgroundColor = 'grey';
            editor.style.color = 'black';
            toolbar.style.backgroundColor = 'grey';
            toolbar.style.color = 'black';
            break;
        case 'pink':
            editor.style.backgroundColor = 'pink';
            editor.style.color = 'black';
            toolbar.style.backgroundColor = 'pink';
            toolbar.style.color = 'black';
            break;
        default:
            editor.style.backgroundColor = '#E2F1FF'; 
            editor.style.color = 'black';
            toolbar.style.backgroundColor = '#E2F1FF'; 
            toolbar.style.color = 'black'; 
            break;
    }
}




    </script>



		</ul>
	</div>
</div>
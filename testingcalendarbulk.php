<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar with CSV Uploader</title>
    <link href='https://fullcalendar.io/releases/v5.10.1/main.css' rel='stylesheet' />
    <script src='https://fullcalendar.io/releases/v5.10.1/main.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        #calendar {
            width: 80%;
            margin-top: 20px;
        }
        #csv-upload {
            margin-bottom: 20px;
        }
        #upload-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<input type="file" id="csv-upload" accept=".csv" />
<button id="upload-button">Upload Events</button>
<div id='calendar'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true, // Enable dragging and resizing events
            selectable: true, // Allow creating events by clicking and dragging
            events: [] // Initialize with an empty array of events
        });
        calendar.render();

        // Function to handle CSV file upload and event addition
        function handleCSVUpload(file) {
            Papa.parse(file, {
                header: true,
                complete: function(results) {
                    var events = results.data.map(row => ({
                        title: row.title,
                        start: row.start,
                        end: row.end,
                        description: row.description
                    }));
                    // Add events to the calendar
                    calendar.addEventSource(events);
                }
            });
        }

        // Event listener for file upload input
        document.getElementById('csv-upload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                handleCSVUpload(file);
            }
        });

        // Event listener for upload button click
        document.getElementById('upload-button').addEventListener('click', function() {
            var fileInput = document.getElementById('csv-upload');
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                handleCSVUpload(file);
            } else {
                alert('Please select a CSV file first.');
            }
        });
    });
</script>

</body>
</html>

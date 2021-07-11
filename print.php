<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Section</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->

    <style>
    @media print {
    body * {
        visibility: hidden;
    }
    #print-section, #print-section * {
        visibility: visible;
    }
    #print-section {
        position: static;
    }
}

    </style>
</head>

<body>
    <div class="content">
        <h1>My Webpage</h1>
        <p>This is the content of my webpage.</p>
        <div id="print-section">
            <h2>Section to Print</h2>
            <p>This is the section that you want to print.</p>
        </div>
        <button onclick="printSection()">Print Section</button>
    </div>

    <script>
        function printSection() {
            window.print();
        }

    </script>
    <!-- <script src="script.js"></script> -->
</body>

</html>
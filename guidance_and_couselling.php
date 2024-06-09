<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance and Counseling Resources</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 0 10px;
        }

        .resources-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .resource {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .resource h2 {
            margin-top: 0;
        }

        .resource p {
            margin-top: 5px;
        }

        .resource iframe {
            width: 100%;
            height: 400px;
            border: none;
            margin-top: 10px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Guidance and Counseling Resources</h1>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="report_case.php">Report a case</a>
            <a href="follow_up.php">Follow up reported case</a>
        </nav>
    </header>

    <div class="resources-container">
        <div class="resource">
            <h2>Guidance and Counseling Video</h2>
            <p>This video provides guidance on how to recognize signs of child abuse and provide support.</p>
            <iframe src="https://www.youtube.com/embed/oGlDN9ZA5nM" allowfullscreen></iframe>

        </div>

        <div class="resource">
            <h2>Journal Article: Recognizing Signs of Child Abuse</h2>
            <p>This journal article discusses common signs of child abuse and strategies for intervention.</p>
            <p><a href="#" class="btn">Read Article</a></p>
        </div>

        <div class="resource">
            <h2>Twitter Thread: Child Safety Tips</h2>
            <p>This Twitter thread offers practical tips for ensuring child safety in different environments.</p>
            <p><a href="#" class="btn">View Thread</a></p>
        </div>
    </div>
</body>
</html>

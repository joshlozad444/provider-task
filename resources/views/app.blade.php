<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ShipERP PHP Technical Exam</title>
</head>
<body class="bg-slate-200">
    <div class="provider-add">
        <input type="text" id="provider-name" placeholder="Name of data provider" required>
        <input type="text" id="provider-url" placeholder="URL of data provider" required>
        <button class="bg-green-300 px-2 rounded" id="add-provider">Add</button>
    </div>
    <div class="provider-entries">
        <div></div>
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>URL</td>
                    <td>Actions</td>
                </tr>
            </thead>
                <tr>
                    <td>Sample name</td>
                    <td>Sample URL</td>
                    <td>
                        <button>Try me!</button>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>
        </table>
    </div>
    <div class="image-container">
        <img src="" alt="">
    </div>
</body>
<script src="/app.js"></script>
</html>
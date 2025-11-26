<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="h-screen bg-gradient-to-b from-blue-900 to-blue-50">
        <h1 class="text-4xl font-bold text-center text-white pt-10 mb-6">Comments Section</h1>
        <div class="bg-white w-auto max-w-3xl mx-auto p-6 rounded-lg shadow-md mb-10">
            <h2 class="text-2xl font-bold text-center">Write Your Review !</h2>
            <h2 class="ml-5 font-bold">Nama Tempat</h2>
            <form action="#" method="POST" class="max-w-2xl mx-auto p-6 ">
            </form>
            <form action="#" method="POST" class="max-w-2xl mx-auto p-6 ">
                <textarea name="comment" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Write your comment here..."></textarea>
                <button type="submit" class="mt-4 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition justify-center items-center">Submit Comment</button>
            </form> 
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <?php include("business_header.php")?>

    <div class="container mx-auto px-6 py-12">
        
        <section class="text-center pb-12">
            <h1 class="text-5xl font-extrabold text-gray-900">Get in Touch</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                We're here to help! Whether you have a question about features, trials, or anything else, our team is ready to answer all your questions.
            </p>
        </section>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                
                <div class="p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
                    <form action="#" method="POST">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="first-name" name="first-name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="last-name" name="last-name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                        </div>
                        <div class="mt-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="mt-6">
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-blue-50 p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <i class="bi bi-geo-alt-fill text-blue-600 text-2xl mt-1"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">Our Office</h3>
                                <p class="text-gray-600">123 Business Hub, Tech Park, Bangalore, India</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="bi bi-envelope-fill text-blue-600 text-2xl mt-1"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">Email Us</h3>
                                <p class="text-gray-600">support@yourbrand.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                           <i class="bi bi-telephone-fill text-blue-600 text-2xl mt-1"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">Call Us</h3>
                                <p class="text-gray-600">+91 98765 43210</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 rounded-lg overflow-hidden shadow-md">
                        <img src="https://placehold.co/600x400/e0e7ff/6366f1?text=Map+Location" alt="Map Location" class="w-full h-64 object-cover">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; <?php echo date("Y"); ?> YourBrand. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
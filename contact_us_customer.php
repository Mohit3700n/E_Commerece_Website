<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<?php include("customer_header.php")?>

    <main class="container mx-auto px-6 py-12">
        
        <section class="text-center pb-12">
            <h1 class="text-5xl font-extrabold text-gray-900">Contact Our Team</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Have a question or need assistance with an order? We'd love to hear from you.
            </p>
        </section>

        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                
                <div class="p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send a Message</h2>
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="full-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="full-name" name="full-name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">How can we help?</label>
                            <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                Submit Inquiry
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-blue-50 p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Details</h2>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <i class="bi bi-envelope-fill text-blue-600 text-2xl"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">General Inquiries</h3>
                                <p class="text-gray-600">contact@yourbrand.com</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                           <i class="bi bi-telephone-fill text-blue-600 text-2xl"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">Customer Support</h3>
                                <p class="text-gray-600">+91 98765 43210</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                             <i class="bi bi-clock-fill text-blue-600 text-2xl"></i>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">Business Hours</h3>
                                <p class="text-gray-600">Monday - Friday<br>9:00 AM - 6:00 PM (IST)</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; <?php echo date("Y"); ?> YourBrand. All Rights Reserved.
        </div>
    </footer>
</body>
</html>

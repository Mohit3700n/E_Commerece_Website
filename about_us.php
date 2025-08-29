<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
        <section class="text-center py-16">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                Connecting Businesses and Customers, <span class="text-blue-600">Seamlessly.</span>
            </h1>
            <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto">
                We started with a simple idea: to create a powerful and intuitive platform that bridges the gap between local businesses and their communities. Today, we are proud to empower entrepreneurs and delight customers with every interaction.
            </p>
        </section>

        <section class="py-16 bg-white rounded-2xl shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center px-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Our Mission</h2>
                    <p class="mt-4 text-gray-600">
                        Our mission is to empower small and medium-sized businesses by providing them with the digital tools they need to thrive in a competitive marketplace. We believe in fostering growth, building relationships, and supporting the local economy through innovative technology and dedicated support.
                    </p>
                    <div class="mt-6 space-y-4">
                        <div class="flex items-center">
                            <i class="bi bi-bar-chart-line-fill text-blue-500 text-2xl"></i>
                            <span class="ml-4 text-gray-700">Drive growth for local businesses.</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-people-fill text-blue-500 text-2xl"></i>
                            <span class="ml-4 text-gray-700">Connect communities with reliable services.</span>
                        </div>
                         <div class="flex items-center">
                            <i class="bi bi-lightbulb-fill text-blue-500 text-2xl"></i>
                            <span class="ml-4 text-gray-700">Innovate with user-friendly technology.</span>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <img src="https://placehold.co/500x400/e0e7ff/6366f1?text=Our+Vision" alt="Our Vision" class="rounded-lg shadow-md mx-auto">
                </div>
            </div>
        </section>

        <section class="py-20 text-center">
            <h2 class="text-3xl font-bold text-gray-800">Meet Our Team</h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">The passionate individuals behind our platform's success.</p>
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                <div class="bg-white p-8 rounded-xl shadow-md transform hover:-translate-y-2 transition-transform duration-300">
                    <img src="https://placehold.co/150x150/a5b4fc/1e293b?text=CEO" alt="CEO" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Mohit Prajapati</h3>
                    <p class="text-blue-600">Founder & CEO</p>
                    <p class="mt-2 text-sm text-gray-500">Visionary leader with a passion for empowering small businesses through technology.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md transform hover:-translate-y-2 transition-transform duration-300">
                    <img src="https://placehold.co/150x150/a5b4fc/1e293b?text=CTO" alt="CTO" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Shivam Yadav</h3>
                    <p class="text-blue-600">Chief Technology Officer</p>
                    <p class="mt-2 text-sm text-gray-500">The architect of our robust platform, ensuring reliability and innovation.</p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md transform hover:-translate-y-2 transition-transform duration-300">
                    <img src="https://placehold.co/150x150/a5b4fc/1e293b?text=Lead" alt="Lead" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Sagar Kadam</h3>
                    <p class="text-blue-600">Head of Product</p>
                    <p class="mt-2 text-sm text-gray-500">Dedicated to creating an intuitive and seamless experience for all our users.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md transform hover:-translate-y-2 transition-transform duration-300">
                    <img src="https://placehold.co/150x150/a5b4fc/1e293b?text=Lead" alt="Lead" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Rugwed Naikistan</h3>
                    <p class="text-blue-600">Head of Product</p>
                    <p class="mt-2 text-sm text-gray-500">Dedicated to creating an intuitive and seamless experience for all our users.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-md transform hover:-translate-y-2 transition-transform duration-300">
                    <img src="https://placehold.co/150x150/a5b4fc/1e293b?text=Lead" alt="Lead" class="w-32 h-32 rounded-full mx-auto shadow-lg">
                    <h3 class="mt-6 text-xl font-semibold text-gray-900">Mohak Agarwaal</h3>
                    <p class="text-blue-600">Head of Product</p>
                    <p class="mt-2 text-sm text-gray-500">Dedicated to creating an intuitive and seamless experience for all our users.</p>
                </div>

            </div>
        </section>

    </div>

    <!-- Footer Placeholder -->
    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; <?php echo date("Y"); ?> YourBrand. All Rights Reserved.
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our Brand</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

   <?php include("customer_header.php")?>
    <main>
        <section class="bg-white">
            <div class="container mx-auto px-6 py-20 text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    We're building the future of <span class="text-blue-600">online shopping.</span>
                </h1>
                <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto">
                    Welcome to YourBrand, where quality meets convenience. Our journey began with a passion for bringing unique, high-quality products directly to you, creating a seamless and enjoyable shopping experience from start to finish.
                </p>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <h2 class="text-3xl font-bold text-gray-800">Our Story</h2>
                        <p class="mt-4 text-gray-600">
                            Founded in 2024, YourBrand started as a small venture with a big dream: to curate a collection of products that not only meet but exceed expectations. We saw a need for a marketplace that values quality craftsmanship, customer satisfaction, and a personal touch.
                        </p>
                        <p class="mt-4 text-gray-600">
                           Today, we've grown into a trusted destination for shoppers across the country, but our core values remain the same. Every product in our catalog is hand-picked and tested to ensure it aligns with our commitment to excellence.
                        </p>
                    </div>
                    <div class="order-1 md:order-2">
                        <img src="https://placehold.co/600x450/e0e7ff/6366f1?text=Our+Journey" alt="Our Journey" class="rounded-2xl shadow-lg w-full">
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-blue-600 py-20">
            <div class="container mx-auto px-6 text-center text-white">
                <h2 class="text-3xl font-bold">Why Shop With Us?</h2>
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="flex flex-col items-center">
                        <div class="bg-white/20 p-5 rounded-full">
                            <i class="bi bi-gem text-4xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Curated Quality</h3>
                        <p class="mt-2 text-blue-100">We source and feature only the best products, ensuring you get unparalleled quality and value.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-white/20 p-5 rounded-full">
                            <i class="bi bi-truck text-4xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Fast & Reliable Shipping</h3>
                        <p class="mt-2 text-blue-100">Your order is processed with care and shipped out quickly, so you can enjoy your purchase sooner.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="bg-white/20 p-5 rounded-full">
                            <i class="bi bi-headset text-4xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold">Exceptional Support</h3>
                        <p class="mt-2 text-blue-100">Our friendly customer support team is always here to help with any questions or concerns.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-4 text-center text-gray-500">
            &copy; <?php echo date("Y"); ?> YourBrand. All Rights Reserved.
        </div>
    </footer>

</body>
</html>
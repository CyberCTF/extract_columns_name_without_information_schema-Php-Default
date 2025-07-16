<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/components/ComponentLoader.php';
ComponentLoader::loadAll();

$conn = db_connect();
$error = null;
$products = [];

// Vulnerable SQL: classic UNION-based SQLi on id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        $error = mysqli_error($conn);
    }
} else {
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    } else {
        $error = mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog | RetroShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <style>
        body { background: #0f172a; }
        .glass {
            background: rgba(30, 41, 59, 0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>
<body class="dark">
    <nav class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-[95%] lg:w-full max-w-7xl">
        <div class="w-full flex relative justify-between px-4 py-3 rounded-md transition duration-200 bg-transparent mx-auto">
            <div class="flex flex-row gap-2 items-center z-10">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-black text-lg font-bold">🛒</span>
                </div>
                <span class="text-xl font-bold text-white">RetroShop</span>
                <a href="/" class="ml-6 text-white hover:text-gray-300 transition-colors px-3 py-2 rounded-md text-sm">Home</a>
            </div>
        </div>
    </nav>
    <main class="flex flex-col items-center justify-center min-h-screen pt-32">
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-8">Product Catalog</h1>
        <?php if (isset($product)): ?>
            <div class="glass max-w-lg w-full p-8 flex flex-col items-center">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-32 h-32 object-contain mb-4 rounded-lg shadow" />
                <h2 class="text-2xl font-semibold text-white mb-2"><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="text-neutral-300 mb-4 text-center"><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-lg font-bold text-green-400">$<?php echo htmlspecialchars($product['price']); ?></span>
                </div>
                <a href="/lab.php" class="inline-block mt-4 px-6 py-2 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition">Back to Catalog</a>
            </div>
        <?php elseif ($error): ?>
            <div class="glass max-w-lg w-full p-8 text-center">
                <div class="text-red-400 font-bold mb-2">An error occurred</div>
                <div class="text-neutral-300 text-sm"><?php echo htmlspecialchars($error); ?></div>
                <a href="/lab.php" class="inline-block mt-4 px-6 py-2 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition">Back to Catalog</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-5xl">
                <?php foreach ($products as $prod): ?>
                    <div class="glass flex flex-col items-center p-6">
                        <img src="<?php echo htmlspecialchars($prod['image']); ?>" alt="<?php echo htmlspecialchars($prod['name']); ?>" class="w-24 h-24 object-contain mb-3 rounded-lg shadow" />
                        <h3 class="text-lg font-semibold text-white mb-1"><?php echo htmlspecialchars($prod['name']); ?></h3>
                        <p class="text-neutral-400 text-sm mb-2 text-center"><?php echo htmlspecialchars($prod['description']); ?></p>
                        <span class="text-green-400 font-bold mb-2">$<?php echo htmlspecialchars($prod['price']); ?></span>
                        <a href="/lab.php.php?id=<?php echo urlencode($prod['id']); ?>" class="mt-2 px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-700 transition w-full text-center">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <footer class="mt-20 text-center text-neutral-500 text-sm pb-8">&copy; 2025 RetroShop. All rights reserved.</footer>
</body>
</html> 
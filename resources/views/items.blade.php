<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Table Toggle</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        #toggleSort {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <button id="toggleSort">Sort Ascending</button>

    <table id="sortableTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>28</td>
                <td>New York</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>34</td>
                <td>Los Angeles</td>
            </tr>
            <tr>
                <td>Samuel Johnson</td>
                <td>45</td>
                <td>Chicago</td>
            </tr>
            <tr>
                <td>Emily Davis</td>
                <td>23</td>
                <td>Houston</td>
            </tr>
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isAscending = true;

            document.getElementById('toggleSort').addEventListener('click', function() {
                sortTable(isAscending);
                isAscending = !isAscending;
                this.textContent = isAscending ? 'Sort Ascending' : 'Sort Descending';
            });

            function sortTable(ascending) {
                const table = document.getElementById('sortableTable');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));

                rows.sort((a, b) => {
                    const textA = a.children[0].textContent.toUpperCase(); // Change the index for different columns
                    const textB = b.children[0].textContent.toUpperCase(); // Change the index for different columns

                    return ascending ? textA.localeCompare(textB) : textB.localeCompare(textA);
                });

                rows.forEach(row => tbody.appendChild(row));
            }
        });
    </script>
</body>
</html>


<!-- 

// Add to your review submission logic
function isReviewSuspicious($reviewContent) {
    $suspiciousPatterns = ['excellent', 'amazing', 'best', 'perfect'];
    foreach ($suspiciousPatterns as $pattern) {
        if (strpos(strtolower($reviewContent), $pattern) !== false) {
            return true;
        }
    }
    return false;
}

// Example check during review submission
if (isReviewSuspicious($reviewContent)) {
    return response()->json(['message' => 'Review seems suspicious.'], 400);
}



// routes/web.php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::post('/submit-review', function (Request $request) {
    $userId = $request->user()->id;
    $itemId = $request->input('item_id');
    $reviewContent = $request->input('review');

    // Check for multiple reviews from the same IP
    $ipAddress = $request->ip();
    $recentReviews = DB::table('reviews')
        ->where('ip_address', $ipAddress)
        ->where('created_at', '>=', now()->subHours(1))
        ->count();

    if ($recentReviews > 5) {
        return response()->json(['message' => 'Too many reviews from this IP address.'], 429);
    }

    // Store the review
    DB::table('reviews')->insert([
        'user_id' => $userId,
        'item_id' => $itemId,
        'review' => $reviewContent,
        'ip_address' => $ipAddress,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Review submitted successfully!']);
});

 -->
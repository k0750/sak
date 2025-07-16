<?php
// filter_children.php

$children = [
    // Add all children data here as in the previous example
    [
        'name' => 'John Doe',
        'age' => 10,
        'gender' => 'Male',
        'county' => 'County1',
        'goal' => 'To become a doctor',
        'future' => 'Doctor',
        'story' => 'John comes from a humble background and loves helping others.',
        'image' => 'kt1/fg.jpg'
    ],
    // Add other child records
];

$filteredChildren = $children;

if (isset($_GET['county']) && !empty($_GET['county'])) {
    $filteredChildren = array_filter($filteredChildren, function($child) {
        return $child['county'] === $_GET['county'];
    });
}

if (isset($_GET['age']) && !empty($_GET['age'])) {
    $filteredChildren = array_filter($filteredChildren, function($child) {
        return $child['age'] == $_GET['age'];
    });
}

if (isset($_GET['gender']) && !empty($_GET['gender'])) {
    $filteredChildren = array_filter($filteredChildren, function($child) {
        return $child['gender'] === $_GET['gender'];
    });
}

if (!empty($filteredChildren)) {
    foreach ($filteredChildren as $child) {
        echo "<div class='child'>";
        echo "<img src='{$child['image']}' alt='Child Image'>";
        echo "<div class='child-info'>";
        echo "<h3>Name: {$child['name']}</h3>";
        echo "<p>Age: {$child['age']}</p>";
        echo "<p>Gender: {$child['gender']}</p>";
        echo "<p>County: {$child['county']}</p>";
        echo "<p>Goal: {$child['goal']}</p>";
        echo "<p>Future Aspiration: {$child['future']}</p>";
        echo "<p>Story: {$child['story']}</p>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No children match your criteria.</p>";
}
?>

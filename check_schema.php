<?php
$db = new PDO('sqlite:database/database.sqlite');
$stmt = $db->query('PRAGMA table_info(job_applications);');
$columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Job Applications Table Columns:\n";
foreach ($columns as $col) {
    echo $col['name'] . ' (' . $col['type'] . ')\n';
}

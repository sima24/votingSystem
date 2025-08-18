<?php
include 'db_conn.php';

$check = $conn->query("SELECT results_published FROM settings WHERE id = 1");
$row = $check->fetch_assoc();

if ($row['results_published'] == 1) {

    $query = "
        SELECT a.name AS agent_name, a.party_name, COUNT(v.id) AS total_votes
        FROM agent a
        LEFT JOIN votes v ON v.agent_id = a.id
        GROUP BY a.id
        ORDER BY total_votes DESC
    ";
    $result = $conn->query($query);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Election Results</title>
      <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4CAF50;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }
        tr:hover {
            background: #f1f1f1;
        }
        td {
            font-size: 15px;
            color: #333;
        }
        .container {
            text-align: center;
            margin-top: 30px;
        }
        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
      </style>
    </head>
    <body>
      <h2>Election Results</h2>
      <table>
        <tr>
            <th>Agent</th>
            <th>Party</th>
            <th>Total Votes</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['agent_name'] ?></td>
                <td><?= $row['party_name'] ?></td>
                <td><?= $row['total_votes'] ?></td>
            </tr>
        <?php endwhile; ?>
      </table>
      <div class="container">
        <p class="note">Results are auto-generated from the voting system.</p>
      </div>
    </body>
    </html>
    
    <?php
} else {
    echo "<h3 style='text-align:center; color:red;'>Results are not published yet.</h3>";
}
?>

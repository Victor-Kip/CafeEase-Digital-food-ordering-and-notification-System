
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <style>
        h1 {
            background-color: darkcyan;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Payment History</h1>
    <table>
        <tr>
        <th>Payment ID</th>
            <th>Customer ID</th>
            <th>Payment Date</th>
            <th>Amount</th>
        </tr>
        
        <?php

         include('../Config/constant.php'); // Include your database connection file

         // Start session if not already started

         $customer_id = $_SESSION['user']; // Assuming user ID is stored in session after login

        // Create connection
        //  $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
         if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         }

         $sql = "SELECT * FROM payments WHERE customer_ID = ?";

         if ($stmt = $conn->prepare($sql)) {
             $stmt->bind_param("i", $customer_id);
             $stmt->execute();
             $result = $stmt->get_result();

             if ($result->num_rows > 0) {
            
                 while($row = $result->fetch_assoc()) {
                     echo "<tr>
                        <td>" . htmlspecialchars($row["payment_ID"]) . "</td>
                        <td>" . htmlspecialchars($row["customer_ID"]) . "</td>
                        <td>" . htmlspecialchars($row["Payment_Date"]) . "</td>
                        <td>" . htmlspecialchars($row["Amount"]) . "</td>
                        
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No payment history found</td></tr>";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
        
        ?>
    </table>
</body>
</html>

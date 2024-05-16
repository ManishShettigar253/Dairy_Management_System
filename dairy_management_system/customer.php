<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer</title>
         <style>
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
            /* Customizing input fields */
.input-field {
    border: none;
    border-bottom: 1px solid #aaa; /* Add an underline */
    background-color: transparent; /* Make background transparent */
    padding: 5px;
    font-size: 16px;
    transition: border-bottom-color 0.3s; /* Add transition effect */
    width: 100%;
}

.input-field:focus {
    outline: none; /* Remove default focus outline */
    border-bottom-color: #007bff; /* Change underline color on focus */
}

/* Customizing buttons */
.styled-button {
    background-color:  #4CAF50; /* Button background color */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s; /* Add transition effect */
}

.styled-button:hover {
    background-color: #0056b3; /* Change button background color on hover */
}

button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        input[type=date] {
            padding: 8px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
            .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
            .styled-button a {
        color: white; /* Set font color to white */
        text-decoration: none; /* Remove underline */
    }

    
    h2,h1 {
            text-align: center;
            margin-bottom: 20px;
        }
         </style>
<script>
    function redirectToIndex() {
    window.location.replace("localhost/dairy_management_system/index.html");
}


function openPrintPalette() {
        window.print();
    }


</script>
         
    </head>
    <body class="a">
        <h1 align="center">CUSTOMER</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <table cellspacing="5" cellpadding="5" align="center">
        <tr><th>ID</th><th>Name</th><th>Address</th><th>Milk Type</th></tr>
        <tr>
        <td align="center"><input style="decoration:none" type="text" name="ssn" id="ssn" size="20" maxlength="20"  placeholder="ID is Auto Generated" readonly/></td>
         <td><input type="text" name="name" id="name" size="20" class="input-field"/></td>
            <td><input type="text" name="address" id="address" size="20" class="input-field"/></td>
            <td>
                <select name="mtype" class="input-field">
                    <option>Buffalo</option>
                    <option>Cow</option>
                </select>
            </td>
        </tr>
        <tr align="center">
            <td colspan="4">
                <button class="styled-button" ><a href="index.php">Back</a></button>
                <input type="submit" value="Insert" class="styled-button"/>
                <input type="reset" value="Reset" class="styled-button"/>
    <button onclick="openPrintPalette()">Print</button>
            </td>
        </tr>
    </table>
</form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Connect to database
            $mysql = mysqli_connect("localhost", "root", "","dairy"); // host, user, password
            
            
            // Collect post data
            $ssn = $_POST["ssn"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $mtype = $_POST["mtype"];
            
            // Insert to database
            if ($ssn && $name && $address) {
                mysqli_query($mysql, "INSERT INTO customer VALUES('$ssn','$name','$address','$mtype')");
            }
            
            // Get next customer No
            $result2 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY ssn DESC");
            $num = mysqli_num_rows($result2);
            
            // Set to customer no input box
            $array = mysqli_fetch_row($result2);
            if ($num == 0) {
                print"<script>document.getElementById('ssn').value=1;</script>";
                print"<script>document.getElementById('name').focus();</script>";
            } else {
                $num = $array[0] + 1;
                print"<script>document.getElementById('ssn').value=$num;</script>";
                print"<script>document.getElementById('name').focus();</script>";
            }
            
            // Free result set
            mysqli_free_result($result2);
        }
            ?>
            <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    caption {
        font-weight: bold;
        margin-bottom: 10px;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>

<table border="1" cellspacing="5" cellpadding="5" align="center">
    <tr>
        <th>Customer No.</th>
        <th>Name</th>
        <th>Address</th>
        <th>Milk Type</th>
    </tr>
    <?php
    $mysql = mysqli_connect("localhost", "root", "","dairy"); // host, user, password
            
    $result3 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY ssn DESC");
    while ($array = mysqli_fetch_row($result3)) {
        echo "<tr>";
        echo "<td>$array[0]</td>";
        echo "<td>$array[1]</td>";
        echo "<td>$array[2]</td>";
        echo "<td>$array[3]</td>";
        echo "</tr>";
    }
    mysqli_free_result($result3);
    mysqli_close($mysql);
    ?>
</table>

    </body>
</html>

<?php
include "./head.php";
?>

<body>
    <div class="bg">
    <div class="form formContainer">
        <form class="fields formContainer" action="" method="post">
            <div style="text-align:center; font-size: 20px; font-weight: bold">Registration</div>
            <div class="textFields">
                <label class="fontStyle" for="name">Name*</label>
                <input class="textboxFeatures" type="text" name="name">
                <label class="fontStyle" for="email">Email*</label>
                <input class="textboxFeatures" type="text" name="email">
            </div>
            <div class="textFields">
                <label class="fontStyle" for="surname">Surname*</label>
                <input class="textboxFeatures" type="text" name="surname">
                <label class="fontStyle" for="phoNo">Phone No.*</label>
                <input class="textboxFeatures" type="text" name="phoNo">
            </div>
            <button class="button" type="submit">Submit</button>

            <?php
            include "./models/User.php"; //sasaja su objektu User
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "mydatabase";

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                // if (
                //     isset($_GET["name"]) != " " &&
                //     isset($_GET["surname"]) != " " &&
                //     isset($_GET["email"]) != " " &&
                //     isset($_GET["phoNo"]) != " "
                // ){
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $db);
                    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, phone_number) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phoNo']);
                    $stmt->execute();
                    $stmt->close();
                    //close connection
                    $conn->close();
                
                // }else{
                //     echo("*Fill all fields");
                // }
            };

            // echo $_SERVER['REQUEST_METHOD'];
            // Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }
            // echo "Connected successfully";

            //create connection
            $conn = new mysqli($servername, $username, $password, $db);
            $sql = "SELECT * FROM `users`";
            $result = $conn->query($sql);
            // print_r($result);
            $users = [];
            if ($result->num_rows > 0) {
                // output data of each row
                //praso DB duomenu po viena eilute (fetch - atnesti)
                while ($row = $result->fetch_assoc()) {
                    $users[] = new User(
                        $row["id"],
                        $row["name"],
                        $row["surname"],
                        $row["email"],
                        $row["phone_number"]
                    );
                }
            } else {
                echo "0 results";
            }
            //close connection
            $conn->close();

            // print_r($users);
            //===========================frontend=======================
            // foreach ($users as $user) {
            //     // echo "<h1>" . $user->name . "</h1>";
            //     $user->toString();
            // }
            ?>
            <!-- Table -->
            <p style="text-align:center; font-size: 20px; font-weight: bold; margin-bottom: 20px">Participants</p>
            <table class="table fontStyleTable">
                <thead>
                    <tr>
                        <th class="fontStyle">Name</th>
                        <th class="fontStyle">Surname</th>
                        <th class="fontStyle">Email</th>
                        <th class="fontStyle">Phone No.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($users as $user) {
                        ?>
                    <tr>
                        <td style="color: rgba(117, 48, 183, 0.804)"> <?= $user->name ?> </td>
                        <td style="color: rgba(117, 48, 183, 0.804)"> <?= $user->surname ?> </td>
                        <td> <?= $user->email ?> </td>
                        <td> <?= $user->phoneNumber ?> </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </div>
</body>

</html>
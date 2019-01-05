<?php include '../modules/b_head.php'; ?>

<?php include '../modules/b_navbar.php'; ?>


    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detail des utilisateurs</h2>
                        <a href="create_user.php" class="btn btn-success pull-right">Créer un nouvel utilisateur </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "b_config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM USERS";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Prénom</th>";
                                        echo "<th> Mail</th>";
                                        echo "<th>Telephone</th>";
                                        echo "<th>Date de Naissance</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['USER_ID'] . "</td>";
                                        echo "<td>" . $row['USER_LAST_NAME'] . "</td>";
                                        echo "<td>" . $row['USER_FIRST_NAME'] . "</td>";
                                        echo "<td>" . $row['USER_EMAIL'] . "</td>";
                                        echo "<td>" . $row['USER_PHONE'] . "</td>";
                                        echo "<td>" . $row['USER_DATE_OF_BIRTH'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='voir_user.php?id=". $row['USER_ID'] ."' title='Voir' data-toggle='tooltip'><span class='btn btn-primary'>View</span></a>";
                                            echo "<a href='update_user.php?id=". $row['USER_ID'] ."' title='Modifier' data-toggle='tooltip'><span class='btn btn-primary'>Update</span></a>";
                                            echo "<a href='delete_user.php?id=". $row['USER_ID'] ."' title='Supprimer' data-toggle='tooltip'><span class='btn btn-primary'>Delete</span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Aucune donnée.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>

<?php include '../modules/b_end.php'; ?>  
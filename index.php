<?php 
include "inc/header.php";
include "lib/database.php"; 
?>
<div class="container">
    <div class="card">
        <div class="card-header">     
            <h2>Student Data<a href="addStudent.php" class="float-right">Add Student </a></h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                <?php
                    $db=new Database();
                    $table="student";
                    $order_by=array('order_by'=>'id desc');
                    $data=$db->select($table,$order_by);
                    $i=0;
                    foreach($data as $data){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["name"]; ?></td>
                    <td><?php echo $data["email"]; ?></td>
                    <td><?php echo $data["phone"]; ?></td>
                    <td><a class ="btn btn-success" href="editStudent.php?id=<?php echo $data['id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="deleteStudent.php?id=<?php echo $data['id']; ?>">Delete</a></td>
                </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
include "inc/footer.php";
?>